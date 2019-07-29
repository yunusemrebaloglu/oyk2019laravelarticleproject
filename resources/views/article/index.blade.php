@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			@include('helpers.card',['articles' => $articles])

        </div>
    </div>
</div>
@endsection
