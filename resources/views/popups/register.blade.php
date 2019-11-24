<div class="popup popup-auth">
    <div class="popup-title">Регистрация</div>
    <div class="base-form">
        <form action="javascript:void(0)" data-action="/popups/register/proccess" data-form-type="register">
            <div class="top-errors js-errors"></div>
            <label>
                <input type="text" name="login" autocomplete="off" required>
                <span>Логин</span>
            </label>
            <label>
                <input type="password" class="password" name="password">
                <span>Пароль</span>
            </label>
            <label>
                <input type="password" name="repeat-password" required>
                <span>Повторите пароль</span>
            </label>
            <label>
                <input type="text" inputmode="email" name="email" required>
                <span>Email</span>
            </label>
            <div class="btn-wrapper">
                <button class="btn">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</div>
