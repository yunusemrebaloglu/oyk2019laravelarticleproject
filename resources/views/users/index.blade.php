@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Users</div>

				<div class="card-body">
					<div class="list-group">
						@foreach($users as $user)
						<a href="{{route('users.article', $user->id)}}"class="list-group-item list-group-item-action">{{$user->name}} Yazılarını Göster</a>
						@endforeach
					</div>
				</div>
				<div class="card-footer">
					{{ $users->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
