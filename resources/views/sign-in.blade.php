@extends('layouts.main')
@section('title', 'Sign In')
@section('content')
    <div class="container rounded shadow-sm p-4 my-3">
        <h1>Sign In</h1>
        @if(session('sign-in-error'))
            <div class="alert alert-danger" role="alert">
                {{session('sign-in-error')}}
            </div>
        @endif
        @if(session('registration-success'))
            <div class="alert alert-success" role="alert">
                {{session('registration-success')}}
            </div>
        @endif
        <form action="{{route('signInPost')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                @error('email')
                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                @error('password')
                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
    </div>
@endsection