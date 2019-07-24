@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Article Detail
					@auth
					@if($article->user->id === Auth::user()->id)
					<a class="btn btn-primary btn-sm float-right mx-2" href="{{route('article.edit',$article->id)}}">Edit article</a>
					@endif
					<a class="btn btn-primary btn-sm float-right mx-2" href="{{route('article.create')}}">New article</a>
					@endauth
					<a class="btn btn-primary btn-sm float-right mx-2" href="{{route('article.index')}}">All Article</a>
				</div>

				<div class="card-body">
					{{$article->id}}<br>
					{{$article->title}}<br>
					{{$article->content}}<br>
					{{$article->updated_at}}<br>
					{{$article->created_at}}<br>
					<hr>
					@foreach($article->tags as $tag)
					<a href="{{route('article.tagInArticles',$tag->id)}}">{{$tag->tag}}</a>
					@endforeach
				</div>
				<br>
				<div class="m-3">
					<a href="{{route('users.article', $article->user->id)}}">{{$article->user->name}}</a>

					{{$article->created_at->locale('tr')->diffForHumans()}}
				</div>
				@auth
				@if($article->user->id === Auth::user()->id)
				<div class="card-footer">

					<form action="{{route('article.destroy', $article->id )}}"  method="post">
						@csrf
						{{ method_field('DELETE') }}
						<button class="btn btn-danger btn-sm float-right mx-2">Delete Article</button>
					</form>
				</div>
				@endif
				@endauth
			</div>
			<div class="card p-2 mt-2">
				@guest
				<p>Yorum yapmak için lütfen giriş yapın</p>
				@else
				<div class="card-header">
					Yeni Yorum Ekle
				</div>
				<div class="card-body">
					<form action="{{route('articles.addComment', $article->id)}}" method="post">
						@csrf
						<textarea name="body" class="form-control mb-2" placeholder="Yeni Yorum "></textarea>
						<button type="submit" class="form-control btn btn-primary" name="button"> Ekle</button>
					</form>
				</div>
				@endguest
				@include('article.comment', ['comments' => $article->topLevelComments])
			</div>


		</div>
	</div>
</div>
@endsection
