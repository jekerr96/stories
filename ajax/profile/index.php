<?
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/prolog.php";
use local\db\Story\Element as StoryElement;
use local\Helper;

$name = $_POST["name"];

$storyModel = new StoryElement();
$stories    = $storyModel->page(2, Helper::getCurPage($name), $name)->getList();

foreach ($stories as $story){
    Helper::render("/partials/story-item.php", [
        "item" => $story,
    ]);
}

echo $storyModel->getPagen($name);
