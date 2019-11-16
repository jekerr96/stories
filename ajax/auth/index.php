<?
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/prolog.php";
use local\db\User\Element;

$login = $_POST["login"];
$pass  = $_POST["password"];

$model = new Element();

$result = $model->auth($login, $pass);

if ($result["AUTH"]) {
    echo json_encode(["auth" => true]);
} else {
    echo json_encode(["auth" => false, "errors" => "Неверный логин или пароль"]);
}
