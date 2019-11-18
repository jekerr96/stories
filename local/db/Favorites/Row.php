<?php

/**
 * Class Row
 * @property int ID
 */
namespace local\db\Favorites;


use local\db\RowBase;

class Row extends RowBase {
    protected $modelClass = Element::class;
    protected $autoloadFields = [
        "AUTHOR" => [\local\db\User\Element::class, "ID_USER", "USERS"],
        "STORY" => [\local\db\Story\Element::class, "ID_STORY", "STORIES"]
    ];
}