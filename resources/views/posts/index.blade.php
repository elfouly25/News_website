@extends('admin.dashboard.dashboard-layout')

@section('title', 'Posts')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4">Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">
                Add New Post
            </a>

            @foreach($posts as $post)
                <div class="bg-light shadow-sm rounded p-3 mb-3">
                    <div class="flex-grow-1">
                        <h2 class="h5 mb-1">{{ $post->title }}</h2>
                        <p class="text-muted mb-2">
                            <small>Last updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('M d, Y H:i') }} by {{ $post->writer }}</small>
                        </p>
                    </div>

                    <div class="d-flex justify-content-end"> <!-- Align buttons to the right -->
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-md mr-2" style="height: 38px;">Edit</a> <!-- Blue Edit Button -->
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-md" style="height: 38px;">Delete</button> <!-- Red Delete Button -->
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