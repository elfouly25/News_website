@extends('layouts.app')

@section('title', $section->title) <!-- Use section title here -->

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4" style="text-align: {{ session('locale') === 'ar' ? 'right' : 'left' }};">
                {{ $section->title }}
            </h1> <!-- Display section title with dynamic alignment -->

            @if($posts->isEmpty())
                <p>No posts available in this section.</p>
            @else
                <!-- Featured Article -->
                @if($posts->currentPage() == 1 && $posts->count() > 0)
                    <div style="margin-bottom: 24px; position: relative; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <img src="{{ $posts[0]->image ? asset('storage/' . $posts[0]->image) : 'https://via.placeholder.com/1200x600' }}" 
                             alt="{{ strip_tags($posts[0]->title) }}" 
                             style="width: 100%; height: auto; border-radius: 4px; margin-bottom: 16px;">

                        <div style="position: absolute; inset: 0; background: linear-gradient(to top, black, transparent); padding: 16px; display: flex; flex-direction: column; justify-content: flex-end;">
                            <h2 style="font-size: 24px; font-weight: bold; color: white; margin-bottom: 8px; text-align: {{ is_arabic($posts[0]->title) ? 'right' : 'left' }};">
                                {{ strip_tags($posts[0]->title) }}
                            </h2>
                            <p style="color: white; margin-bottom: 8px; text-align: {{ is_arabic($posts[0]->title) ? 'right' : 'left' }};">
                                {{ \Carbon\Carbon::parse($posts[0]->created_at)->format('M d, Y') }} by {{ strip_tags($posts[0]->writer) }}
                            </p>
                            <p style="color: rgba(248, 248, 248, 0.8); margin-bottom: 8px; text-align: {{ is_arabic($posts[0]->title) ? 'right' : 'left' }};">
                                {{ Str::limit(strip_tags($posts[0]->content), 150) }}
                            </p>

                            <a href="{{ route('posts.show', $posts[0]->id) }}" style="display: inline-block; padding: 12px 24px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;">
                                @lang('message.Read More')
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
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/400x200' }}" 
                             alt="{{ strip_tags($post->title) }}" 
                             style="width: 100%; height: auto; border-radius: 4px; margin-bottom: 16px;">

                        <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 8px; text-align: {{ is_arabic($post->title) ? 'right' : 'left' }};">
                            {{ strip_tags($post->title) }}
                        </h2>
                        <p style="font-size: 18px; margin-bottom: 8px; text-align: {{ is_arabic($post->title) ? 'right' : 'left' }};">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }} by {{ strip_tags($post->writer) }}
                        </p>
                        <p style="font-size: 18px; margin-bottom: 8px; text-align: {{ is_arabic($post->title) ? 'right' : 'left' }};">
                            {{ Str::limit(strip_tags($post->content), 100) }}
                        </p>

                        <a href="{{ route('posts.show', $post->id) }}" style="display: inline-block; padding: 12px 24px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;">
                            @lang('message.Read More')
                        </a>
                    </div>
                @endforeach

                <!-- Pagination Links -->
                <div class="pagination" style="margin-top: 20px; display: flex; justify-content: center; align-items: center;">
                    <a href="{{ $posts->previousPageUrl() }}" class="btn" style="margin: 0 5px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;" @if ($posts->onFirstPage()) style="visibility: hidden;" @endif>&laquo; @lang('message.previous')</a>
                    
                    @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="btn" style="margin: 0 5px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s; @if ($page == $posts->currentPage()) font-weight: bold; @endif">{{ $page }}</a>
                    @endforeach

                    <a href="{{ $posts->nextPageUrl() }}" class="btn" style="margin: 0 5px; background-color: rgb(39, 39, 121); color: white; border-radius: 4px; text-align: center; font-weight: bold; text-decoration: none; transition: background-color 0.3s;" @if (!$posts->hasMorePages()) style="visibility: hidden;" @endif> @lang('message.next') &raquo;</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@php
function is_arabic($text) {
    return preg_match('/[\x{0600}-\x{06FF}]/u', $text);
}
@endphp