<html>
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
                <div class="header-actions<?= $_GET["AUTH"] ? " auth js-header-profile" : "" ?>">
                    <? if (!$_GET["AUTH"]): ?>
                        <a href="javascript:void(0)" data-href="/partials/auth.php" class="js-fancy">Войти</a>
                        |
                        <a href="javascript:void(0)" data-href="/partials/register.php"
                           class="js-fancy">Регистрация</a>
                    <? else: ?>
                        <div class="header-profile">
                            <div class="avatar" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXBKDAHjWPEv-GURolfl5Lx_uQuj2DR6Zd8lJnrEtKbxJr3o4KA&s')"></div>
                            <div class="profile-name">#NICKNAME#</div>
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
