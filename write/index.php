<? $pageType = "write" ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/template/header.php" ?>
<div class="container">
    <div class="write-container">
        <form action="javascript:void(0)" class="base-form">
            <label>
                <input type="text" name="name" autocomplete="off">
                <span>Название истории</span>
            </label>
            <label>
                <textarea name="preview" cols="30" rows="10" maxlength="1000"></textarea>
                <span>Описание</span>
            </label>
            <label>
                <select name="genre" multiple class="js-select">
                    <option value="">Жанр 1</option>
                    <option value="">Жанр 2</option>
                    <option value="">Жанр 3</option>
                    <option value="">Жанр 4</option>
                    <option value="">Жанр 5</option>
                </select>
            </label>
            <div class="editor js-editor"></div>
        </form>
    </div>
</div>
<? include $_SERVER['DOCUMENT_ROOT'] . "/template/footer.php" ?>
