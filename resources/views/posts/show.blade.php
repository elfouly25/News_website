@extends('layouts.app')

@section('title', $post->title)

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
            {{ $post->title }}
        </h1>

        @if($post->section)
            <p style="
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 12px;
            ">
                 {{ $post->section->title }}
            </p>
        @endif

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="
                width: 100%;
                height: auto;
                border-radius: 4px;
                margin-bottom: 16px;
            ">
        @else
            <img src="https://via.placeholder.com/1200x600" alt="{{ $post->title }}" style="
                width: 100%;
                height: auto;
                border-radius: 4px;
                margin-bottom: 16px;
            ">
        @endif

        <p style="
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 8px;
        ">
            {{ $post->content }}
        </p>

        @if($post->section_content)
            <p style="
                font-size: 18px;
                line-height: 1.6;
                margin-bottom: 8px;
                font-style: italic;
            ">
                {{ $post->section_content }}
            </p>
        @endif

        <p style="
            color: #718096;
            margin-bottom: 16px;
        ">
            {{-- {{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }} by  --}}
            <small>Last updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('M d, Y H:i') }} by {{ $post->writer }}</small>
        </p>

        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" style="
            display: inline-block;
            padding: 12px 24px;
            background-color: rgb(39, 39, 121);
            color: white;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-right: 8px;
        ">
            Edit
        </a>

        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="
                padding: 12px 24px;
                background-color: red;
                color: white;
                border: none;
                border-radius: 4px;
                text-align: center;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s;
            ">
                Delete
            </button>
        </form>
    </div>
@endsection
