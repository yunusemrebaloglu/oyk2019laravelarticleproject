<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Article;
use Illuminate\Support\Facades\Storage;
use Notification;

class UserController extends Controller
{
	public function index()
	{
		$users =User::latest()->paginate(5);
		return view('user.index', compact('users'));

	}
	public function article(User $user)
	{
		$articles = $user->articles()->latest()->paginate(5);
		return view('article.index', compact('articles','user'));

	}
	public function profile(User $user)
	{
		$articles = $user->articles()->latest()->paginate(10);
		return view('user.profile', compact('user','articles'));

	}
	public function update(Request $request,User $user)
	{
		// dd($request->name);
		$request->validate([
			'name' => 'required|string',
			'birthday' => 'nullable|string',
			'email' => 'required|string',
			'profile_image' => 'nullable|image',
			'password' => 'nullable|string',
		]);
		$user->name = $request->name;
		$user->email = $request->email;
		if ($request->birthday) $user->birthday = $request->birthday;
		if($request->profile_image)
		{
			$path = $request->file('profile_image')->store('public/app/articlePhoto');
			$user->profile_image = $path;
		}
		$user->save();
		// dd($user->name);
		return back();

	}

	public function follower(Request $request,User $user)
	{
		$request->user()->follow($user);
		return redirect(route('users.profile',$user));
	}
	public function unfollower(Request $request,User $user)
	{
		$request->user()->unfollow($user);
		return redirect(route('users.profile',$user));
	}

	public function followlist(User $user, $fallow)
	{
		$users = $user->$fallow;
		return view('user.index',compact('users'));
	}

	public function notificationRead($notification)
	{
		$notification = Auth::user()->notifications->find($notification);
		// $notification = Auth::user()->notifications();
		// dd($notification);
		// dd($notification->id);
		$notification->markAsRead();
		// dd($notification);

		return redirect($notification->data['action']);
	}

	public function commentedArticles()
	{
		$articles=request()->user()->commentedArticles;
		return $articles;


	}


}
