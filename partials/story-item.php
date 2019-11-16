<?
global $USER;
/** @var \local\db\Story\Row $item */
$item = $this->item; ?>
<div class="story-item">
    <a href="<?= $item->getSrc() ?>"
       class="story-name underline"><?= $item->NAME ?></a><span
            class="rating">5</span>
    <div class="story-preview"><?= $item->PREVIEW ?></div>
    <div class="list-genres">
        <? foreach ($item->GENRES as $genre): ?>
            <a href="<?= $genre->getSrc(); ?>"><?= $genre->NAME ?></a>
        <? endforeach; ?>
    </div>
    <div class="bottom-tools">
        <div class="buttons">
            <? if ($item->AUTHOR == $USER->ID): ?>
                <div class="edit js-tippy" data-tippy-content="Редактировать"></div>
            <? elseif ($USER->isAuth()): ?>
                <div class="bookmark js-tippy" data-tippy-content="Добавить в закладки"></div>
                <div class="read-late js-tippy" data-tippy-content="Прочитать позже"></div>
            <? endif; ?>
        </div>
        <div class="date"><?= date("d.m.Y", strtotime($item->PUBLICATION_DATE)) ?></div>
    </div>
    <div class="btn-wrapper">
        <a href="<?= $item->getSrc() ?>" class="detail-link"><span>Читать полную историю</span></a>
    </div>
</div>