<?php

namespace local\db;

use local\DBConnect;
use local\Helper;

class ElementBase {
    protected $selectFields = [];
    protected $filter = [];
    protected $sort = [];
    protected $limit;
    protected $rowClass;
    protected $tableName;
    protected $dbh;
    protected $pagen = [];
    protected $pagenName = "page";
    protected $relativeTables = [];
    protected $groupBy = ["ID"];

    public function __construct() {
        array_unshift($this->selectFields, $this->getTable() . ".ID as ID");
        $this->sort = array_merge([$this->getTable() . ".ID" => "DESC"], $this->sort);
        $this->dbh = DBConnect::getConnect();
    }

    public function tableName($name) {
        $this->tableName = $name;

        return $this;
    }

    public function getTable() {
        return $this->tableName;
    }

    public function select(array $select, $clear = false, $addId = true) {
        if ($clear) {
            $this->selectFields = $select;

            if ($addId) {
                array_unshift($this->selectFields, $this->getTable() . ".ID as ID");
            }
        } else {
            $this->selectFields = array_merge($this->selectFields, $select);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getSelect() {
        return $this->selectFields;
    }

    public function filter(array $filter, $clear = false) {
        if ($clear) {
            $this->filter = $filter;
        } else {
            if ($filter["STRING"]) {
                $this->filter["STRING"] .= " " . $filter["STRING"];
                unset($filter["STRING"]);
            }
            $this->filter = array_merge($this->filter, $filter);
        }

        return $this;
    }

    public function orderBy(array $sort, $clear = false) {
        if ($clear) {
            $this->sort = $sort;
        } else {
            $this->sort = array_merge($this->sort, $sort);
        }

        return $this;
    }

    public function groupBy(array $group, $clear = false) {
        if ($clear) {
            $this->groupBy = $group;
        } else {
            $this->groupBy = array_merge($this->sort, $group);
        }

        return $this;
    }


    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit) {
        $this->limit = $limit;

        return $this;
    }


    /**
     * @param $count
     * @param $page
     * @param string $pagenName
     * @return $this
     */
    public function page($count, $page, $pagenName = "page") {
        if ($page == 1) {
            $this->limit = $count;
        } else {
            $start       = $count * $page - $count;
            $this->limit = "$start, $count";
        }

        $this->setPagen($count, $page, $this->getCount(), $pagenName);

        return $this;
    }


    /**
     * @param $count
     * @param $page
     * @param $all
     * @param $name
     */
    protected function setPagen($count, $page, $all, $name) {
        ob_start();
        Helper::render("/partials/pagination.php", ["COUNT" => $count, "PAGE" => $page, "ALL" => $all, "PAGEN_NAME" => $name]);
        $this->pagen[$name] = ob_get_clean();
    }


    /**
     * @param string $name
     * @return mixed
     */
    public function getPagen($name = "page") {
        return $this->pagen[$name];
    }

    /**
     * @return array
     */
    public function getList($useInnerJoin = false) {
        $sql  = $this->prepareSql($useInnerJoin);
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/log/log.txt", print_r([$sql], true), FILE_APPEND); //todo remove!
        $rows = [];

        /** @var \PDOStatement $stmt */
        $stmt = $this->dbh->query($sql);
        while ($row = $stmt->fetch()) {
            $classRow = new $this->rowClass;

            foreach ($row as $field => $rowItem) {
                $classRow->$field = $rowItem;
            }

            $rows[] = $classRow;
        }

        return $rows;
    }

    public function getCount() {
        $select = $this->prepareSelect();
        $filter    = $this->prepareFilter();
        $innerJoin = $this->prepareInnerJoin();
        $groupBy = $this->prepareGroupBy();

        $sql = $select . " FROM " . $this->tableName . $innerJoin . $filter . $groupBy;
        /** @var \PDOStatement $stmt */
        $stmt  = $this->dbh->query($sql);
        $count = $stmt->rowCount();
        return $count;
    }

    protected function prepareFilter() {
        $filter = " WHERE 1=1";

        foreach ($this->filter as $key => $item) {
            if (is_array($item) && empty($item)) continue;

            if ($key == "STRING") {
                if (!trim($item)) {
                    continue;
                }

                $filter .= " AND $item";
                continue;
            }

            if (is_array($item)) {
                $filter .= " AND  $key IN (" . implode(", ", $item) . ")";
            } else {
                if ($key[0] == "!") {
                    $key = substr($key, 1);
                    $filter .= " AND $key != $item";
                } else {
                    $filter .= " AND $key = $item";
                }

            }
        }

        return $filter;
    }

    protected function prepareInnerJoin() {
        $innerJoin = "";

        if (!empty($this->relativeTables)) {
            foreach ($this->relativeTables as $table => $tableKey) {
                $innerJoin .= " INNER JOIN " . $table . " ON " . $table . "." . $tableKey . "=" . $this->getTable() . ".ID";
            }
        }

        return $innerJoin;
    }

    protected function prepareSql($useInnerJoin = false) {
        if (!$this->tableName) {
            ob_clean();
            echo "Не указана таблица";
            die();
        }

        if (!$this->rowClass) {
            ob_clean();
            echo "Не указан класс Row";
            die();
        }

        $select = $this->prepareSelect();
        $filter = $this->prepareFilter();
        $groupBy = $this->prepareGroupBy();

        $limit = "";

        if ($this->limit) {
            $limit = " LIMIT " . $this->limit;
        }

        $orderBy = "";

        foreach ($this->sort as $key => $sort) {
            $orderBy .= ", " . $key . " " . $sort;
        }

        if ($orderBy) {
            $orderBy = " ORDER BY " . mb_substr($orderBy, 1);
        }

        if ($useInnerJoin) {
            $innerJoin = $this->prepareInnerJoin();
        } else {
            $innerJoin = "";
        }


        $sql =  $select . " FROM " . $this->tableName . $innerJoin . $filter . $groupBy . $orderBy . $limit;
        return $sql;
    }

    protected function prepareSelect() {
        return "SELECT " . implode(", ", $this->selectFields);
    }

    /**
     * @return string
     */
    protected function prepareGroupBy() {
        $groupBy = "";

        foreach ($this->groupBy as $group) {
            $groupBy .= " " . $group;
        }

        if ($groupBy) {
            $groupBy = " GROUP BY " . mb_substr($groupBy, 1);
        }

        return $groupBy;
    }

    public function subQuery() {
        $sql = $this->prepareSql();
        return $sql;
    }
}