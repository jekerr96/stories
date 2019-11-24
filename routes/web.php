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

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Route::get('/', "StoryController@index");

Route::post('/', "StoryController@index");

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
        return response()->json(["name" => $login, "password" => $pass]);
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
