<form action="{{ route('comment.store', $post->id)}}" method="post">
    @csrf 
    <div class="input-group">
        <textarea name="comment_body{{ $post->id }}"  rows="1" placeholder="Add a comment..." class="form-control form-control-sm">{{ old('comment_body'.$post->id) }}</textarea>
        <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
    </div>
    {{-- comment_body1 --}}
    @error('comment_body'.$post->id) 
        <p class="mb-0 text-danger small">{{ $message }}</p>
    @enderror
</form>