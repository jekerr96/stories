<?php


namespace local\db;


class RowBase {
    protected $autoloadFields = [];
    protected $modelClass;
    protected $autoLoaded = [];

    public function __get($name) {
        if (!array_key_exists($name, $this->autoLoaded) && array_key_exists($name, $this->autoloadFields)) {
            $field = $this->autoloadFields[$name];
            $fieldName = $field[1];
            $loadField = $field[2];
            $id = $this->ID;
            /** @var ElementBase $model */
            $model = new $field[0];
            $tableName = $field[3];
            $items = $model->select(["*"], true)->tableName($tableName)->filter([$fieldName => $id])->getList();

            $ids = [];

            foreach ($items as $item) {
                $ids[$item->$loadField] = $item->$loadField;
            }

            if (!empty($ids)) {
                $model = new $field[0];
                $loadItems = $model->filter(["ID" => $ids])->getList();
            } else {
                $loadItems = [];
            }

            $this->$name = $loadItems;
            $this->autoLoaded[$name] = true;
            return $loadItems;
        }
    }
}