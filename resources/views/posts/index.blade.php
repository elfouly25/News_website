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
                        <a href="{{ route('posts.show', $post->id) }}" class="font-weight-bold text-decoration-underline" style="color: black;">
                            Read More
                        </a>
                    </div>

                    <div class="d-flex">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-md mr-2">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-md">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection