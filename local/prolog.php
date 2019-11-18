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