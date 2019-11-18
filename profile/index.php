<? $pageType = "profile";

use local\db\Story\Element as StoryElement;
use local\db\User\Element as UserElement;
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
                            <?
                            $model         = new UserElement();
                            $users         = $model->getList();
                            $currentAuthor = (int)$_GET["author"];
                            ?>
                            <? foreach ($users as $key => $user): ?>
                                <div class="author-card js-author<?= $user->ID == $currentAuthor ? " active" : "" ?>"
                                     data-id="<?= $user->ID ?>">
                                    <div class="avatar-container">
                                        <div class="avatar"
                                             style="background-image: url('<?= $user->AVATAR ?>')"></div>
                                    </div>
                                    <div class="author-name"><?= $user->LOGIN ?></div>
                                    <div class="arrow"></div>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="author-stories js-author-stories">
                            <div class="list-stories js-ajax-container" data-name="page2">
                                <?
                                $storyModel    = new StoryElement();
                                $filter        = [];
                                $currentAuthor = (int)$_GET["author"];
                                if ($currentAuthor) {
                                    $filter["AUTHOR"] = $currentAuthor;
                                }

                                if (!empty($filter)) {
                                    $stories = $storyModel->filter($filter)
                                        ->page(2, Helper::getCurPage("page2"), "page2")
                                        ->getList();

                                    foreach ($stories as $story): ?>
                                        <? Helper::render("/partials/story-item.php", [
                                            "item" => $story,
                                        ]); ?>
                                    <? endforeach; ?>
                                    <?= $storyModel->getPagen("page2") ?>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bookmark js-tabs__content">
                    <div class="list-stories js-ajax-container" data-name="page3">
                        <?

                        $model = new UserElement();
                        global $USER;
                        $curUser = $model->filter(["ID" => $USER->ID])->getList();

                        if (!empty($curUser)) {
                            $curUser = $curUser[0];
                        }
                        
                        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/local/log/log.txt", print_r($curUser->FAVORITES, true), FILE_APPEND); //todo remove!

                        foreach ($curUser->FAVORITES as $story): ?>
                            <? Helper::render("/partials/story-item.php", [
                                "item" => $story,
                            ]); ?>
                        <? endforeach; ?>
                        <?= $storyModel->getPagen("page3") ?>
                    </div>
                </div>
                <div class="js-tabs__content">
                    <div class="list-stories js-ajax-container" data-name="page4">
                        <?
                        $storyModel = new StoryElement();
                        $stories    = $storyModel->page(2, Helper::getCurPage("page4"), "page4")->getList();

                        foreach ($stories as $story): ?>
                            <? Helper::render("/partials/story-item.php", [
                                "item" => $story,
                            ]); ?>
                        <? endforeach; ?>
                        <?= $storyModel->getPagen("page4") ?>
                    </div>
                </div>
                <div class="js-tabs__content">
                    <div class="list-stories js-ajax-container" data-name="page5">
                        <?
                        $storyModel = new StoryElement();
                        $stories    = $storyModel->page(2, Helper::getCurPage("page5"), "page5")->getList();

                        foreach ($stories as $story): ?>
                            <? Helper::render("/partials/story-item.php", [
                                "item" => $story,
                            ]); ?>
                        <? endforeach; ?>
                        <?= $storyModel->getPagen("page5") ?>
                    </div>
                </div>
                <div class="js-tabs__content">
                    <div class="list-stories js-ajax-container" data-name="page6">
                        <?
                        $storyModel = new StoryElement();
                        $stories    = $storyModel->page(2, Helper::getCurPage("page6"), "page6")->getList();

                        foreach ($stories as $story): ?>
                            <? Helper::render("/partials/story-item.php", [
                                "item" => $story,
                            ]); ?>
                        <? endforeach; ?>
                        <?= $storyModel->getPagen("page6") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? include $_SERVER['DOCUMENT_ROOT'] . "/template/footer.php" ?>
