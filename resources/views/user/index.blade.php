@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Users</div>

				<div class="card-body">
					<div class="row">
						@foreach($users as $user)
						<div class=" col-md-6 ">
							<a href="{{route('users.article', $user)}}"class="list-group-item list-group-item-action">{{$user->name}} Yazılarını Göster</a>
						</div>
						<div class="col-md-6  ">
							<a href="{{route('users.profile', $user)}}"class="list-group-item list-group-item-action">{{$user->name}} Profilini Göster</a>
						</div>
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
