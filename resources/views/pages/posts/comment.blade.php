<!-- Display Comments -->
@foreach ($post->comments as $comment)
<div class="flex items-start space-x-3">
    <div class="bg-gray-300 w-10 h-10 rounded-full"></div>
    <div class="text-gray-700 font-normal w-full">
        <p class="text-sm font-semibold">{{ $comment->user->fname }}</p>
        <p>{{ $comment->content }}</p>
        @if(auth()->user() && auth()->user()->id === $comment->user_id)
            <!-- Allow users to delete their own comments -->
            <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-gray-700 hover:bg-gray-100">
                    Delete Comment
                </button>
            </form>
        @endif
    </div>
</div>
@endforeach
