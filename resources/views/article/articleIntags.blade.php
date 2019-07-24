@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Tags</div>

				<div class="card-body">
					<div class="list-group">
						@foreach($tags as $tag)
						<a class="list-group-item list-group-item-action" href="{{route('article.tagInArticles',$tag->id)}}">{{$tag->tag}}  Yazılarını Göster</a>
						@endforeach
					</div>
				</div>
				<div class="card-footer">
					{{ $tags->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
