<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index(Request $request) {
        $include = [];
        $exclude = [];
        $search = $request->get("q");

        if ($request->get("include")) {
            $include = explode(",", $request->get("include"));
        }

        if ($request->get("exclude")) {
            $exclude = explode(",", $request->get("exclude"));
        }

        $query = Story::query();

        if ($include) {
            $query->whereIn("id", function($query) use ($include) {
                $query->select("story_id")
                    ->from("genre_story")
                    ->whereIn("genre_id", $include);
            });
        }

        if ($exclude) {
            $query->whereNotIn("id", function($query) use ($exclude) {
                $query->select("story_id")
                    ->from("genre_story")
                    ->whereIn("genre_id", $exclude);
            });
        }

        if ($search) {
            $query->where("name", "like", "%$search%");
        }

        $items = $query->paginate();

        if ($request->ajax()) {
            return view("index.ajax-filter", [
                "items" => $items,
            ]);
        }

        $genres = Genre::query()->get();
        return view('index.index', [
            "pageType" => "main",
            "items" => $items,
            "genres" => $genres,
            "include" => $include,
            "exclude" => $exclude,
        ]);
    }

    public function detail(Request $request, $id) {
        $story = Story::query()->where("id", $id)->first();

        if (!$story) {
            abort(404);
        }

        return view("index.detail", ["title" => $story->name, "pageType" => "story", "story" => $story]);
    }
}
