<?php


namespace local\db\Genre;

use local\db\ElementBase;

class Element extends ElementBase {
    protected $rowClass = Row::class;
    protected $tableName = "GENRES";
    protected $selectFields = ["ID", "NAME"];
}