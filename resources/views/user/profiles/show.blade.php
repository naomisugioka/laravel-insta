@extends('layouts.app')

@section('tilte',$user->name)

@section('content')
@include('user.profiles.header')
{{-- user's post--}}
<div class="row">
    @forelse ($user->posts as $post)
      <div class="col-lg-4 col-md-6 mb-4">
        <a href=" {{route('post.show',$post->id)}}">
            <img src="{{ $post->image }}" alt="" class="grid-img">
        </a>
      </div>
    @empty
        
     <p class="text-center text-muted h5">No posts yet.
     </p>
        
    @endforelse
</div>
@endsection