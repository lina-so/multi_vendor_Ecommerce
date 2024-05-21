<div class="container">
    @if($isEditing)
        @include('commentify::livewire.partials.comment-form',[
            'method'=>'editComment',
            'state'=>'editState',
            'inputId'=> 'reply-comment',
            'inputLabel'=> 'Your Reply',
            'button'=>'Edit Comment'
        ])
    @else
        <div class="p-3 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    <img src="{{$comment->user->avatar()}}" class="mr-2 rounded-circle" alt="{{$comment->user->name}}" width="30" height="30">
                    <p class="mb-0">{{Str::ucfirst($comment->user->name)}}</p>
                </div>
                <div class="dropdown">
                    <button  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    border: none;
                    background: none;
                    color: darkgrey;
                    font-size: 2em;">
                        <!-- استبدل السهم بنقطتين -->
                        <span class="mr-1">...</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @can('update', $comment)
                            <button class="dropdown-item" type="button" wire:click="$toggle('isEditing')">Edit</button>
                        @endcan
                        @can('destroy', $comment)
                            <button class="dropdown-item" type="button" onclick="confirm('Are you sure?') ? @this.call('deleteComment') : false">Delete</button>
                        @endcan
                    </div>
                </div>
            </div>
            <p class="mb-2">{!! $comment->presenter()->replaceUserMentions($comment->presenter()->markdownBody()) !!}</p>

            <div class="d-flex align-items-center">
                <livewire:like :$comment :key="$comment->id"/>
                @include('commentify::livewire.partials.comment-reply')
            </div>
        </div>
    @endif

    @if($isReplying)
        @include('commentify::livewire.partials.comment-form',[
           'method'=>'postReply',
           'state'=>'replyState',
           'inputId'=> 'reply-comment',
           'inputLabel'=> 'Your Reply',
           'button'=>'Post Reply'
       ])
    @endif
    @if($hasReplies)
        <div class="ml-3">
            @foreach($comment->children as $child)
                <livewire:comment :comment="$child" :key="$child->id"/>
            @endforeach
        </div>
    @endif
</div>
