@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row d-flex justify-content-between">
		<div class="col-md-3">


			<div class="card  mb-3 justify-content-center text-center" >

				<img src="{{asset(Storage::url($user->profile_image))}}" class="card-img-top img-thumbnail shadow-lg bg-white" >
				<div class="card-body">
					<h5 class="card-title">{{$user->name}}</h5>
					<p class="card-text">
						{{$user->email}} <br>
						<a href="{{route('users.followList',[$user, 'followees'])}}">
							{{$user->followees()->count()}} Kişiyi Takip Ediyor <br>
						</a>
						<a href="{{route('users.followList',[$user, 'followers'])}}">
							{{$user->followers()->count()}} Takipçisi Var. <br>
						</a>
						{{$user->age}} yaşında</p>
						@auth
						@if($user->id === Auth::user()->id)
						<a href="{{route('article.create')}}"  class="btn btn-secondary btn-sm float-left"> Yeni Makale</a>

						<a class="btn btn-primary btn-sm float-right " href="#" data-toggle="modal" data-target="#exampleModal">Profil Düzenle</a>
						@include('user.update', ['user' => $user])
						@else

						@if(Auth::user()->isFollowing($user))
						<a class="btn btn-secondary btn-sm float-right" href="{{route('users.unfollower',$user)}}">unfollower</a>
						@else
						<a class="btn btn-primary btn-sm float-right" href="{{route('users.follower',$user)}}">follower</a>
						@endif
						@endif
						@endauth

					</div>
				</div>
			</div>
			<div class="col-md-9 row">
				@include('helpers.card',['articles' => $articles])
			</div>
		</div>
	</div>
</div>
@endsection
