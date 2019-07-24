@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			@error('title')
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				{{ $message }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@enderror
			@error('content')
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				{{ $message }}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			@enderror
			<div class="card">
				<div class="card-header">Edit Article
					<a class="btn btn-primary btn-sm float-right" href="{{route('article.index')}}">All Article</a>
				</div>

				<div class="card-body">
					<form action="{{route('article.update',$article->id)}}" method="post">
						@csrf
						{{ method_field('PUT') }}
						<input type="text" name="title" class="form-control mt-2" placeholder="Title" value="{{$article->title}}">
						<input type="text" name="tags" placeholder="Lütfen etiketleri virgül ile ayırın." value="{{$article->tags->implode('tag',',')}}" class="form-control mt-2">

						<textarea name="content" class="form-control mt-2" rows="8" cols="80" placeholder="Content">{{$article->content}}</textarea>
						<button type="submit" class="btn btn-primary form-control mt-2" name="button"> Send</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
