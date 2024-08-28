@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4" style="max-height: 80vh; overflow-y: auto;">
            <h1 class="mb-4">{{ $post->title }}</h1>

            @if($post->section)
                <p class="font-weight-bold text-decoration-underline" style="color: black;">{{ $post->section->title }}</p>
            @endif

            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded mb-3">
            @else
                <img src="https://via.placeholder.com/1200x600" alt="{{ $post->title }}" class="img-fluid rounded mb-3">
            @endif

            <p class="lead mb-3">{{ $post->content }}</p>

            @if($post->section_content)
                <p class="lead font-italic mb-3">{{ $post->section_content }}</p>
            @endif

            <p class="text-muted mb-4">
                <small>Last updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('M d, Y H:i') }} by {{ $post->writer }}</small>
            </p>
        </div>
    </div>
@endsection