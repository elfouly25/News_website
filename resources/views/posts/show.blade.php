@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4 text-center" style="font-size: 2.5rem; font-weight: bold; text-align: {{ is_arabic($post->title) ? 'right' : 'left' }};">{{ strip_tags($post->title) }}</h1>

            @if($post->section)
                <p class="font-weight-bold text-decoration-underline text-black mb-3" style="font-size: 1.5rem; text-align: {{ is_arabic($post->section->title) ? 'right' : 'left' }};">{{ strip_tags($post->section->title) }}</p>
            @endif

            <div class="mb-3 text-center">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ strip_tags($post->title) }}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                @else
                    <img src="https://via.placeholder.com/800x400" alt="{{ strip_tags($post->title) }}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                @endif
            </div>

            <p class="lead mb-3" style="font-size: 1.2rem; line-height: 1.6; text-align: {{ is_arabic($post->content) ? 'right' : 'left' }};">{{ strip_tags($post->content) }}</p>

            @if($post->section_content)
                <p class="lead font-italic mb-3" style="font-size: 1.2rem; line-height: 1.6; text-align: {{ is_arabic($post->section_content) ? 'right' : 'left' }};">{{ strip_tags($post->section_content) }}</p>
            @endif

            <p class="text-muted mb-4" style="font-size: 0.9rem; text-align: {{ is_arabic($post->title) ? 'right' : 'left' }};">
                <small>Last updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('M d, Y H:i') }} by {{ strip_tags($post->writer) }}</small>
            </p>

            <div class="text-center">
                <a href="{{ url()->previous() }}" class="btn btn-dark" style="display: inline-block; padding: 12px 24px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;">
                    @lang('message.Back to Posts')
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

@php
function is_arabic($text) {
    return preg_match('/[\x{0600}-\x{06FF}]/u', $text);
}
@endphp