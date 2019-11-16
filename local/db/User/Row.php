<?php

/**
 * Class Row
 * @property int ID
 * @property string LOGIN
 */
namespace local\db\User;


use local\db\RowBase;

class Row extends RowBase {
    protected $isAuth = false;

    public function isAdmin() {
        return $this->ID == 1;
    }

    public function isAuth() {
        return $this->isAuth;
    }

    public function setAuth($auth) {
        $this->isAuth = $auth;
    }

    public function logout() {
        session_destroy();

        return ["EXIT" => true];
    }
}