</main>
<div class="to-top js-to-top hidden"></div>
<? require $_SERVER['DOCUMENT_ROOT'] . "/partials/sticky-message.php" ?>
<?
$jsFileList = ['commons.chunk'];

if ($pageType) {
    $jsFileList[] = $pageType . ".bundle";
}

foreach ($jsFileList as $jsFilename):
    $jsFilePath = "/js/bundle/$jsFilename.js";
    if (!file_exists($_SERVER["DOCUMENT_ROOT"] . $jsFilePath)) continue;
    ?><script src="<?= $jsFilePath . '?' . filemtime($_SERVER["DOCUMENT_ROOT"] . $jsFilePath)?>"></script><?
endforeach;

?>
</body>
</html>
