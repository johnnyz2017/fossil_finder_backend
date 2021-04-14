@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1>All Posts</h1>
        </div>
    
        <div class="col-md-2">
        <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Post</a>
        {{-- {{ route('posts.create')}} --}}
        </div>
    
        <div class="col-md-12">
            <hr>
        </div>
    </div> <!--end of .row -->
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th>OPs</th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        {{-- {{ $post['id']}} --}}
                        {{-- {{ $post->id}} --}}
                        <tr>
                            <th>{{ $post->id }}</th>
                            <th>{{ $post->title }}</th>
                            <th>{{ Str::substr($post->content, 0, 50) }}{{ Str::length($post->content) > 50 ? "..." : "" }}</th>
                            <th>{{ date('M j, Y', strtotime($post->created_at)) }}</th>
                        <th><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a> <a href="#" class="btn btn-default btn-sm">Edit</a></th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{-- {{ dd($posts->links()) }} --}}
                {{-- {!! $posts->links() !!} --}}
                {$posts->links()}
            </div>
        </div>
    </div>
</div>


{{-- {{ $posts ?? 'no posts'}} --}}

@endsection