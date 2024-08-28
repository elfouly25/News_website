@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4">Latest News</h1>

            <!-- Featured Article -->
            @if($posts->isNotEmpty())
                <div style="margin-bottom: 24px; position: relative; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    @if($posts[0]->image)
                        <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->title }}" style="width: 100%; max-width: 800px; height: auto; border-radius: 4px; margin-bottom: 16px;">
                    @else
                        <img src="https://via.placeholder.com/1200x600" alt="{{ $posts[0]->title }}" style="width: 100%; max-width: 800px; height: auto; border-radius: 4px; margin-bottom: 16px;">
                    @endif

                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, black, transparent); padding: 16px; display: flex; flex-direction: column; justify-content: flex-end;">
                        <h2 style="font-size: 24px; font-weight: bold; color: white; margin-bottom: 8px;">{{ $posts[0]->title }}</h2>
                        <p style="color: white; margin-bottom: 8px;">{{ \Carbon\Carbon::parse($posts[0]->created_at)->format('M d, Y') }} by {{ $posts[0]->writer }}</p>
                        <p style="color: rgba(248, 248, 248, 0.8); margin-bottom: 8px;">{{ Str::limit($posts[0]->content, 150) }}</p>

                        <a href="{{ route('posts.show', $posts[0]->id) }}" style="display: inline-block; padding: 12px 24px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;">
                            Read more
                        </a>
                    </div>
                </div>
            @endif

            <!-- Recent Articles -->
            @foreach($posts->slice(1) as $post)
                <div style="margin-bottom: 24px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 16px;">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; max-width: 400px; height: auto; border-radius: 4px; margin-bottom: 16px;">
                    @else
                        <img src="https://via.placeholder.com/400x200" alt="{{ $post->title }}" style="width: 100%; max-width: 400px; height: auto; border-radius: 4px; margin-bottom: 16px;">
                    @endif

                    <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 8px;">{{ $post->title }}</h2>
                    <p style="font-size: 18px; line-height: 1.6; margin-bottom: 8px;">{{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }} by {{ $post->writer }}</p>
                    <p style="font-size: 18px; line-height: 1.6; margin-bottom: 8px;">{{ Str::limit($post->content, 100) }}</p>

                    <a href="{{ route('posts.show', $post->id) }}" style="display: inline-block; padding: 12px 24px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;">
                        Read more
                    </a>
                </div>
            @endforeach

            <!-- Pagination Links -->
            {{ $posts->links() }}
        </div>
    </div>
@endsection