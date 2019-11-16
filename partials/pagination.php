<? use local\Helper; ?>
<div class="page-navigation">
    <?
    $pagenName = $this->PAGEN_NAME;
    $curPage   = Helper::getCurPage($pagenName);
    $count     = ceil($this->ALL / $this->COUNT);
    $startDots = false;
    $endDots   = false;

    if ($curPage > $count) $curPage = 1;

    if ($count < 2) {
        echo "</div>";
        return;
    }

    if ($curPage - 2 > 1) {
        $start = $curPage - 2;
    } else {
        $start = 2;
    }

    if ($curPage + 2 < $count) {
        $end = $curPage + 2;
    } else {
        $end = $count;
    }

    if ($curPage - 3 > 1) {
        $startDots = true;
    }

    if ($curPage + 3 < $count) {
        $endDots = true;
    }
    ?>
    <? if ($curPage && $curPage > 1): ?>
        <a href="<?= Helper::getUrl([$pagenName => ($curPage - 1)]) ?>" class="arrow left"></a>
    <? endif; ?>
    <? if ($count !== 1): ?>
        <? if ($curPage == 1): ?>
            <span class="active">1</span>
        <? else: ?>
            <a href="<?= Helper::getUrl([$pagenName => ""]) ?>">1</a>
        <? endif; ?>
    <? endif; ?>
    <? if ($startDots): ?>
        <a href="<?= Helper::getUrl([$pagenName => (ceil((1 + $start) / 2))]) ?>" class="dots">···</a>
    <? endif; ?>
    <? for ($i = $start; $i <= $end; $i++): ?>
        <? if ($curPage == $i): ?>
            <span class="active"><?= $i ?></span>
        <? else: ?>
            <a href="<?= Helper::getUrl([$pagenName => $i]) ?>"><?= $i ?></a>
            <? if ($i == $end && $endDots): ?>
                <a href="<?= Helper::getUrl([$pagenName => ceil(($count + $end) / 2)]) ?>" class="dots">···</a>
            <? endif ?>
        <? endif; ?>
    <? endfor; ?>
    <? if ($end != $count): ?>
        <a href="<?= Helper::getUrl([$pagenName => $count]) ?>"><?= $count ?></a>
    <? endif; ?>
    <? if ($curPage != $count): ?>
        <a href="<?= Helper::getUrl([$pagenName => ($curPage + 1)]) ?>" class="arrow right"></a>
    <? endif; ?>
</div>