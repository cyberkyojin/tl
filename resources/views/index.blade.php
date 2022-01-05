@extends('layouts.main')

@section('title', 'TL')

@section('content')
<div class="container">
    <div class="row bg-dark border-start border-end border-secondary" style="min-height: 500px;">
        @auth
        <div class="row">
            <div class="col-3 text-white">
                <div>
                    <span class="badge bg-success rounded-pill">logged</span>
                    -> {{$user->name}}
                </div>
            </div>
            <div class="col-6 p-3 my-1 border-start border-end border-secondary text-white">
                @if (session('msg'))
                <p class="alert alert-success mt-3"> {{ session('msg') }} </p>
                @endif

                @if (session('danger_msg'))
                <p class="alert alert-danger mt-3"> {{ session('danger_msg') }} </p>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="/post/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Title">Title:</label>
                        <input type="text" name="title" class="form-control my-1">
                        <hr>
                        <label for="files">File:</label>
                        <input type="file" name="files" class="form-control my-1">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-secondary">Post</button>
                </form>
            </div>
        </div>
        @endauth
        <hr class="text-white">
        <div class="offset-4 col-4">
            @foreach ($posts as $post)
            <div class="card bg-secondary text-white my-3">
                <div class="card-header text-center">
                    @if ($post->user_id == $user['id'])
                    <div class="dropdown text-end float-end m-1">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <form action="/post/delete/{{$post->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif

                    <span class="card-title">{{$post->title}}</span>
                </div>
                <div class="card-body">
                    <img src="/files/{{ $post->file }}" alt="{{ $post->file }}" class="card-img">
                </div>
                <div class="card-footer">
                    <span>
                        @if ($post->user_id == $user['id'])
                        <span class="badge bg-success rounded-pill">:)</span>
                        @endif

                        @/{{ $post->user_name }} | {{ $post->created_at->format('d-m-Y') }}
                    </span>
                </div>
            </div>
            <hr class="text-white">
            @endforeach
        </div>
    </div>
</div>
@endsection