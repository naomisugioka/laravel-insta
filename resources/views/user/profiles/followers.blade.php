@extends('layouts.app')

@section('title',$user->name. '-Follower')

@section('content')
   @include('user.profiles.header')

   @if($user->followers->isNotEmpty())
   {{--list--}}
   <div class="row justify-content-center">
   <div class="col-4">
    <h4 class="h5 text-muted text-center">Follower</h4>

    @foreach ($user->followers as $follower)
        <div class="row mb-3 align-items-center">
            <div class="col-auto">
                {{--avatar/icon--}}
                <a href="{{ route('profile.show',$follower->follower->id)}}">
                    @if($follower->follower->avatar)
                    <img src="{{$follower->follower->avatar}}" alt=""
                    class="rounded-circle avatar-sm">
                    @else
                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                </a>

            </div>
            <div class="col ps-0 text-truncate">
                {{--name--}}
                <a href="{{ route('profile.show',$follower->follower)}}" class="text-decoration-none text-dark fw-bold">
                    {{ $follower->follower->name}}
                </a>
            </div>
            <div class="col-auto">
                @if($follower->follower->id != Auth::user()->id)
                @if($follower->follower->isFollowed())
                    {{--unfollow--}}
                    <form action="{{ route('follow.destroy',$follower->follower->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn shadow-none p-0 text-secondary">Following</button>
                    </form>
                @else
                   {{-- follow--}}
                   <form action="{{ route('follow.store',$follower->follower->id)}}"method="post">
                     @csrf
                     <button type="submit" class="btn shadow-none p-0 text-primary">Follow</button>
                </form>
                @endif
                    
               @endif
            </div>
        </div>
    @endforeach
   </div>
   </div>
   @else 
      <h4 class="h5 text-muted text-center">Not follower  anyone yet.</h4>
   @endif
@endsection

