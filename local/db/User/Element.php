<?php


namespace local\db\User;


use local\db\ElementBase;

class Element extends ElementBase {
    protected $rowClass = Row::class;
    protected $tableName = "USERS";
    protected $selectFields = ["LOGIN", "AVATAR"];

    /**
     * @param $login
     * @param $pass
     * @return array
     */
    public function auth($login, $pass) {
        global $USER;

        if (!$login || !$pass) {
            return ["AUTH" => false];
        }

        $authUser = $this->filter(["LOGIN" => "'$login'", "PASSWORD" => "'$pass'"])->limit(1)->getList();

        if (count($authUser) == 1) {
            $_SESSION["AUTH"] = true;
            $_SESSION["USER"] = $authUser[0];
            $USER = $authUser[0];
            $USER->setAuth(true);

            return [
                "AUTH" => true,
                "USER" => $authUser[0]
            ];
        }

        return ["AUTH" => false];
    }
}