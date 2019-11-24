<?php

/**
 * Class Row
 * @property int ID
 */
namespace local\db\Story;
use local\db\RowBase;

class Row extends RowBase {
    protected $modelClass = Element::class;
    protected $autoloadFields = [
        "GENRES" => [
            \local\db\Genre\Element::class, "ID_STORIES", "ID_GENRES", "STORIES_GENRES"
        ],
        "AUTHOR" => [
            \local\db\User\Element::class, "AUTHOR", "USERS"
        ]
    ];

    public function getSrc() {
        return "/story/" . $this->ID . "/";
    }
}