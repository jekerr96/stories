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
    protected $pagen = "";
    protected $relativeTables = [];

    public function __construct() {
        array_unshift($this->selectFields, $this->getTable() . ".ID as ID");
        $this->dbh = DBConnect::getConnect();
    }

    public function tableName($name) {
        $this->tableName = $name;
        return $this;
    }

    public function getTable() {
        return $this->tableName;
    }

    public function select(array $select, $clear = false) {
        if ($clear) {
            $this->selectFields = $select;
        } else {
            $this->selectFields = array_merge($this->selectFields, $select);
        }

        return $this;
    }

    public function filter(array $filter, $clear = false) {
        if ($clear) {
            $this->filter = $filter;
        } else {
            $this->filter = array_merge($this->filter, $filter);
        }

        return $this;
    }

    public function orderBy(array $sort, $clear = false) {
        if ($clear) {
            $this->sort = $sort;
        } else {
            $this->sort = array_merge($this->filter, $sort);
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
     * @return $this
     */
    public function page($count, $page) {
        if ($page == 1) {
            $this->limit = $count;
        } else {
            $start = $count * $page - $count;
            $this->limit = "$start, $count";
        }

        $this->setPagen($count, $page, $this->getCount());
        return $this;
    }

    /**
     * @param $count
     * @param $page
     * @param $all
     */
    protected function setPagen($count, $page, $all) {
        ob_start();
        Helper::render("/partials/pagination.php", ["COUNT" => $count, "PAGE" => $page, "ALL" => $all]);
        $this->pagen = ob_get_clean();
    }

    /**
     * @return string
     */
    public function getPagen() {
        return $this->pagen;
    }

    /**
     * @return array
     */
    public function getList() {
        $sql = $this->prepareSql();
        $rows = [];

        /** @var \PDOStatement $stmt */
        $stmt = $this->dbh->query($sql);
        while($row = $stmt->fetch()){
            $classRow = new $this->rowClass;

            foreach ($row as $field => $rowItem) {
                $classRow->$field = $rowItem;
            }

            $rows[] = $classRow;
        }

        return $rows;
    }

    public function getCount() {
        $filter = $this->prepareFilter();
        $innerJoin = $this->prepareInnerJoin();

        $sql = "SELECT COUNT(*) as COUNT FROM " . $this->tableName . $innerJoin . $filter;
        echo $sql;
        /** @var \PDOStatement $stmt */
        $stmt  = $this->dbh->query($sql);
        $count = $stmt->fetch()["COUNT"];

        return $count;
    }

    protected function prepareFilter() {
        $filter = " WHERE 1=1";

        foreach ($this->filter as $key => $item) {
            if (is_array($item) && empty($item)) continue;

            if (is_array($item)) {
                $filter .= " AND " . $key . " IN (" . implode(", ", $item) . ")";
            } else {
                $filter .= " AND " . $key . "=" . $item;
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

    protected function prepareSql() {
        if (!$this->tableName) {
            ob_clean();
            echo "Не указана таблица"; die();
        }

        if (!$this->rowClass) {
            ob_clean();
            echo "Не указан класс Row"; die();
        }

        $filter = $this->prepareFilter();

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

        $innerJoin = $this->prepareInnerJoin();

        $sql = "SELECT " . implode(", ", $this->selectFields) . " FROM " . $this->tableName . $innerJoin . $filter . " GROUP BY ID" .  $orderBy . $limit;
        return $sql;
    }
}