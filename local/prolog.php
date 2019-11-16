<?

use local\db\User\Row;

require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
session_start();
global $USER;

if ($_SESSION["AUTH"]) {
    $USER = $_SESSION["USER"];
} else {
    $USER = new Row();
}

file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/log/log.txt", print_r([$USER->isAuth()], true), FILE_APPEND); //todo remove!