<div class="container">

    <section class="bg-white py-8 lg:py-16">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-lg lg:text-2xl font-bold text-gray-900">Discussion ({{$comments->count()}})</h4>
            </div>

            @auth
                @include('commentify::livewire.partials.comment-form',[
                    'method'=>'postComment',
                    'state'=>'newCommentState',
                    'inputId'=> 'comment',
                    'inputLabel'=> 'Your comment',
                    'button'=>'Post comment'
                ])
            @else
                <p class="mt-2 text-sm"><a href="/login">Log in to comment!</a></p>
            @endauth

            @if($comments->count())
                @foreach($comments as $comment)
                    <div class=" mb-3">
                        <div class="">
                            <livewire:comment :$comment :key="$comment->id"/>
                        </div>
                    </div>
                @endforeach
                <div class="mt-3">
                    {{$comments->links()}}
                </div>
            @else
                <p>No comments yet!</p>
            @endif
        </div>
    </section>

</div>
