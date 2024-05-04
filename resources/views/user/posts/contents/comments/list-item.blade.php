<div class="mt-3">
    <a href="{{ route('profile.show', $comment->user_id)}}" class="text-decoration-none fw-bold text-dark">{{ $comment->user->name }}</a>
    &nbsp;
    <span class="fw-light">{{ $comment->body }}</span>
    <br>
    <span class="text-muted small">{{ date('D, M d Y', strtotime($comment->created_at)) }}</span>
    
    {{-- delete --}}
    @if($comment->user_id == Auth::user()->id)
        <form action="{{ route('comment.destroy', $comment->id)}}" method="post" class="d-inline">
            @csrf 
            @method('DELETE')

            &middot;
            <button type="submit" class="btn xsmall text-danger p-0 shadow-none">Delete</button>
        </form>
    @endif
</div>