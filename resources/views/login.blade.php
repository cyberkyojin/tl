@extends('layouts.main')
@section('title', 'Login')

@section('content')
<div class="container text-white border rounded mt-3 p-3">
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('danger_msg'))
        <div class="alert alert-danger">
            {{session('danger_msg')}}
        </div>
    @endif

    <h1>Login</h1>
    <hr>

    <form action="/auth" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection