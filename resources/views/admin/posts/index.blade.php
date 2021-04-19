@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">Posts Management</div>
                <div class="card-body">
                    <table class="table table-hover my-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Public</th>
                                <th scope="col">Published</th>
                                <th scope="col">User</th>
                                <th scope="col">Created</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>
                                    {{ $post->title }}
                                </td>
                                <td>{{ $post->private ? 'No' : 'Yes' }}</td>
                                <td>
                                    @if($post->published)
                                    <a href="{{ route('admin.posts.unpublish', $post) }}" class="btn btn-primary btn-sm">UnPublish</a>
                                    @else
                                    <a href="{{ route('admin.posts.publish', $post) }}" class="btn btn-primary btn-sm">Publish</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $post->user ? $post->user->name : '用户不存在' }}
                                </td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>
                                    <form method="post" action="{{ route('admin.posts.destroy', $post) }}">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection