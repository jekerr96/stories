<?
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/prolog.php";

use local\db\Story\Element as StoryElement;
use local\Helper;

global $USER;
$storyModel = new StoryElement();
$stories    = $storyModel->filter(["AUTHOR" => $USER->ID, "STATUS" => $storyModel::DRAFT])->page(2, Helper::getCurPage("page6"), "page6")->getList();

foreach ($stories as $story): ?>
    <? Helper::render("/partials/story-item.php", [
        "item" => $story,
    ]); ?>
<? endforeach; ?>
<?= $storyModel->getPagen("page6") ?>