<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //te redirecciona login por defailt
        $this->middleware('auth');
    }

    //se llama automaticamente, ya no es necesario en web.php poner index
    public function __invoke()
    {
        //Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
