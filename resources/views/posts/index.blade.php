@extends('layouts.dashboard', ['title' => 'Posts'])

@section('dash_content')
	<h2 class="mb-2 text-gray-600 text-lg flex items-center">Semua Content
        <span class="ml-6">
            <a class="text-indigo-600" href="@current(['type' => 'link'])">Discover</a> | 
            <a class="text-indigo-600" href="@current(['type' => 'content'])">Content</a> | 
            <a class="text-indigo-600" href="@current(['status' => 'draft'])">Hanya Draft</a>
        </span>
		{{-- @button(['tag' => 'a', 'href' => route('post.create'), 'class' => 'text-sm ml-auto'])
			Tambah Konten
		@endbutton --}}
	</h2>
	<div class="bg-white rounded border-2 border-gray-200">
    	@foreach($posts as $post)
    	<div class="p-4 border-b border-gray-200">
    		<div class="items-center">
        		<div class="py-1 px-2 mr-1 rounded text-xs inline-block text-white capitalize {{ $post->status == 'publish' ? 'bg-green-500' : 'bg-orange-500' }}">
        			{{ $post->status }}
        		</div>
        		{{ $post->title ?? $post->raw_pages }}
    		</div>
    		<div class="mt-2 -mx-3 text-gray-600 text-sm flex">
        		<div class="mx-3">{{ $post->created_at->diffForHumans() }}</div>
        		@if($post->status == 'draft')
        		<a class="mx-3 text-green-500" href="@route('post.publish', $post->id)">Publish</a>
        		@endif
        		<a class="mx-3 text-black" href="@route('post', $post->id)">Edit</a>
        		<a class="mx-3 text-red-600 cursor-pointer" onclick="let c = confirm('Are you sure?'); if(!c) return false; else document.getElementById('delete-{{$post->id}}').submit();">Delete</a>
        		<form action="@route('post.delete', $post->id)" method="post" id="delete-{{$post->id}}">
        			{!! method_field('delete') !!}
        			@csrf
        		</form>
                <a class="mx-3 text-indigo-600" href="@route('single', $post->user->the_username)">{!! $post->user->name !!}</a>
        	</div>
    	</div>
    	@endforeach

	</div>
	<div class="mt-5"> 
    	{!! $posts->links() !!}
    </div>
@stop