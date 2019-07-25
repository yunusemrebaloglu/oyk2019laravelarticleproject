@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

					@if(request()->route()->named('article.tagInArticles'))
					{{$tag->tag}} Etiketinin Yazıları
					@elseif(request()->route()->named('users.article'))
					{{$user->name}} Kişisinin Yazıları
					@else
					Tüm Makaleler
					@endif
					<a class="btn btn-primary btn-sm float-right " href="{{route('article.create')}}">New article</a>
				</div>

                <div class="card-body">
					@foreach($articles as $article)
					<hr>
					<div class="row">
						<div class="col-md-4">
							<a href="{{route('article.detail',$article->id)}}">{{$article->title}}</a><br>
						</div>
						<div class="col-md-4">
							{{$article->updated_at}}
						</div>
						<div class="col-md-4">
							{{$article->created_at}}
						</div>
					</div>

					{{$article->content}}
					@endforeach
                </div>
				<div class="card-footer">
					{{ $articles->links() }}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
