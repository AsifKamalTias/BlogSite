@extends('layouts.main')
@section('title', 'Blog')
@section('content')
    <div class="container mt-3">
        <h3>{{$blog->title}}</h3>
        <p class="text-muted">{{$blog->created_at->diffForHumans()}}</p>
        <p>Author: {{$blog->user->name}}</p>
        <hr/>
        <div class="text-center">
            <img src="{{asset('storage/blog-images/'.$blog->image)}}" class="blog-image img-fluid" alt="{{$blog->title}}">
        </div>

        @if($blog->featuredImages->count() > 0)
        <h6 class="text-center my-4">Featured Images</h6>
        <div class="d-flex justify-content-center border m-2">
            @foreach($blog->featuredImages as $featuredImage)
                <img src="{{asset('storage/featured-images/'.$featuredImage->image)}}" class="blog-featured-image img-fluid m-3" alt="{{$featuredImage->image}}">
            @endforeach
        </div>
        @endif
        
        <p class="my-3 text-justify">{{$blog->description}}</p>
    </div>
@endsection