<div class="story-item">
    <a href="javascript:void(0)"
       class="story-name underline">История <?= $i ?> с длинным названием, но не слишком, но все таки длиннее чем был, хотя все равно не длинно. Нужны две строчки</a><span
            class="rating">5.<?= $i ?></span>
    <div class="story-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad alias cum deleniti distinctio dolorum et eveniet fugiat laborum libero maiores minus necessitatibus obcaecati, officia praesentium quo quod repudiandae sit ut voluptatibus. Ad adipisci asperiores assumenda aut, blanditiis consequatur cupiditate delectus distinctio dolorem dolores dolorum ducimus eaque eligendi esse id illo ipsum labore laboriosam minus molestias nam neque obcaecati officiis omnis placeat possimus, quaerat recusandae saepe tempora tenetur totam ullam ut voluptates. Accusantium ipsa labore magni, nostrum optio quia voluptatem. Distinctio ducimus, ex ipsam libero necessitatibus optio reprehenderit? Dolorum earum esse explicabo, modi mollitia non quas sapiente similique tenetur voluptates.</div>
    <div class="list-genres">
        <? for ($j = 0; $j < 5; $j++): ?>
            <a href="javascript:void(0)">Жанр <?= $j ?></a>
        <? endfor; ?>
    </div>
    <div class="bottom-tools">
        <div class="buttons">
            <? if ($i == 2): ?>
                <div class="edit js-tippy" data-tippy-content="Редактировать"></div>
            <? else: ?>
                <div class="bookmark js-tippy" data-tippy-content="Добавить в закладки"></div>
                <div class="read-late js-tippy" data-tippy-content="Прочитать позже"></div>
            <? endif; ?>
        </div>
        <div class="date"><?= date("d.m.Y") ?></div>
    </div>
    <div class="btn-wrapper">
        <a href="javascript:void(0)" class="detail-link"><span>Читать полную историю</span></a>
    </div>
</div>