<?php

/**
 * Class Row
 * @property int ID
 * @property string LOGIN
 */
namespace local\db\User;


class Row {
    public function isAdmin() {
        return $this->ID == 1;
    }
}