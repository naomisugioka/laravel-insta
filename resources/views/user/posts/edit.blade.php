@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<form action="{{ route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
    @csrf 
    @method('PATCH')

    <span class="fw-bold">Category <span class="fw-light">(up to 3)</span></span>
    <div>
        @forelse($all_categories as $category)
            <div class="form-check form-check-inline">
                @if(in_array($category->id, $selected_categories))
                    <input type="checkbox" name="categories[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
                @else 
                    <input type="checkbox" name="categories[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                @endif
                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
        @empty 
            <span class="text-italic fw-light">No categories found.</span>
        @endforelse
    </div>
    @error('categories')
        <p class="mb-0 text-danger small">{{ $message }}</p>
    @enderror

    <label for="description" class="form-label fw-bold mt-3">Description</label>
    <textarea name="description" id="description" rows="3" placeholder="What's on your mind" class="form-control">{{ old('description', $post->description) }}</textarea>
    @error('description')
        <p class="mb-0 text-danger small">{{ $message }}</p>
    @enderror

    <label for="image" class="form-label fw-bold mt-3">Image</label>
    <div class="w-50">
        <img src="{{ $post->image }}" alt="" class="img-thumbnail mb-1">    
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <p class="form-text">
        Acceptable formats: jpeg, jpg, png, gif only <br>
        Max size is 1048 KB
    </p>
    @error('image')
        <p class="mb-0 text-danger small">{{ $message }}</p>
    @enderror

    <button type="submit" class="btn btn-warning px-4 mt-4">Save</button>
</form>
@endsection