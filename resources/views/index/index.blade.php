@extends("layout")
@section("content")
    <div class="container">
        <div class="content-wrapper">
            <div class="genres">
                <div class="genres-title js-genres-toggle-btn"><span>Поиск по жанрам</span></div>
                <div class="genres-wrapper js-toggle-genres" style="<?= isset($_GET["include"]) || isset($_GET["exclude"]) ? "" : "display: none;" ?>">
                    <? foreach ($genres as $genre): ?>
                    <a href="javascript:void(0)" class="js-genre">
                        <span class="genre-name"><?= $genre->name ?></span>
                        <span class="genre-actions">
                            <i class="plus js-plus<?= in_array($genre->id, $include) ? " active" : "" ?>"
                               data-id="<?= $genre->id ?>">+</i>
                            <i class="minus js-minus<?= in_array($genre->id, $exclude) ? " active" : "" ?>"
                               data-id="<?= $genre->id ?>">-</i>
                        </span>
                    </a>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="list-stories js-list-stories">
                <? foreach ($items as $item): ?>
                    @include("_partials.story-item")
                <? endforeach; ?>
                    {{ $items->appends(request()->input())->links() }}
            </div>
        </div>

    </div>
@endsection
