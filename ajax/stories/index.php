<?
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/prolog.php";
use local\db\Story\Element as StoryElement;
use local\Helper;

$model = new StoryElement();

$stories    = $model->getStoriesWithFilter();

foreach ($stories as $story): ?>
    <? Helper::render("/partials/story-item.php", [
        "item" => $story,
    ]); ?>
<? endforeach; ?>
<?= $model->getPagen() ?>
