<?php


namespace local\db\Favorites;

use local\db\ElementBase;

class Element extends ElementBase {
    protected $rowClass = Row::class;
    protected $tableName = "FAVORITES";
    protected $selectFields = ["ID"];
}