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
    protected $autoloadFields = [
        "FAVORITES" => [
            \local\db\Story\Element::class, "ID_USER", "ID_STORY", "FAVORITES"
        ],
        "REED_LATER" => [
            \local\db\Story\Element::class, "ID_USER", "ID_STORY", "REED_LATER"
        ],
    ];

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