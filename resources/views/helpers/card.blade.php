<div class="justify-content-center">
	<div class="row justify-content-around">
		@foreach($articles as $article)
		<div class="card bg-dark text-white m-2">
			<a href="{{route('article.detail',$article)}}" style="background-image:url({{asset(Storage::url($article->image_address))}}); background-position: center; background-size: cover;height:200px;width:300px;">
		    </a>
		  <div class="card-img-overlay">
			  <a href="{{route('article.detail',$article)}}">
		    <h5 class="card-title">{{$article->title}}</h5>
		</a>
		    <p class="card-text">{{str_limit($article->content, $limit =100,$end = '...') }}</p>
		    <p class="card-text">{{$article->created_at->locale('tr')->diffForHumans()}}</p>
		    <p class="card-text">
				<a href="{{route('users.profile',$article->user)}}">

				{{$article->user->name}}</p>
			</a>
		  </div>
		</div>
		@endforeach
	</div>
</div>
