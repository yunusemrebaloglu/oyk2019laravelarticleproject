<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
class UserController extends Controller
{
    public function index()
	{
		$users =User::latest()->paginate(1);
		return view('users.index', compact('users'));

	}
    public function article(User $user)
	{
		$articles = $user->articles()->latest()->paginate(5);
		return view('article.index', compact('articles','user'));

	}
}
