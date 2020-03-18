        <div class="bg-white mb-4 border border-gray-200 rounded">
            <div class="py-3 px-6 text-sm italic inline-block text-gray-600 font-light">
                <a class="not-italic text-gray-900 font-bold" href="@route('single', optional($comment->user)->the_username ?? '')">{{ optional($comment->user)->name ?? 'Unknown User' }}</a>
                berkomentar di
                <a class="text-indigo-600 not-italic font-bold" href="@route('single', $comment->post->slug ?? '')#discuss-{{$comment->id}}">{{ $comment->post->title ?? '' }}</a>
                pada {{ $comment->time }}
            </div>
            <div class="text-sm text-gray-700 py-3 px-6 bg-gray-100 rounded-bl rounded-br comment-msg"> 
                @if(auth()->check() && auth()->user()->id == $comment->user->id)
                <div class="float-right">
                    <a class="mx-3 text-red-600 cursor-pointer" onclick="let c = confirm('Are you sure?'); if(!c) return false; else document.getElementById('delete-{{$comment->id}}').submit();">Delete</a>
                    <form action="@route('comment.delete', $comment->id)" method="post" id="delete-{{ $comment->id }}">
                        {!! method_field('delete') !!}
                        @csrf
                    </form>
                </div>
                @endif
                <div class="break-all">
                    {!! $comment->markdown !!}
                </div>
            </div>
        </div>
