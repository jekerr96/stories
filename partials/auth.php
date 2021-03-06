<div class="popup popup-auth">
    <div class="popup-title">Вход</div>
    <div class="base-form">
        <form action="/ajax/auth/" data-form-type="auth">
            <div class="top-errors js-errors"></div>
            <label>
                <input type="text" name="login" required max="=50" maxlength="50" autocomplete="off">
                <span>Логин</span>
            </label>
            <label>
                <input type="password" max="50" maxlength="50" name="password">
                <span>Пароль</span>
            </label>
            <div class="btn-wrapper">
                <button class="btn">Войти</button>
                <div class="restore">
                    <a href="javascript:void(0)" data-href="/partials/restore.php" class="underline js-fancy">Забыли логин или пароль?</a>
                </div>
            </div>
        </form>
    </div>
</div>