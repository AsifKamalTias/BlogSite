@extends('layouts.main')
@section('title', 'Edit Blog')
@section('content')
<div class="container rounded shadow-sm p-4 my-3">
    <h1>Edit Blog</h1>
    <form action="{{route('editBlogPost', $blog->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" value="{{$blog->title}}">
            @error('title')
                <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <div class="update-blog-img my-2 text-center">
                <img src="{{asset('storage/blog-images/'.$blog->image)}}" class="blog-image img-fluid" alt="{{$blog->title}}"><span><small>Current Image</small></span>
            </div>
            <span class="text-muted fs-6">(Choose new image file to update image)</span>
            <input type="file" class="form-control" id="image" name="image" placeholder="Enter blog image">
            @error('image')
                <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="featured_images" class="form-label">Featured Images</label>
            <div class="update-featured-img my-2 text-center">
                @if($blog->featuredImages->count() == 0)
                    <p class="fs-6 text-muted">No featured images.</p>
                @else
                @foreach($blog->featuredImages as $featuredImage)
                    <img src="{{asset('storage/featured-images/'.$featuredImage->image)}}" class="blog-image
                    img-fluid" alt="{{$blog->title}}">
                @endforeach
                <p><small>Current Image(s)</small></p>
                @endif
            </div>
            <span class="text-muted fs-6">(Choose new images file to replace featured images)</span>
            <input type="file" class="form-control" id="featured_images" name ="featured_images[]" multiple accept="image/*"/>
            @error('featured_images')
                <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter blog description">{{$blog->description}}</textarea>
            @error('description')
                <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection