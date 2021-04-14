@extends('layouts.app')

@section('style-links')
<link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="padding: 10px 5px;background-color: #eceeef;text-align: center;margin-bottom: 10px;">
                <h1>{{ $post->title }}</h1>
                <div>
                    <em class="ng-binding">ID( {{ $post->perm_id }} )</em>
                </div>
            </div>
        </div>
    
        <div class="col-md-12" style="height: 10px;">
        </div>
    </div> <!--end of .row -->
    
    <div class="row">
        <div class="col-sm-8">
            <table class="table">
                <tbody>
                        <tr>
                            <th>
                                永久ID
                            </th>
                            <td>{{ $post->perm_id }}</td>
                        </tr>
                        <tr>
                            <th>
                                临时ID
                            </th>
                            <td>{{ $post->temp_id }}</td>
                        </tr>
                        <tr>
                            <th>标题</th>
                            <td>{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <th>内容</th>
                            <td>{{ $post->content }}</td>
                        </tr>
                        <tr>
                            <th>鉴定类别</th>
                            <td>{{ $post->category_id }}</td>
                        </tr>
                        <tr>
                            <th>经度</th>
                            <td>{{ $post->coordinate_longitude }}</td>
                        </tr>
                        <tr>
                            <th>纬度</th>
                            <td>{{ $post->coordinate_latitude }}</td>
                        </tr>
                        <tr>
                            <th>地址</th>
                            <td>{{ $post->address }}</td>
                        </tr>
                        <tr>
                            <th>创建时间</th>
                            <td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <div id="amapcontainer" style="height: 300px;"></div>
        </div>
    </div>

    <div class="col-md-12" style="height: 10px;"></div>

    <div class="row">
        <div class="col-md-12">
            评论 ( {{ count($comments) > 0 ? count($comments) : '无' }} )
            <hr>
            @foreach($comments as $comment)
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body">
                    <div class="comment text-justify float-left"> 
                        <img src="{{ empty($comment->user->profile_image) ? asset('images/avatar/people.jpeg') : $comment->user->profile_image }}" alt="" class="rounded-circle" width="40" height="40">
                        <h4>{{ $comment->user->name }}</h4> <span> {{ date('M j, Y', strtotime($comment->created_at)) }} </span> <br>
                        <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection