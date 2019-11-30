@extends("layout")
@section("content")
    <div class="container">
        <div class="story-container">
            <div class="story-header-container">
{{--                <div class="author-container">--}}
{{--                    <div class="author-avatar"--}}
{{--                         style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXBKDAHjWPEv-GURolfl5Lx_uQuj2DR6Zd8lJnrEtKbxJr3o4KA&s')"></div>--}}
{{--                    <div class="author-name">#NICKNAME#</div>--}}
{{--                </div>--}}
                <div class="header-info">
{{--                    <div class="author-container mobile">--}}
{{--                        <div class="author-avatar"--}}
{{--                             style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXBKDAHjWPEv-GURolfl5Lx_uQuj2DR6Zd8lJnrEtKbxJr3o4KA&s')"></div>--}}
{{--                        <div class="author-name">#NICKNAME#</div>--}}
{{--                    </div>--}}
                    <div class="story-name"><?= $story->name ?></div>
                    <div class="story-date"><?= date("d.m.Y", strtotime($story->public_date)) ?></div>
                    <div class="genres-and-vote">
                        <div class="list-genres">
                            <? foreach ($story->genres as $genre): ?>
                                <a href="<?= $genre->getSrc() ?>"><?= $genre->name ?></a>
                            <? endforeach; ?>
                        </div>
{{--                        <div class="votes-container">--}}
{{--                            <div class="star-vote js-vote">--}}
{{--                                <div class="line-vote js-line-vote"></div>--}}
{{--                                <img src="/images/stars.png" alt="star" class="star-vote">--}}
{{--                            </div>--}}
{{--                            <div class="current-rating">4.2</div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="line"></div>
                    <div class="change-font-size">
                        <div class="change-font-title">Сменить размер шрифта</div>
                        <select name="" id="" class="js-select js-font-size">
                            <? for ($i = 8; $i < 21; $i += 2): ?>
                            <option <?= $i == 10 ? "selected" : "" ?> value="<?= $i * 10 ?>"><?= $i * 10 ?>%</option>
                            <? endfor; ?>
                        </select>
                    </div>
                    <div class="text-container js-text-container">
                        <?= $story->detail ?>
                    </div>
                </div>
            </div>

{{--            <div class="reviews-container">--}}
{{--                <form action="" class="review">--}}
{{--                    <textarea name="review" class="review-textarea" placeholder="Оставить отзыв"></textarea>--}}
{{--                    <div class="btn-wrapper">--}}
{{--                        <button class="btn">Отправить</button>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--                <div class="list-reviews">--}}
{{--                    <div class="review-item">--}}
{{--                        <div class="author-container">--}}
{{--                            <div class="author-avatar"--}}
{{--                                 style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXBKDAHjWPEv-GURolfl5Lx_uQuj2DR6Zd8lJnrEtKbxJr3o4KA&s')"></div>--}}
{{--                            <div class="author-name">#NICKNAME#</div>--}}
{{--                        </div>--}}
{{--                        <div class="reviews-text-container">--}}
{{--                            <div class="author-container mobile">--}}
{{--                                <div class="author-avatar"--}}
{{--                                     style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXBKDAHjWPEv-GURolfl5Lx_uQuj2DR6Zd8lJnrEtKbxJr3o4KA&s')"></div>--}}
{{--                                <div class="author-name">#NICKNAME#</div>--}}
{{--                            </div>--}}
{{--                            <div class="review-text">--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque debitis error fugit nihil, perspiciatis sunt voluptates. Commodi culpa, debitis enim eveniet expedita iusto laboriosam modi quas rerum soluta. Ab atque culpa cumque debitis eligendi, error exercitationem facere id minus numquam porro repellendus saepe, temporibus vero voluptatibus? Ab accusamus architecto, beatae deserunt earum sapiente sit. Aperiam asperiores cumque deserunt distinctio, doloribus eius error excepturi maiores nulla reprehenderit soluta sunt, ut voluptate. Accusantium aliquid animi asperiores aut consectetur consequuntur eveniet ex exercitationem id magni natus, odio provident, qui quis quod sequi suscipit voluptatibus? A adipisci aliquid deleniti id labore molestiae porro quas.--}}
{{--                            </div>--}}
{{--                            <div class="review-tools">--}}
{{--                                <div class="btn">Ответить</div>--}}
{{--                                <div class="btn">Редактировать</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
