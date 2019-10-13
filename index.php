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
                    <div class="story-item">
                        <a href="javascript:void(0)" class="story-name underline">История <?= $i ?> с длинным названием, но не слишком, но все таки длиннее чем был, хотя все равно не длинно. Нужны две строчки</a><span class="rating">5.<?= $i ?></span>
                        <div class="story-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad alias cum deleniti distinctio dolorum et eveniet fugiat laborum libero maiores minus necessitatibus obcaecati, officia praesentium quo quod repudiandae sit ut voluptatibus. Ad adipisci asperiores assumenda aut, blanditiis consequatur cupiditate delectus distinctio dolorem dolores dolorum ducimus eaque eligendi esse id illo ipsum labore laboriosam minus molestias nam neque obcaecati officiis omnis placeat possimus, quaerat recusandae saepe tempora tenetur totam ullam ut voluptates. Accusantium ipsa labore magni, nostrum optio quia voluptatem. Distinctio ducimus, ex ipsam libero necessitatibus optio reprehenderit? Dolorum earum esse explicabo, modi mollitia non quas sapiente similique tenetur voluptates.</div>
                        <div class="list-genres">
                            <? for ($j = 0; $j < 5; $j++): ?>
                                <a href="javascript:void(0)">Жанр <?= $j ?></a>
                            <? endfor; ?>
                        </div>
                        <div class="date"><?= date("d.m.Y") ?></div>
                        <div class="btn-wrapper">
                            <a href="javascript:void(0)" class="detail-link"><span>Читать полную историю</span></a>
                        </div>
                    </div>
                <? endfor; ?>
            </div>
        </div>
        <div class="page-navigation">
            <a href="javascript:void(0)" class="arrow left"></a>
            <a href="javascript:void(0)">1</a>
            <a href="javascript:void(0)">2</a>
            <span class="active">3</span>
            <a href="javascript:void(0)">4</a>
            <a href="javascript:void(0)" class="dots">···</a>
            <a href="javascript:void(0)">100</a>
            <a href="javascript:void(0)" class="arrow right"></a>
        </div>
    </div>
<? include "template/footer.php" ?>