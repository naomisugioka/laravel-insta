<div class="row align-items-center">
    <div class="col-auto px-0">
       
        {{-- heart/like button --}}
        @if($post->isLiked())
            {{-- unlike (red heart) --}}
            <form action="{{ route('like.destroy', $post->id)}}" method="post">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn shadow-none">
                    <i class="fa-solid fa-heart text-danger"></i>
                </button>
            </form>
        @else
            <form action="{{ route('like.store', $post->id)}}" method="post">
                @csrf 
                <button type="submit" class="btn shadow-none">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>
        @endif

    </div>
    <div class="col-auto ps-0">
        {{-- no. of likes --}}
        @if($post->likes->count()>0)
          <button class="btn p-0 shadow-none text-dark" data-bs-toggle="modal" data-bs-target="#likes-post{{ $post->id }}">
        {{ $post->likes->count() }}
    </button>
    @include('user.posts.contents.modals.likes')
    @else
    0
    @endif
    </div>
    <div class="col text-end">
        {{-- categories --}}
        @forelse($post->categoryPosts as $category_post)
            <div class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</div>
        @empty
            <div class="badge bg-dark">Uncategorized</div>
        @endforelse
    </div>
</div>

{{-- post owner and post description --}}
<a href="{{ route('profile.show', $post->user_id)}}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
&nbsp;
<p class="d-inline fw-light">{{ $post->description }}</p>
<p class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>