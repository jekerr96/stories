<?php
use Illuminate\Support\Facades\Auth;
?>
@extends("layout")
@section("content")
    <div class="container">
        <div class="settings-wrapper">
            <div class="line-container">
                <form action="/settings/apply" method="post" class="base-form" data-form-type="settings">
                    <div class="profile-container">
                        <div class="name-wrapper">
                            <div class="name"><?= Auth::user()->name ?></div>
                        </div>
                        <div class="avatar-wrapper">
                            <div class="image-wrapper">
                                <img class="avatar js-avatar-image"
                                     src="<?= asset("storage/" . Auth::user()->avatar) ?>"
                                     alt="">
                            </div>
                            <a href="javascript:void(0)" class="change-avatar js-change-avatar">Сменить аватарку</a>
                        </div>
                    </div>

                    <div class="sections-container">
                        <input type="file" name="avatar" class="js-input-avatar" hidden accept="image/*">
                        <div class="section">
                            <div class="section-title">Смена Email</div>
                            <label>
                                <input type="email" name="email" value="<?= Auth::user()->email ?>">
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
                                <input type="checkbox" name="authors" <?= Auth::user()->allow_favorites ? "checked" : "" ?>>
                                <span>Разрешить доступ к избранным авторам</span>
                            </label>
                            <label>
                                <input type="checkbox" name="bookmarks" <?= Auth::user()->allow_bookmarks ? "checked" : "" ?>>
                                <span>Разрешить доступ к закладкам</span>
                            </label>
                            <label>
                                <input type="checkbox" name="see-later" <?= Auth::user()->allow_later ? "checked" : "" ?>>
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
@endsection
