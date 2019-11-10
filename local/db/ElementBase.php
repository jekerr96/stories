<?php

namespace local\db;

use local\DBConnect;

class ElementBase {
    protected $selectFields = ["ID"];

    protected $filter = [];
    protected $sort = ["ID"];
    protected $limit;
    protected $rowClass;
    protected $tableName;
    protected $dbh;

    public function __construct() {
        $this->dbh = DBConnect::getConnect();
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
     */
    public function limit(int $limit) {
        $this->limit = $limit;

        return $this;
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

    protected function prepareSql() {
        if (!$this->tableName) {
            ob_clean();
            echo "Не указана таблица"; die();
        }

        if (!$this->rowClass) {
            ob_clean();
            echo "Не указан класс Row"; die();
        }

        $filter = " WHERE 1=1";

        foreach ($this->filter as $key => $item) {
            $filter .= " AND " . $key . "=" . $item;
        }

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

        $sql = "SELECT " . implode(", ", $this->selectFields) . " FROM " . $this->tableName . $filter . $orderBy . $limit;
        return $sql;
    }
}