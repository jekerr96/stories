<?php

/**
 * Class Row
 * @property int ID
 */
namespace local\db\Genre;


use local\db\RowBase;

class Row extends RowBase {
    public function getSrc() {
        return "/?include=" . $this->ID;
    }
}