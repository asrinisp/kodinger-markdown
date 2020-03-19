@inject('post', 'Services\PostService')

@php
$random = $post->random();
@endphp

<div class="off-canvasify sidebar" id="sidebar">
    <div class="mx-auto p-4 sm:p-0 sm:mx-0">
        <div class="rounded">
            @if($random !== null)
            <a href="@route('single', $random->slug)">
                <img src="{{ $random->thumbnail }}" alt="{{ $random->title }}" class="rounded">
            </a>
            <h4 class="text-indigo-600 mt-3 font-semibold hover:text-indigo-700 text-lg"><a href="@route('single', $random->slug)">{!! $random->title !!}</a></h4>
            <div class="mt-2 -mx-1">
                @foreach($random->tags->slice(0, 3) as $tag)
                <a class="text-gray-600 text-sm mx-1" href="@route('search', ['tag' => $tag->tag->name])">#{!! $tag->tag->name !!}</a>
                @endforeach
            </div>
            <p class="text-gray-600 text-sm mt-2">oleh <a class="font-semibold text-black" href="@route('single', $random->user->the_username)">{{ $random->user->name }}</a></p>
            @endif
        </div>

        <h4 class="mt-10 font-bold mb-3 text-indigo-600">Paling Banyak Disukai</h4>
        <div class="bg-white rounded border border-gray-200">
            @foreach($post->loved() as $post)
            @isset($post->post)
            <a class="flex items-center hover:bg-gray-100 px-5 py-4 border-b border-gray-100" href="@route('single', $post->post->slug)">
                <div class="text-sm text-gray-600 font-semibold truncate">{{ $post->post->title }}</div>
            </a>
            @endisset
            @endforeach
        </div>

        <div class="py-12 rounded shadow-md px-2 bg-gradient text-white flex items-center mt-10">
            <div class="text-center">
                <svg class="inline-block mb-3" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line></svg>
                <h2 class="text-lg">@itskodinger</h2>
                <div class="text-sm font-light text-gray-300 mt-2">
                    Dapatkan informasi seputar teknologi web di Instagram.
                </div>
                <a href="https://instagram.com/itskodinger" target="_blank" class="inline-block mt-5 bg-white hover:bg-transparent hover:text-white hover:border-white border border-transparent text-purple-600 py-2 px-6 uppercase font-semibold tracking-wider rounded text-xs">Follow</a>
                <p class="uppercase text-xs tracking-wider mt-8 opacity-50">Tersedia juga di:</p>
                <div class="flex justify-center mt-2">
                    <a href="https://www.facebook.com/itskodinger"><svg class="w-6 text-white fill-current mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="facebook"><rect width="24" height="24" transform="rotate(180 12 12)" opacity="0"/><path d="M17 3.5a.5.5 0 0 0-.5-.5H14a4.77 4.77 0 0 0-5 4.5v2.7H6.5a.5.5 0 0 0-.5.5v2.6a.5.5 0 0 0 .5.5H9v6.7a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-6.7h2.62a.5.5 0 0 0 .49-.37l.72-2.6a.5.5 0 0 0-.48-.63H13V7.5a1 1 0 0 1 1-.9h2.5a.5.5 0 0 0 .5-.5z"/></g></g></svg></a>
                    <a href="https://twitter.com/itskodinger"><svg class="w-6 text-white fill-current mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="twitter"><polyline points="0 0 24 0 24 24 0 24" opacity="0"/><path d="M8.08 20A11.07 11.07 0 0 0 19.52 9 8.09 8.09 0 0 0 21 6.16a.44.44 0 0 0-.62-.51 1.88 1.88 0 0 1-2.16-.38 3.89 3.89 0 0 0-5.58-.17A4.13 4.13 0 0 0 11.49 9C8.14 9.2 5.84 7.61 4 5.43a.43.43 0 0 0-.75.24 9.68 9.68 0 0 0 4.6 10.05A6.73 6.73 0 0 1 3.38 18a.45.45 0 0 0-.14.84A11 11 0 0 0 8.08 20"/></g></g></svg></a>
                </div>
            </div>
        </div>
    </div>                
</div>