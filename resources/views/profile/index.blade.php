@extends("layout")
@section("content")
    <? use Illuminate\Support\Facades\Auth;
    $itsMe = Auth::user()->id == $user->id; ?>
    <div class="container">
        <div class="profile-container">
            <div class="tabs-container js-tabs">
                <div class="js-tabs__nav">
                    <div class="tabs-wrapper js-tabs__tabs-container">
                            <? if ($itsMe || $user->allow_favorites): ?>
                                <div class="tab js-tabs__tab">Избранные авторы</div>
                            <? endif; ?>
                                <? if ($itsMe || $user->allow_bookmarks): ?>
                                <div class="tab js-tabs__tab">Закладки</div>
                                <? endif; ?>
                                <? if ($itsMe || $user->allow_later): ?>
                                <div class="tab js-tabs__tab">Прочитать позже</div>
                                <? endif; ?>

                                <? if ($itsMe): ?>
                                <div class="tab js-tabs__tab">Мои работы</div>
                                <div class="tab js-tabs__tab">Черновики</div>
                                <? endif; ?>
                    </div>
                </div>
                <div class="profile-content js-tabs__content-container">
                    <? if ($itsMe || $user->allow_favorites): ?>
                    <div class="js-tabs__content active">
                        <div class="tab-author-wrapper">
                            <div class="list-authors">
                                <? foreach ($user->elects as $key => $elect): ?>
                                <div class="author-card<?= $favorite && $elect->id == $favorite ? " active" : "" ?>">
                                    <a href="?favorite=<?= $elect->id ?>" class="author-link"></a>
                                    <div class="avatar-container">
                                        <div class="avatar"
                                             style="background-image: url('<?= $elect->avatar ?>')"></div>
                                    </div>
                                    <div class="author-name"><?= $elect->name ?></div>
                                    <div class="arrow"></div>
                                </div>
                                <? endforeach; ?>
                            </div>
                            <div class="author-stories">
                                <div class="list-stories">
                                    <? $elect = $user->elects->where("id", $favorite)->first() ?>
                                    <? if ($elect && $elect->stories->count() > 0): ?>
                                    <? foreach ($elect->stories as $item): ?>
                                    @include("_partials.story-item")
                                    <? endforeach; ?>
                                    <? else: ?>
                                    <span>У автора нету историй</span>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? endif; ?>
                    <? if ($itsMe || $user->allow_bookmarks): ?>
                    <div class="bookmark js-tabs__content">
                        <div class="list-stories">
                            <? foreach ($user->bookmarks as $bookmark): ?>
                            <? $item = $bookmark->story ?>
                            @include("_partials.story-item")
                            <? endforeach; ?>
                        </div>
                    </div>
                    <? endif; ?>
                    <? if ($itsMe || $user->allow_later): ?>
                    <div class="js-tabs__content">
                        <div class="list-stories">
                            <? foreach ($user->later as $later): ?>
                            <? $item = $later->story; ?>
                            @include("_partials.story-item");
                            <? endforeach; ?>
                        </div>
                    </div>
                    <? endif; ?>

                    <? if ($itsMe): ?>
                    <div class="js-tabs__content">
                        <div class="list-stories">
                            <? foreach ($user->stories as $item): ?>
                            @include("_partials.story-item")
                            <? endforeach; ?>
                        </div>
                    </div>
                    <div class="js-tabs__content">
                        <div class="list-stories">
                            <? foreach ($user->stories->where("status", 0) as $item): ?>
                            @include("_partials.story-item")
                            <? endforeach; ?>
                        </div>
                    </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
@endsection
