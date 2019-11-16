<?
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/prolog.php";
$result = $USER->logout();

if ($result["EXIT"]) {
    echo json_encode(["exit" => true]);
}


