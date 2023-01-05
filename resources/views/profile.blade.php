@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="container mt-3">
        <h3>Hi, {{$loggedUser->name}}</h3>
        <a class="btn btn-primary mt-3" href="{{route('createBlog')}}"><i class="bi bi-plus-circle"></i> Create Blog</a>
        @if(session()->has('blog-create-success'))
            <div class="alert alert-success mt-3">
                {{session()->get('blog-create-success')}}
            </div>
        @endif
        @if(session()->has('blog-delete-success'))
            <div class="alert alert-success mt-3">
                {{session()->get('blog-delete-success')}}
            </div>
        @endif
        @if(session()->has('blog-edit-success'))
            <div class="alert alert-success mt-3">
                {{session()->get('blog-edit-success')}}
            </div>
        @endif
        <div class="mt-4 shadow-sm p-3">
            <h4>My blogs</h4>
            <hr/>
            <div class="d-flex justify-content-center flex-wrap">
                @foreach($blogs as $blog)
                <div class="card mx-3 my-3" style="width: 18rem;">
                    <img src="{{asset('storage/blog-images/'.$blog->image)}}" class="card-img-top" alt="{{$blog->title}}">
                    <div class="card-body">
                    <h5 class="card-title">{{$blog->title}}</h5>
                    <a href="{{route('blog',['id'=>$blog->id])}}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                    <a href="{{route('blog-edit',['id'=>$blog->id])}}" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                    <a href="{{route('blog-delete',['id'=>$blog->id])}}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection