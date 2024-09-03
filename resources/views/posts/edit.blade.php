@extends('admin.dashboard.dashboard-layout')

@section('title', 'Edit Post')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4" style="max-height: 80vh; overflow-y: auto;">
            <h1 class="mb-4">Edit Post</h1>

            <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
                    @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content Field -->
                <div class="form-group">
                    <label for="content" class="font-weight-bold">Content:</label>
                    <textarea id="content" name="content" rows="10" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Writer Field -->
                <div class="form-group">
                    <label for="writer" class="font-weight-bold">Writer:</label>
                    <input type="text" id="writer" name="writer" value="{{ old('writer', $post->writer) }}" class="form-control" required>
                    @error('writer')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section Field -->
                <div class="form-group">
                    <label for="section_id" class="font-weight-bold">Select or Write Section:</label>
                    <select id="section_id" name="section_id" class="form-control">
                        <option value="">-- Select a Section --</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ old('section_id', $post->section_id) == $section->id ? 'selected' : '' }}>
                                {{ $section->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('section_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror

                    <!-- New Section Input -->
                    <div class="mt-3">
                        <label for="new_section" class="font-weight-bold">Or Write a New Section:</label>
                        <input type="text" id="new_section" name="new_section" value="{{ old('new_section') }}" class="form-control">
                        @error('new_section')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Image Field -->
                <div class="form-group">
                    <label for="image" class="font-weight-bold">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control-file">
                    @error('image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid mt-2" style="max-width: 400px; border-radius: 4px;">
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    Update Post
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        // Initialize CKEditor
        CKEDITOR.replace('content'); // Replace the textarea with CKEditor
    </script>
@endsection