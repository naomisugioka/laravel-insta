@extends('layouts.app')

@section('title','Home')

@section('content')
<div class="row gx-5">
    <div class="col-8">
        @if($search)
        <h2 class="h4 text-muted mb-3">'Search results for '<span class = "fw-bold">{{ $search}}</span></h2>
        @endif
        {{-- posts --}}
        @forelse($all_posts as $post)
          <div class="card mb-4">
            {{--tilte--}}
            @include('user.posts.contents.title')
            <div class="container p-0">
                {{-- image--}}
                <a href="{{ route('post.show',$post->id)}}">
                    <img src=" {{ $post->image }}" alt="" class="w-100">
                </a>
            </div>
            {{-- body--}}
            <div class="card-body">
                @include('user.posts.contents.body')

                     {{-- comments--}}
            <div class="mt-3">
             @if($post->comments->count() > 0)
                <hr class="mb-3">
                @foreach ($post->comments->take(3) as $comment)
                    @include('user.posts.contents.comments.list-item')
                @endforeach
                
                @if($post->comments->count() >3)
                    <a href="{{ route('post.show', $post->id)}}" class="text-decoration-none small mb-2">View all {{ $post->comments->count()}} comments</a>
                @endif
             @endif
                @include('user.posts.contents.comments.create')
            </div>
            </div>
          </div>

        @empty
        <div class="text-center">
            <h2>Share Photos</h2>
            <p class="text-muted">When you share photos, they'll appear on your profile.</p>
            <a href="{{ route('post.create')}}" class="text-decoration-none">A</a>
        </div>
            
        @endforelse
    </div>

    <div class="col-4">
        {{--user info and suggestions--}}
        <div class="row bg-white shadow-sm py-3 align-items-center rounded-3 mb-5">
            <div class="col-auto">
                <a href="{{route('profile.show',Auth::user()->id)}}">
                    @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="" class="rounded-circle avatar-md">
                    @else
                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                    @endif
                </a>
            </div>
            <div class="col ps-0">
                <a href="{{ route('profile.show',Auth::user()->id)}}" class="text-decoration-none fw-bold text-dark">{{ Auth::user()->name}}</a>
                <p class="mb-0 text-muted small">{{ Auth::user()->email}}</p>

            </div>
        </div>
        {{--suggested users--}}
        <div class="row mb-3 align-items-center">
              <h4 class="h6 text-secondary fw-bodl mb-0">Suggestions For You</h4>
            </div>
            <div class="col">
                <div class="col-auto">
                    <a href="" class="text-decoration-none text-dark fw-bold h6"></a>
                </div>
            </div>
            @foreach($suggested_users as $user)
            <div class="row mb-3 align-items-center">
                <div class="col-auto">
                     <a href="{{ route('profile.show', $user->id)}}">
                        @if($user->avatar)
                          <img src="{{ $user->avatar}}" alt="" class="rounded-circle avatar-sm">
                         @else
                         <i class="fa-solid fa-circle-user text-secondary icon-sm"></i> 
                         @endif
                    </a>
                </div>
                <div class="col ps-0 text-truncate">
                    <a href="{{ route('profile.show', $user->id)}}" class="text-dark text-decoration-none fw-bold">
                        {{ $user->name }}
                        </a>
                </div>
                <div class="col-auto">
                    <form action="{{ route('follow.store',$user->id)}}" method="post">
                       @csrf
                       <button type="submit" class="btn shadow-none p-0 text-primary">Follow</button>
                    </form>

                </div>
            </div>

            @endforeach
        </div>
    </div>

@endsection
