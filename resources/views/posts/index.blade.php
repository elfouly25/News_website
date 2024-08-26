@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div style="
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        padding: 24px;
    ">
        <h1 style="
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 12px;
            text-align: left;
        ">
            All Posts
        </h1>

        <!-- Add Post Button -->
        <a href="{{ route('posts.create') }}" style="
            display: inline-block;
            padding: 12px 24px;
            background-color: rgb(39, 39, 121);
            color: white;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-bottom: 16px;
        ">
            Add New Post
        </a>

        @foreach($posts as $post)
            <div style="
                margin-bottom: 24px;
                background-color: #ffffff;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                padding: 16px;
            ">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="
                        width: 100%;
                        max-width: 400px;
                        height: auto;
                        border-radius: 4px;
                        margin-bottom: 16px;
                    ">
                @else
                    <img src="https://via.placeholder.com/400x200" alt="{{ $post->title }}" style="
                        width: 100%;
                        max-width: 400px;
                        height: auto;
                        border-radius: 4px;
                        margin-bottom: 16px;
                    ">
                @endif
                <h2 style="
                    font-size: 24px;
                    font-weight: bold;
                    margin-bottom: 8px;
                ">
                    {{ $post->title }}
                </h2>
                <p style="
                    color: #718096;
                    margin-bottom: 8px;
                ">
                    {{-- {{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }} by  --}}
            <small>Last updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('M d, Y H:i') }} by {{ $post->writer }}</small>
        </p>

                @if($post->section)
                <p style="
                    font-size: 20px;
                    font-weight: bold;
                    margin-bottom: 12px;
                ">
                     {{ $post->section->title }}
                </p>
            @endif
                    
                @if($post->section_content)
                    <p style="
                        font-size: 18px;
                        line-height: 1.6;
                        margin-bottom: 8px;
                    ">
                        {{ Str::limit($post->section_content, 100) }}
                    </p>
                @endif
                
                <p style="
                    font-size: 18px;
                    line-height: 1.6;
                    margin-bottom: 8px;
                ">
                    {{ Str::limit($post->content, 100) }}
                </p>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" style="
                    display: inline-block;
                    color: rgb(39, 39, 121);
                    font-weight: bold;
                    text-decoration: none;
                    border-bottom: 2px solid rgb(39, 39, 121);
                    transition: color 0.3s;
                ">
                    Read more
                </a>
            </div>
        @endforeach

        <!-- Pagination Links -->
        {{ $posts->links() }}
    </div>
@endsection
