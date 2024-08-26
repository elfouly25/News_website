@extends('layouts.app')

@section('title', 'Edit Post')

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
            Edit Post
        </h1>

        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title Field -->
            <div style="margin-bottom: 16px;">
                <label for="title" style="font-weight: bold;">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required style="
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                ">
                @error('title')
                    <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Content Field -->
            <div style="margin-bottom: 16px;">
                <label for="content" style="font-weight: bold;">Content:</label>
                <textarea id="content" name="content" rows="5" required style="
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                ">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Writer Field -->
            <div style="margin-bottom: 16px;">
                <label for="writer" style="font-weight: bold;">Writer:</label>
                <input type="text" id="writer" name="writer" value="{{ old('writer', $post->writer) }}" required style="
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                ">
                @error('writer')
                    <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section Field -->
            <div style="margin-bottom: 16px;">
                <label for="section_id" style="font-weight: bold;">Select or Write Section:</label>
                <select id="section_id" name="section_id" style="
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                ">
                    <option value="">-- Select a Section --</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id', $post->section_id) == $section->id ? 'selected' : '' }}>
                            {{ $section->title }}
                        </option>
                    @endforeach
                </select>
                @error('section_id')
                    <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                @enderror

                <!-- New Section Input -->
                <div style="margin-top: 16px;">
                    <label for="new_section" style="font-weight: bold;">Or Write a New Section:</label>
                    <input type="text" id="new_section" name="new_section" value="{{ old('new_section') }}" style="
                        width: 100%;
                        padding: 8px;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                    ">
                    @error('new_section')
                        <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Image Field -->
            <div style="margin-bottom: 16px;">
                <label for="image" style="font-weight: bold;">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" style="
                    width: 100%;
                ">
                @error('image')
                    <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                @enderror
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="
                        width: 100%;
                        max-width: 400px;
                        height: auto;
                        border-radius: 4px;
                        margin-top: 16px;
                    ">
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" style="
                padding: 12px 24px;
                background-color: rgb(39, 39, 121);
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            ">
                Update Post
            </button>
        </form>
    </div>
@endsection
