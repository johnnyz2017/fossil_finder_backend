@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">User Management</div>
				<div class="card-body">
					<form action="{{ route('admin.users.update', $user) }}" method="post">
						@csrf
						@method('PATCH')
						<div class="form-group">
							<label for="formGroupExampleInput">Username</label>
							<input type="text" class="form-control" name="name" id="formGroupExampleInput" value="{{ $user->name }}">
						</div>
						<div class="form-group">
							<label for="formEmailInput">Email</label>
							<input type="text" class="form-control" name="email" id="formEmailInput" value="{{ $user->email }}">
						</div>
						<div class="form-row">
							<label for="inputEmail4">Password</label>
							<input type="password" name="password" class="form-control" id="inputEmail4">
							{{-- <div class="form-group col-md-6">
								<label for="inputPassword4">Confirm Password</label>
								<input type="password" name="password_confirmation" class="form-control" id="inputPassword4">
							</div> --}}
						</div>
						<div class="form-group">
							<label class="form-label">Attach role</label>
							<select class="form-control" name="role">
								<option value="" selected disabled hidden>Choose here</option>
								{{-- @foreach($roles as $role)
								<option value="{{ $role->id }}">{{ $role->display_name }}</option>
								@endforeach --}}
								@if(count($user->roles) > 0)
								
									@foreach($roles as $role)
									@if($user->roles[0]->id == $role->id)
									<option value="{{ $role->id }}" selected>{{ $role->display_name }}</option>
									@else
									<option value="{{ $role->id }}">{{ $role->display_name }}</option>
									@endif
									@endforeach

								@else
									@foreach($roles as $role)
									<option value="{{ $role->id }}">{{ $role->display_name }}</option>
									@endforeach
								@endif
								
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-sm">Save edit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection