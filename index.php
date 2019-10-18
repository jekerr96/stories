<? $pageType = "main" ?>
<? include "template/header.php" ?>
    <div class="container">
        <div class="content-wrapper">
            <div class="genres">
                <div class="genres-title">Поиск по жанрам</div>
                <div class="genres-wrapper">
                    <? for ($i = 0; $i < 20; $i++): ?>
                        <a href="javascript:void(0)" class="js-genre"><span>Жанр <?= $i ?></span><span><i class="plus js-plus">+</i><i class="minus js-minus">-</i></span></a>
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