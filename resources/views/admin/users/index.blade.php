@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">Users Management</div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.users.create') }}">Create a new user</a>
                    <table class="table table-hover my-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    {{-- <a href="{{ route('admin.users.show', $user) }}">{{ Str::limit($user->name, 25) }}</a> --}}
                                    {{ Str::limit($user->name, 25) }}
                                </td>
                                <td>
                                    {{-- {{ $user->hasRole('superadministrator') }} --}}
                                    {{-- {{ $user->isAbleTo('users-read') ? 'canread' : 'cannotread' }} --}}
                                    {{-- {{ $user->roles }} --}}
                                    @foreach($user->roles as $role)
                                    {{ $role->display_name }}
                                    @endforeach
                                </td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form method="post" action="{{ route('admin.users.destroy', $user) }}">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection