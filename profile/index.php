<? $pageType = "profile" ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/template/header.php" ?>
<div class="container">
    <div class="profile-container">
        <div class="tabs-container js-tabs">
            <div class="js-tabs__nav">
                <div class="tabs-wrapper js-tabs__tabs-container">
                    <div class="tab js-tabs__tab active">Избранные авторы</div>
                    <div class="tab js-tabs__tab">Закладки</div>
                    <div class="tab js-tabs__tab">Прочитать позже</div>
                    <div class="tab js-tabs__tab">Мои работы</div>
                </div>
            </div>
            <div class="profile-content js-tabs__content-container">
                <div class="js-tabs__content active">
                    <div class="tab-author-wrapper">
                        <div class="list-authors">
                            <? for ($i = 0; $i < 10; $i++): ?>
                                <div class="author-card<?= $i == 1 ? " active" : "" ?>">
                                    <div class="avatar-container">
                                        <div class="avatar"
                                             style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXBKDAHjWPEv-GURolfl5Lx_uQuj2DR6Zd8lJnrEtKbxJr3o4KA&s')"></div>
                                    </div>
                                    <div class="author-name">#NICKNAME#</div>
                                    <div class="arrow"></div>
                                </div>
                            <? endfor; ?>
                        </div>
                        <div class="author-stories">
                            <div class="list-stories">
                                <? for ($i = 0; $i < 10; $i++): ?>
                                    <? require $_SERVER["DOCUMENT_ROOT"] . "/partials/story-item.php" ?>
                                <? endfor; ?>
                            </div>
                            <? require $_SERVER["DOCUMENT_ROOT"] . "/partials/pagination.php" ?>
                        </div>
                    </div>
                </div>
                <div class="bookmark js-tabs__content">
                    <div class="list-stories">
                        <? for ($i = 0; $i < 10; $i++): ?>
                            <? require $_SERVER["DOCUMENT_ROOT"] . "/partials/story-item.php" ?>
                        <? endfor; ?>
                    </div>
                    <? require $_SERVER["DOCUMENT_ROOT"] . "/partials/pagination.php" ?>
                </div>
                <div class="js-tabs__content">
                    <div class="list-stories">
                        <? for ($i = 0; $i < 10; $i++): ?>
                            <? require $_SERVER["DOCUMENT_ROOT"] . "/partials/story-item.php" ?>
                        <? endfor; ?>
                    </div>
                </div>
                <div class="js-tabs__content">
                    <div class="list-stories">
                        <? for ($i = 0; $i < 10; $i++): ?>
                            <? require $_SERVER["DOCUMENT_ROOT"] . "/partials/story-item.php" ?>
                        <? endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? include $_SERVER['DOCUMENT_ROOT'] . "/template/footer.php" ?>
