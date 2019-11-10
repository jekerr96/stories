<? $pageType = "main" ?>
<? include "template/header.php" ?>
    <div class="container">
        <div class="content-wrapper">
            <div class="genres">
                <div class="genres-title js-genres-toggle-btn"><span>Поиск по жанрам</span></div>
                <div class="genres-wrapper js-toggle-genres" style="display: none;">
                    <? for ($i = 0; $i < 20; $i++): ?>
                        <a href="javascript:void(0)" class="js-genre"><span class="genre-name">Жанр <?= $i ?></span><span class="genre-actions"><i class="plus js-plus">+</i><i class="minus js-minus">-</i></span></a>
                    <? endfor; ?>
                </div>
            </div>
            <div class="list-stories">
                <? for ($i = 0; $i < 10; $i++): ?>
                    <? require $_SERVER["DOCUMENT_ROOT"] . "/partials/story-item.php" ?>
                <? endfor; ?>
            </div>
        </div>
        <? require $_SERVER["DOCUMENT_ROOT"] . "/partials/pagination.php" ?>
    </div>
<? include "template/footer.php" ?>