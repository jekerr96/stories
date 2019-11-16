<? $pageType = "profile";

use local\db\Story\Element as StoryElement;
use local\Helper; ?>
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
                    <div class="tab js-tabs__tab">Черновики</div>
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
                        <div class="author-stories js-ajax-pagination">
                            <div class="list-stories js-ajax-container">
                                <?
                                $storyModel = new StoryElement();
                                $stories    = $storyModel->page(2, Helper::getCurPage("page2"), "page2")->getList();

                                foreach ($stories as $story): ?>
                                    <? Helper::render("/partials/story-item.php", [
                                        "item" => $story,
                                    ]); ?>
                                <? endforeach; ?>
                                <?= $storyModel->getPagen("page2") ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bookmark js-tabs__content">
                    <div class="list-stories">
                        <?
                        $storyModel = new StoryElement();
                        $stories    = $storyModel->page(2, Helper::getCurPage("page3"), "page3")->getList();

                        foreach ($stories as $story): ?>
                            <? Helper::render("/partials/story-item.php", [
                                "item" => $story,
                            ]); ?>
                        <? endforeach; ?>
                        <?= $storyModel->getPagen("page3") ?>
                    </div>
                </div>
                <div class="js-tabs__content">
                    <div class="list-stories">
                        <?
                        $storyModel = new StoryElement();
                        $stories    = $storyModel->getList();

                        foreach ($stories as $story): ?>
                            <? Helper::render("/partials/story-item.php", [
                                "item" => $story,
                            ]); ?>
                        <? endforeach; ?>
                        <?= $storyModel->getPagen() ?>
                    </div>
                </div>
                <div class="js-tabs__content">
                    <div class="list-stories">
                        <?
                        $storyModel = new StoryElement();
                        $stories    = $storyModel->getList();

                        foreach ($stories as $story): ?>
                            <? Helper::render("/partials/story-item.php", [
                                "item" => $story,
                            ]); ?>
                        <? endforeach; ?>
                        <?= $storyModel->getPagen() ?>
                    </div>
                </div>
                <div class="js-tabs__content">
                    <div class="list-stories">
                        <?
                        $storyModel = new StoryElement();
                        $stories    = $storyModel->getList();

                        foreach ($stories as $story): ?>
                            <? Helper::render("/partials/story-item.php", [
                                "item" => $story,
                            ]); ?>
                        <? endforeach; ?>
                        <?= $storyModel->getPagen() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? include $_SERVER['DOCUMENT_ROOT'] . "/template/footer.php" ?>
