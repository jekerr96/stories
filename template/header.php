<? require_once $_SERVER["DOCUMENT_ROOT"] . "/local/prolog.php" ?>
<!doctype html>
<html class="white" lang="ru">
<head>
    <link rel="stylesheet" href="/css/style.css?<?= filemtime($_SERVER['DOCUMENT_ROOT'] . "/css/style.css") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
</head>
<body class="<?= $pageType ?>-page">
<main>
    <header>
        <div class="container">
            <div class="header-wrapper">
                <div class="logo-container">
                    #ЛОГОТИП#
                </div>
                <div class="header-actions<?= $USER->isAuth() ? " auth js-header-profile" : "" ?>">
                    <? if (!$USER->isAuth()): ?>
                        <a href="javascript:void(0)" data-href="/partials/auth.php" class="js-fancy">Войти</a>
                        |
                        <a href="javascript:void(0)" data-href="/partials/register.php"
                           class="js-fancy">Регистрация</a>
                    <? else: ?>
                        <div class="header-profile">
                            <div class="avatar" style="background-image: url('<?= $USER->AVATAR ?>')"></div>
                            <div class="profile-name"><?= $USER->LOGIN ?></div>
                            <div class="header-profile-action-icon"></div>
                            <div class="header-profile-actions js-header-actions">
                                <a href="/profile/">Мой профиль</a>
                                <a href="/write/">Написать историю</a>
                                <a href="javascript:void(0)" data-href="/partials/support.php" class="js-fancy">Служба поддержки</a>
                                <a href="/settings/">Настройки</a>
                                <a href="javascript:void(0)" data-href="/partials/exit.php" class="js-fancy">Выход</a>
                            </div>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="search-wrapper">
            <form action="/">
                <label>
                    <input type="text" name="q" autocomplete="off" placeholder="Найти самую интересную историю">
                </label>
            </form>
        </div>
    </div>
