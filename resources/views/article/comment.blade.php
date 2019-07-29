@foreach ($comments as $comment)
<div class="media mt-2 p-3 bg-light">
	<img src="..." class="mr-3" alt="...">



	<div class="media-body ">
		<h5 class="mt-0">{{ $comment->user->name }}</h5>
		<p>
			{{ $comment->body }}
		</p>
		@guest
		@else
		<a data-toggle="collapse" href="#collapse{{$comment->id}}" aria-controls="collapse{{$comment->id}}">
yanıtla
</a>
<div class="collapse" id="collapse{{$comment->id}}">
		<form action="{{route('article.addComment', $article->id)}}" method="post">
			@csrf
			<input type="hidden" name="parent_id" value="{{$comment->id}}">
			<textarea name="body" class="form-control mb-2" placeholder="Yeni Yorum " min="3" rows="1"></textarea>
			<button type="submit" class="btn btn-primary" name="button"> Ekle</button>
		</form>
</div>
		@endguest
		@includeWhen($comment->children,'article.comment', ['comments' => $comment->children, 'isSub' => true])
	</div>
</div>
@endforeach
