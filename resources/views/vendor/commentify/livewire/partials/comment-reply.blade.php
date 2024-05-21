@if(config('commentify.comment_nesting') === true)
    @auth
        @if($comment->isParent())
        <button type="button" wire:click="$toggle('isReplying')" class="btn btn-link btn-xs text-gray-500" style="    width: 3em;
        margin-top: 1em;
        color: darkgray;">
            <svg class="mr-1 w-1 h-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path> </svg>
           <span style="font-size: .7em;">Reply</span>
        </button>

            <div wire:loading wire:target="$toggle('isReplying')">
                @include('commentify::livewire.partials.loader')
            </div>
        @endif
    @endauth

    @if($comment->children->count())
        <button  wire:click="$toggle('hasReplies')" class=" btn-link btn-xs text-gray-500 d-flex justify-content-between " style="border: none;
        background: none;
        color: lightslategrey;">
            @if(!$hasReplies)
                View all Replies ({{$comment->children->count()}})
            @else
                Hide Replies
            @endif
        </button>
        <div wire:loading wire:target="$toggle('hasReplies')">
            @include('commentify::livewire.partials.loader')
        </div>
    @endif
@endif
