<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Genre;
use App\Story;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

Route::get('/', "StoryController@index");

Route::post('/', "StoryController@index");

Route::get("/stories/{id}", "StoryController@detail");

Route::get('/popups/auth', function(Request $request) {
    return view("popups.auth");
});

Route::get('/popups/register', function(Request $request) {
    return view("popups.register");
});

Route::get("/popups/exit", function() {
    return view("popups.exit");
});

Route::post("/popups/auth/proccess", function(Request $request) {
    $login = $request->post("login");
    $pass = $request->post("password");

    if (Auth::attempt(["name" => $login, "password" => $pass])) {
        return response()->json([
           "auth" => true,
        ]);
    } else {
        return response()->json(["errors" => "Неверный логин или пароль"]);
    }
});

Route::post("/popups/register/proccess", function(Request $request) {
    $error = [];
    $login = $request->post("login");
    $pass = $request->post("password");
    $repeatPass = $request->post("repeat-password");
    $email = $request->post("email");

    if ($pass != $repeatPass) {
        $error["fields"]["password"] = "Пароли не совпадают";
        $error["fields"]["repeat-password"] = "Пароли не совпадают";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["fields"]["email"] = "Некорректный email";
    }

    $existUser = User::query()->where("name", $login)->orWhere("email", $email)->get();

    if ($existUser->count() > 0) {
        $existUser = $existUser->first();

        if ($existUser->email == $email) {
            $error["fields"]["email"] = "Данный email уже занят";
        }

        if ($existUser->name == $login) {
            $error["fields"]["login"] = "Данный логин уже занят";
        }
    }

    if (!empty($error)) {
        return response()->json($error);
    }

    $user = new User();
    $user->name = $login;
    $user->password = Hash::make($pass);
    $user->email = $email;
    $result = $user->save();

    if ($result) {
        Auth::login($user, true);
    }

    return response()->json([
        "success" => true,
    ]);
});

Route::post("/popups/exit/proccess", function() {
   Auth::logout();

   return response()->json(["success" => true]);
});

Route::get("profile/{user?}", function(Request $request, $user = null) {
    if (is_null($user)) {
        $user = Auth::user();
    } else {
        $user = User::query()->where("id", $user)->first();
    }

    if (!$user) {
        abort(404);
    }

    $favorite = $request->get("favorite");

    return view("profile.index", ["pageType" => "profile", "user" => $user, "favorite" => $favorite]);
});

Route::get("/settings", function() {
    if (!Auth::check()) {
        return redirect("");
    }

    return view("settings.index", ["pageType" => "settings"]);
});

Route::post("/settings/apply", function(Request $request) {
    $avatar = $request->file("avatar");
    $email = $request->post("email");
    $curPass = $request->post("curPass");
    $newPass = $request->post("newPass");
    $repeatPass = $request->post("repeatPass");
    $allowAuthors = $request->post("authors");
    $allowBookmarks = $request->post("bookmarks");
    $allowLater = $request->post("see-later");
    $result = [];

    if ($avatar) {
        if (explode("/", $avatar->getClientMimeType())[0] == "image") {
            if (Auth::user()->avatar != "avatars/no-avatar.png") {
                File::delete("storage/" . Auth::user()->avatar);
            }

            Auth::user()->avatar = $avatar->store("avatars");
        } else {
            $result["errors"] = "Ошибка загрузки аватара";
        }
    }

    if ($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result["fields"]["email"] = "Некорректный email";
        } else {
            Auth::user()->email = $email;
        }
    }

    if ($newPass) {
        if (Hash::check($curPass, Auth::user()->password)) {
            if ($newPass == $repeatPass) {
                Auth::user()->password = Hash::make($newPass);
            } else {
                $result["fields"]["newPass"] = "Пароли не совпадают";
                $result["fields"]["repeatPass"] = "Пароли не совпадают";
            }
        } else {
            $result["fields"]["curPass"] = "Неверный пароль";
        }
    }

    Auth::user()->allow_favorites = !!$allowAuthors;
    Auth::user()->allow_bookmarks = !!$allowBookmarks;
    Auth::user()->allow_later = !!$allowLater;

    if (empty($result)) {
        $result["success"] = true;
    }

    Auth::user()->save();
    return response()->json($result);
});

Route::get("/write/{id?}", function($id = null) {
    $story = false;
    $genres = Genre::query()->get();

    if ($id) {
        $story = Story::query()->where("id", $id)->first();
    }

    return view("write.index", ["pageType" => "write", "story" => $story, "genres" => $genres]);
});

Route::post("write/save/{id?}", function(Request $request, $id = null) {
     $name = $request->post("name");
     $preview = $request->post("preview");
     $genre = $request->post("genre");
     $text = $request->post("text");

     if ($id) {
         $story = Story::query()->where("id", $id)->first();
         if ($story->author_id != Auth::user()->id) {
             return response()->json(["errors" => "Неверный id"]);
         }
     } else {
         $story = new Story();
     }

     $story->name = $name;
     $story->preview = $preview;
     $story->detail = $text;
     $story->author = Auth::user()->id;
     $story->public_date = time();
     $story->save();


     return response()->json(["success" => true]);
});
