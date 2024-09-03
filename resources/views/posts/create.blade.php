@extends('admin.dashboard.dashboard-layout')

@section('title', 'Create Post')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4" style="max-height: 80vh; overflow-y: auto;">
            <h1 class="mb-4">Create New Post</h1>

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
                @csrf

                <!-- Title Input -->
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" required>
                    @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content Input -->
                <div class="form-group">
                    <label for="content" class="font-weight-bold">Content:</label>
                    <textarea id="content" name="content" rows="10" class="form-control" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Writer Input -->
                <div class="form-group">
                    <label for="writer" class="font-weight-bold">Writer:</label>
                    <input type="text" id="writer" name="writer" value="{{ old('writer') }}" class="form-control" required>
                    @error('writer')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section Input -->
                <div class="form-group">
                    <label for="section_id" class="font-weight-bold">Select or Write Section:</label>
                    <select id="section_id" name="section_id" class="form-control">
                        <option value="">-- Select a Section --</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
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

                <!-- Image Input -->
                <div class="form-group">
                    <label for="image" class="font-weight-bold">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control-file" required>
                    @error('image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    Create Post
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        // Initialize CKEditor
        CKEDITOR.replace('content'); // Replace the textarea with CKEditor
    </script>

    <script>
        document.getElementById('postForm').addEventListener('submit', function(event) {
            const imageInput = document.getElementById('image');
            const imageError = document.getElementById('imageError');
            const maxWidth = 5308; // Set your desired max width
            const maxHeight = 3457; // Set your desired max height

            // Clear previous error messages
            imageError.style.display = 'none';
            imageError.textContent = '';

            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const img = new Image();
                img.src = URL.createObjectURL(file);

                img.onload = function() {
                    if (img.width > maxWidth || img.height > maxHeight) {
                        event.preventDefault(); // Prevent form submission
                        imageError.textContent = `Image dimensions must be less than ${maxWidth}x${maxHeight} pixels.`;
                        imageError.style.display = 'block';
                    }
                };
            }
        });
    </script>
@endsection