@extends('layouts.main')
@section('title', 'Register')
@section('content')
    <div class="container rounded shadow-sm p-4 my-3">
        <h1>Register</h1>
        <form action="{{route('registerPost')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{old('name')}}">
                @error('name')
                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{old('email')}}">
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
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
                @error('confirm_password')
                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection