<div class="row justify-content-center">
  
    <div class="row mb-3 align-items-center">
        <div class="col-auto">
            <h2 class="display-6 fw-bold mb-0">Suggested</h2>
        </div>

        <div class="col">
            <div class="w-75 mx-auto">
                @foreach($suggested_users as $user)
                <div class="row mb-3 align-items-center">
                    {{-- avatar/icon--}}
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id)}}">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar}}" alt="" class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>    
                        @endif
                        </a>
                    </div>
                    {{--name--}}
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show',$user->id)}}" class="text-decoration-none text-dark fw-bold">{{ $user->name}}</a>
                    </div>
                    {{--button--}}
                    <div class="col-auto">
                        <form action="{{ route('follow.store',$user->id)}}" method="post">
                            @csrf
                            <button type="submit" class="bg-transparent border-0 shadow-none text-secondary p-0">Follow</button>
                        </form>
                    {{--label--}}    
                    <p class="d-inline fw-light">{{ $user->email }}</p>
                    <span class="small text-secondary">
                      @if($user->followsYou())
                      Follows you
                      @else
                      @if($user->followers->count()== 0)
                      No followers yet
                      @elseif($user->follwer)
                    </span>
                 
                   
            </div>
        </div>
    </div>
</div>
</div>
</form>