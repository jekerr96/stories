<? use local\db\Genre\Element as GenreElement;
use local\db\Story\Element as StoryElement;
use local\Helper;

$arrExclude    = [];
$arrInclude    = [];
$includeParams = explode(",", $_GET["include"]);
$excludeParams = explode(",", $_GET["exclude"]);

foreach ($includeParams as $item) {
    if (!$item) continue;
    $arrInclude[(int)$item] = $item;
}

foreach ($excludeParams as $item) {
    if (!$item) continue;
    $arrExclude[(int)$item] = $item;
}

$pageType = "main" ?>
<? include "template/header.php" ?>
    <div class="container">
        <div class="content-wrapper">
            <div class="genres">
                <div class="genres-title js-genres-toggle-btn"><span>Поиск по жанрам</span></div>
                <div class="genres-wrapper js-toggle-genres" style="<?= $arrExclude || $arrInclude ? "" : "display: none;" ?>">
                    <?
                    $genreModel = new GenreElement();
                    $genres     = $genreModel->getList();
                    foreach ($genres as $genre): ?>
                        <a href="javascript:void(0)" class="js-genre">
                            <span class="genre-name"><?= $genre->NAME ?></span>
                            <span class="genre-actions">
                                <i class="plus js-plus<?= $arrInclude[$genre->ID] ? " active" : "" ?>"
                                   data-id="<?= $genre->ID ?>">+</i>
                                <i class="minus js-minus<?= $arrExclude[$genre->ID] ? " active" : "" ?>"
                                   data-id="<?= $genre->ID ?>">-</i>
                            </span>
                        </a>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="list-stories js-list-stories" data-url="/ajax/stories/index.php">
                <?
                $storyModel = new StoryElement();
                $stories    = $storyModel->getStoriesWithFilter();

                foreach ($stories as $story): ?>
                    <? Helper::render("/partials/story-item.php", [
                        "item" => $story,
                    ]); ?>
                <? endforeach; ?>
                <?= $storyModel->getPagen() ?>
            </div>
        </div>
    </div>
<? include "template/footer.php" ?>