<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<form method="POST" action="{{ route('users.update',$user->id) }}"  enctype="multipart/form-data">
				@csrf
				{{ method_field('PUT') }}
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">



					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

						<div class="col-md-6">
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="form-group row">
						<label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

						<div class="col-md-6">
							<input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{$user->birthday->format('Y-m-d')}}" autocomplete="birthday" autofocus>

							@error('birthday')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="form-group row">
						<label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Profil Resmi') }}</label>

						<div class="col-md-6">
							<img src="{{asset(Storage::url(Auth::user()->profile_image))}}"  width="50"alt="">
							<input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image"   autocomplete="profile_image">

							@error('profile_image')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>



				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
