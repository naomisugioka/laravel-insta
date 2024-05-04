<div class="modal fade" id="likes-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" data-bs-dismiss="modal" class="btn btn-sm ms-auto d-block text-primary">x</button>
            </div>
            <div class="modal-body">
                <div class="w-75 mx-auto">
                    @foreach($post->likes as $like)
                    <div class="row mb-3 align-items-center">
                        {{-- avatar/icon--}}
                        <div class="col-auto">
                            @if ($like->user->avatar)
                                <img src="{{ $like->user->avatar}}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>    
                            @endif

                        </div>
                        {{--name--}}
                        <div class="col ps-0 text-truncate">
                            <a href="{{ route('profile.show',$like->user->id)}}" class="text-decoration-none text-dark fw-bold">{{ $like->user->name}}</a>
                        </div>
                        {{--button--}}
                        <div class="col-auto">
                            @if($like->user->id != Auth::user()->id)
                              @if($like->user->isFollowed())
                              {{--Unfollow--}}
                              <form action="{{ route('follow.destroy',$like->user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-transparent border-0 shadow-none text-secondary p-0">Unfollow</button>
                            </form>
                            @else
                            <form action="{{ route('follow.store',$like->user->id)}}" method="post">
                              @csrf
                              <button type="submit" class="bg-transparent border-0 shadow-none text-primary p-0">Follow</button>
                            </form>
                            @endif

                            @endif
                        </div>
                    </div>
                   @endforeach 
                </div>
            </div>
        </div>
    </div>
</div>