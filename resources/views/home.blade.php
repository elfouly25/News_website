@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4">News</h1>

            <!-- Featured Article -->
            @if($posts->isNotEmpty() && $posts->currentPage() == 1)
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
            @foreach($posts as $index => $post)
                @if($posts->currentPage() == 1 && $index == 0)
                    @continue <!-- Skip the first post if it's already displayed as featured -->
                @endif
                <div style="margin-bottom: 24px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 16px;">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; max-width: 400px; height: auto; border-radius: 4px; margin-bottom: 16px;">
                    @else
                        <img src="https://via.placeholder.com/400x200" alt="{{ $post->title }}" style="width: 100%; max-width: 400px; height: auto; border-radius: 4px; margin-bottom: 16px;">
                    @endif

                    <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 8px;">{{ $post->title }}</h2>
                    <p style="font-size: 18px; margin-bottom: 8px;">{{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }} by {{ $post->writer }}</p>
                    <p style="font-size: 18px; margin-bottom: 8px;">{{ Str::limit($post->content, 100) }}</p>

                    <a href="{{ route('posts.show', $post->id) }}" style="display: inline-block; padding: 12px 24px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;">
                        Read more
                    </a>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="pagination" style="margin-top: 20px; display: flex; justify-content: center; align-items: center;">
                {{-- Previous Page Link --}}
                @if ($posts->onFirstPage())
                    <span style="visibility: hidden;">&laquo; Previous</span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}" style="margin: 0 5px; font-size: 14px;">&laquo; Previous</a>
                @endif

                {{-- Page Number Links --}}
                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                    @if ($page == $posts->currentPage())
                        <span style="margin: 0 5px; font-weight: bold;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="margin: 0 5px; text-decoration: none; color: #3182ce;">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}" style="margin: 0 5px; font-size: 14px;">Next &raquo;</a>
                @else
                    <span style="visibility: hidden;">Next &raquo;</span>
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .pagination a {
        padding: 8px 12px;
        border: 1px solid #3182ce;
        border-radius: 4px;
        color: #3182ce;
        transition: background-color 0.3s;
    }

    .pagination a:hover {
        background-color: #3182ce;
        color: white;
    }

    .pagination span {
        padding: 8px 12px;
    }
</style>