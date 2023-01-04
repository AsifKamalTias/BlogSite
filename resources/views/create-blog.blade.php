@extends('layouts.main')
@section('title', 'Create Blog')
@section('content')
    <div class="container rounded shadow-sm p-4 my-3">
        <h1>Create Blog</h1>
        <form action="{{route('createBlogPost')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" value="{{old('title')}}">
                @error('title')
                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" placeholder="Enter blog image">
                @error('image')
                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="featured_images" class="form-label">Featured Images</label>
                <input type="file" class="form-control" id="featured_images" name ="featured_images[]" multiple accept="image/*"/>
                @error('featured_images')
                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter blog description">{{old('description')}}</textarea>
                @error('description')
                    <small class="text-danger"><i class="bi bi-exclamation-circle"></i> {{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>
@endsection