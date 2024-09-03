@extends('admin.dashboard.dashboard-layout')

@section('title', 'Posts')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4">Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">
                Add New Post
            </a>

            @if($posts->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No posts available. Please create a new post.
                </div>
            @else
                @foreach($posts as $post)
                    <div class="bg-light shadow-sm rounded p-3 mb-3 d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <h2 class="h5 mb-1">{{ $post->title }}</h2>
                            <p class="text-muted mb-2">
                                <small>Last updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('M d, Y H:i') }} by {{ $post->writer }}</small>
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm mr-2" style="height: 38px;">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="height: 38px;">Delete</button>
                            </form>
                        </div>
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
            @endif
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