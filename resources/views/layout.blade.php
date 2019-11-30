<?php
use Illuminate\Support\Facades\Auth;
?>
<html class="white" lang="ru">
<head>
    <link rel="stylesheet" href="/css/style.css?<?= filemtime($_SERVER["DOCUMENT_ROOT"] . "/css/style.css") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?= isset($title) ? $title . " — Pornotale" : "Порно истории — Pornotale" ?></title>
</head>
<body class="<?= $pageType ?>-page">
<main>
    <header>
        <div class="container">
            <div class="header-wrapper">
                <div class="logo-container">
                    <a href="/">
                        <img src="/images/logo.png" alt="pornotale">
                    </a>

                </div>
                <div class="search-wrapper">
                    <form action="/" class="js-search-form">
                        <label>
                            <input type="text" name="q" autocomplete="off" placeholder="Найти самую интересную историю" value="<?= isset($_GET["q"]) ? $_GET["q"] : ""  ?>">
                        </label>
                    </form>
                </div>
                <? /*
                <div class="header-actions<?= true ? " auth js-header-profile" : "" ?>"><? // auth ?>
                    <? if (!Auth::check()): ?>
                    <a href="javascript:void(0)" data-href="/popups/auth/" class="js-fancy">Войти</a>
                    |
                    <a href="javascript:void(0)" data-href="/popups/register/"
                       class="js-fancy">Регистрация</a>
                    <? else: ?>
                    <div class="header-profile">
                        <div class="avatar"
                             style="background-image: url('<?= asset("storage/" . Auth::user()->avatar) ?>')"></div>
                        <div class="profile-name"><?= Auth::user()->name ?></div>
                        <div class="header-profile-action-icon"></div>
                        <div class="header-profile-actions js-header-actions">
                            <a href="/profile/">Мой профиль</a>
                            <a href="/write/">Написать историю</a>
                            <a href="javascript:void(0)" data-href="/partials/support.php"
                               class="js-fancy">Служба поддержки</a>
                            <a href="/settings/">Настройки</a>
                            <a href="javascript:void(0)" data-href="/popups/exit" class="js-fancy">Выход</a>
                        </div>
                    </div>
                    <? endif; ?>
                </div>
 */ ?>
            </div>
        </div>
    </header>
    <div class="container">

    </div>

    @yield("content")

</main>
<div class="to-top js-to-top hidden"></div>
{{--@include("_partials.sticky-message")--}}
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

