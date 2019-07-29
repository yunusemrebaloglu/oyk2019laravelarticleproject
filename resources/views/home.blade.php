@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card-header">Fallow Articles
		<a class="btn btn-primary btn-sm float-right " href="{{route('article.create')}}">New article</a>
	</div>
	<div class="justify-content-center">

		@include('helpers.card',['articles' => $articles])



</div>
@endsection
