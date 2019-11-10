<?php


namespace local\db\Story;

use local\db\ElementBase;

class Element extends ElementBase {
    protected $rowClass = Row::class;
    protected $tableName = "STORIES";
    protected $selectFields = ["NAME", "PREVIEW", "DETAIL", "PUBLICATION_DATE"];
    protected $relativeTables = ["STORIES_GENRES" => "ID_STORIES"];
}