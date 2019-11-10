<? use local\db\Genre\Element as GenreElement;
use local\db\Story\Element as StoryElement;
use local\Helper;

$include = [];
if ($_GET["include"]) {
    $includeParams = explode(",", $_GET["include"]);
} else {
    $includeParams = [];
}


$exclude = [];
$excludeParams = explode(",", $_GET["exclude"]);

foreach ($includeParams as $item) {
    $include[(int)$item] = $item;
}

print_r($includeParams);

foreach ($excludeParams as $item) {
    $exclude[(int)$item] = $item;
}

$pageType = "main" ?>
<? include "template/header.php" ?>
    <div class="container">
        <div class="content-wrapper">
            <div class="genres">
                <div class="genres-title js-genres-toggle-btn"><span>Поиск по жанрам</span></div>
                <div class="genres-wrapper js-toggle-genres" style="display: none;">
                    <?
                    $genreModel = new GenreElement();
                    $genres = $genreModel->getList();
                    foreach ($genres as $genre): ?>
                        <a href="javascript:void(0)" class="js-genre">
                            <span class="genre-name"><?= $genre->NAME ?></span>
                            <span class="genre-actions">
                                <i class="plus js-plus<?= $include[$genre->ID] ? " active" : "" ?>" data-id="<?= $genre->ID ?>">+</i>
                                <i class="minus js-minus<?= $exclude[$genre->ID] ? " active" : "" ?>" data-id="<?= $genre->ID ?>">-</i>
                            </span>
                        </a>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="list-stories">
                <?
                $storyModel = new StoryElement();
                $stories = $storyModel->filter(["STORIES_GENRES.ID_GENRES" => $include])->page(20, Helper::getCurPage())->getList();
                foreach ($stories as $story): ?>
                    <? Helper::render("/partials/story-item.php", [
                        "item" => $story,
                    ]); ?>
                <? endforeach; ?>
            </div>
        </div>
        <?= $storyModel->getPagen() ?>
    </div>
<? include "template/footer.php" ?>