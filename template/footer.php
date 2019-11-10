</main>
<div class="to-top js-to-top hidden"></div>
<? require $_SERVER['DOCUMENT_ROOT'] . "/partials/sticky-message.php" ?>
<script src="/js/bundle/<?= $pageType ?>.bundle.js?<?= filemtime($_SERVER['DOCUMENT_ROOT'] . "/js/bundle/". $pageType .".bundle.js") ?>"></script>
</body>
</html>
