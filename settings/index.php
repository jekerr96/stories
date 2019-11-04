<? $pageType = "settings" ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/template/header.php" ?>

<div class="container">
    <div class="settings-wrapper">
        <div class="line-container">
            <form action="javascript:void(0)" class="base-form" data-form-type="settings">
                <div class="profile-container">
                    <div class="name-wrapper">
                        <div class="name">#NICKNAME#</div>
                    </div>
                    <div class="avatar-wrapper">
                        <div class="image-wrapper">
                            <img class="avatar js-avatar-image"
                                 src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXBKDAHjWPEv-GURolfl5Lx_uQuj2DR6Zd8lJnrEtKbxJr3o4KA&s"
                                 alt="">
                        </div>
                        <button class="change-avatar js-change-avatar">Сменить аватарку</button>
                    </div>
                </div>

                <div class="sections-container">
                    <input type="file" class="js-input-avatar" hidden accept="image/*">
                    <div class="section">
                        <div class="section-title">Смена Email</div>
                        <label>
                            <input type="email" name="email">
                            <span>Email</span>
                        </label>
                    </div>
                    <div class="section">
                        <div class="section-title">Смена пароля</div>
                        <label>
                            <input type="password" name="curPass">
                            <span>Текущий пароль</span>
                        </label>
                        <label>
                            <input type="password" name="newPass">
                            <span>Новый пароль</span>
                        </label>
                        <label>
                            <input type="password" name="repeatPass">
                            <span>Повторите пароль</span>
                        </label>
                    </div>
                    <div class="section">
                        <div class="section-title">Доступ к профилю</div>
                        <label>
                            <input type="checkbox" name="authors">
                            <span>Разрешить доступ к избранным авторам</span>
                        </label>
                        <label>
                            <input type="checkbox" name="bookmarks">
                            <span>Разрешить доступ к  закладкам</span>
                        </label>
                        <label>
                            <input type="checkbox" name="see-later">
                            <span>Разрешить доступ к прочитать позже</span>
                        </label>
                    </div>
                    <div class="section">
                        <div class="btn-wrapper">
                            <button class="btn">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<? include $_SERVER['DOCUMENT_ROOT'] . "/template/footer.php" ?>
