<?
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/prolog.php";
use local\db\Story\Element as StoryElement;
use local\Helper;

$id = (int)$_GET["author"];

//todo проверить что пользователь подписан на этого пользователя
    ?>
<div class="list-stories js-ajax-container" data-name="page2">
    <?
    $storyModel = new StoryElement();
    $stories    = $storyModel->filter(["AUTHOR" => $id])->page(2, Helper::getCurPage("page2"), "page2")->getList();

    foreach ($stories as $story): ?>
        <? Helper::render("/partials/story-item.php", [
            "item" => $story,
        ]); ?>
    <? endforeach; ?>
    <?= $storyModel->getPagen("page2") ?>
</div>
