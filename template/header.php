<html>
<head>
    <link rel="stylesheet" href="/css/style.css?<?= filemtime($_SERVER['DOCUMENT_ROOT'] . "/css/style.css") ?>">
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
                <div class="header-actions">
                    <a href="javascript:void(0)" data-href="/partials/auth.php" class="btn js-fancy">Войти</a>
                    |
                    <a href="javascript:void(0)" class="btn">Регистрация</a>
                </div>
            </div>
        </div>
    </header>
