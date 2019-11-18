<?php


namespace local\db;


class RowBase {
    protected $autoloadFields = [];
    protected $modelClass;
    protected $autoLoaded = [];

    public function __get($name) {
        if (!array_key_exists($name, $this->autoLoaded) && array_key_exists($name, $this->autoloadFields)) {
            $field = $this->autoloadFields[$name];

            if (count($field) == 4) {
                $fieldName = $field[1];
                $loadField = $field[2];
                $id        = $this->ID;
                /** @var ElementBase $model */
                $model     = new $field[0];
                $tableName = $field[3];
                $items     = $model->select(["*"], true, false)
                    ->tableName($tableName)
                    ->filter([$fieldName => $id])
                    ->orderBy([$tableName . ".ID" => "DESC"], true)
                    ->groupBy([$tableName . ".ID"], true)
                    ->getList(true);

                $ids = [];

                foreach ($items as $item) {
                    $ids[$item->$loadField] = $item->$loadField;
                }

                if (!empty($ids)) {
                    $model     = new $field[0];
                    $loadItems = $model->filter(["ID" => $ids])->getList();
                } else {
                    $loadItems = [];
                }

                $this->$name             = $loadItems;
                $this->autoLoaded[$name] = true;

                return $loadItems;
            } else {
                $model = new $field[0];
                $fieldName = $field[1];
                $tableName = $field[2];

                $items     = $model->select(["*"], true, false)
                    ->tableName($tableName)
                    ->filter([$model->getTable() => $this->$fieldName])
                    ->getList(true);

                $this->$name = $items;
                $this->autoLoaded[$name] = true;

                return $items;
            }
        }
    }
}