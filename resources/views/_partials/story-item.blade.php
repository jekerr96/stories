<div class="story-item">
    <a href="javascript:void(0)"
       class="story-name underline"><?= $item->name ?></a><span
        class="rating">5</span>
    <div class="story-preview"><?= $item->preview ?></div>
    <div class="list-genres">
        <? foreach ($item->genres as $genre): ?>
        <a href="<?= $genre->getSrc() ?>"><?= $genre->name ?></a>
        <? endforeach; ?>
    </div>
    <div class="bottom-tools">
        <div class="buttons">
            <? if ($item->ID == 2): ?>
            <div class="edit js-tippy" data-tippy-content="Редактировать"></div>
            <? else: ?>
            <div class="bookmark js-tippy" data-tippy-content="Добавить в закладки"></div>
            <div class="read-late js-tippy" data-tippy-content="Прочитать позже"></div>
            <? endif; ?>
        </div>
        <div class="date"><?= date("d.m.Y") ?></div>
    </div>
    <div class="btn-wrapper">
        <a href="<?= $item->getSrc() ?>" class="detail-link"><span>Читать полную историю</span></a>
    </div>
</div>
