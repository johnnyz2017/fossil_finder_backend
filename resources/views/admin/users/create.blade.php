@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Create a user</div>
				<div class="card-body">
					<form action="{{ route('admin.users.store') }}" method="post">
						@csrf
						<div class="form-group">
							<label class="form-label">Username</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label class="form-label">Email</label>
							<input type="text" class="form-control" name="email">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="form-label">Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label class="form-label">Confirm Password</label>
								<input type="password" name="password_confirmation" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Attach role</label>
							<select class="form-control" name="role">
								@foreach($roles as $role)
								<option value="{{ $role->id }}">{{ $role->display_name }}</option>
								@endforeach
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-sm">Create user</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection