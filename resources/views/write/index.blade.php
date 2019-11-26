@extends("layout")
@section("content")
    <div class="container">
        <div class="write-container">
            <form action="write/save" class="base-form" data-form-type="write">
                <label>
                    <input type="text" name="name" autocomplete="off" value="<?= $story ? $story->name : "" ?>">
                    <span>Название истории</span>
                </label>
                <label>
                    <textarea name="preview" cols="30" rows="10" maxlength="1000"><?= $story ? $story->preview : "" ?></textarea>
                    <span>Описание</span>
                </label>
                <label>
                    <select name="genre" multiple class="js-select">
                        <?
                        $sortGenres = [];
                        if ($story) {
                            $storyGenres = $story->genres;
                            foreach ($storyGenres as $storyGenre) {
                                $sortGenres[$storyGenre->id] = true;
                            }
                        }
                        ?>
                        <? foreach ($genres as $genre): ?>
                            <option <?= array_key_exists($genre->id, $sortGenres) ? "selected" : "" ?> value="<?= $genre->id ?>"><?= $genre->name ?></option>
                        <? endforeach; ?>
                    </select>
                </label>
                <div class="editor js-editor"><?= $story ? $story->detail : "" ?></div>
                <div class="btn-wrapper-write">
                    <div class="btn js-fancy" data-href="<?= "/partials/preview.php" ?>">Предварительный просмотр</div>
                    <button name="save-draft" class="btn">Сохранить в черновик</button>
                    <button name="save-public" class="btn">Опубликовать</button>
                </div>
            </form>
        </div>
    </div>
@endsection
