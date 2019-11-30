<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPHtmlParser\Dom;

class ParseController extends Controller
{
    public function parse($id, $page = 1) {
        set_time_limit(60000);
        switch ($id) {
            case 1: $this->parseXxxKniga($page); break;
        }
    }

    public function parseXxxKniga($page) {
        $stories = Story::query()->where("url", "like", "%xxx-kniga.net%")->get();
        $genres = Genre::query()->get();
        $existStories = [];
        $existGenres = [];

        foreach ($stories as $story) {
            $existStories[$story->url] = true;
        }

        foreach ($genres as $genre) {
            $existGenres[$genre->name] = $genre;
        }

        for ($i = 1; $i <= $page; $i++) {
            $dom = new Dom;
            $dom->loadFromUrl("https://xxx-kniga.net/catalog?page=" . $i);

            foreach ($dom->find(".catalog-tale__name") as $item) {
                if (array_key_exists("https://xxx-kniga.net" . $item->getAttribute("href"), $existStories)) continue;

                $itemDom = new Dom;
                $itemDom->loadFromUrl("https://xxx-kniga.net" . $item->getAttribute("href"));
                try {
                    $text = $itemDom->find(".tale-body")[0]->innerHtml;
                } catch (\Exception $e) {
                    continue;
                }

                $date = $itemDom->find(".tale-info-content__text")[0]->text;
                $story = new Story();
                $story->name = $item->text;
                $story->detail = $text;
                $story->preview = strip_tags(mb_substr($text, 0, 100)) . "...";
                $story->public_date = date("Y.m.d", strtotime($date));
                $story->url = "https://xxx-kniga.net" . $item->getAttribute("href");
                try {
                    $story->save();
                } catch (\Exception $e) {
                    echo "ошибка " . $story->url . "<br>Страница $i<br>";
                    continue;
                }

                foreach ($itemDom->find(".tale-header__tag") as $tag) {
                    $exGenre = true;

                    if (array_key_exists($tag->text, $existGenres)) {
                        $genre = $existGenres[$tag->text];
                    } else {
                        $genre = new Genre();
                        $exGenre = false;
                    }

                    $genre->name = $tag->text;
                    $genre->save();

                    if (!$exGenre) {
                        $existGenres[$genre->name] = $genre;
                    }

                    DB::table("genre_story")->insert([
                        "story_id" => $story->id,
                        "genre_id" => $genre->id
                    ]);
                }
            }
        }
    }
}
