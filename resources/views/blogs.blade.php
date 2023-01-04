@extends('layouts.main')
@section('title', 'Blogs')
@section('content')
<div class="container">
    <h1>Blogs</h1>
    <div class="d-flex justify-content-center flex-wrap">
        @foreach($blogs as $blog)
        <div class="card mx-3 my-3" style="width: 18rem;">
            <img src="{{asset('storage/blog-images/'.$blog->image)}}" class="card-img-top" alt="{{$blog->title}}">
            <div class="card-body">
              <h5 class="card-title">{{$blog->title}}</h5>
              <a href="{{route('blog',['id'=>$blog->id])}}" class="btn btn-primary">Description</a>
            </div>
          </div>
        @endforeach
    </div>
</div>
@endsection