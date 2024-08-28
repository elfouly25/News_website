@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4 text-center" style="font-size: 2.5rem; font-weight: bold;">{{ $post->title }}</h1>

            @if($post->section)
                <p class="font-weight-bold text-decoration-underline text-black mb-3" style="font-size: 1.5rem;">{{ $post->section->title }}</p>
            @endif

            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded mb-3" style="max-width: 100%; height: auto;">
            @else
                <img src="https://via.placeholder.com/800x400" alt="{{ $post->title }}" class="img-fluid rounded mb-3" style="max-width: 100%; height: auto;">
            @endif

            <p class="lead mb-3" style="font-size: 1.2rem; line-height: 1.6;">{{ $post->content }}</p>

            @if($post->section_content)
                <p class="lead font-italic mb-3" style="font-size: 1.2rem; line-height: 1.6;">{{ $post->section_content }}</p>
            @endif

            <p class="text-muted mb-4" style="font-size: 0.9rem;">
                <small>Last updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('M d, Y H:i') }} by {{ $post->writer }}</small>
            </p>

            <div class="text-center">
                <a href="/" class="btn btn-dark" style="display: inline-block; padding: 12px 24px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;">
                    Back to Posts
                </a>
            </div>
        </div>
    </div>
@endsection

<!-- Inline Styles -->
<style>
    body {
        background-color: #f7fafc;
    }
</style>
