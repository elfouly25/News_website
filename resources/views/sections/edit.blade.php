@extends('admin.dashboard.dashboard-layout')

@section('title', 'Edit Section')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4">Edit Section</h1>

            <!-- Update Section Form -->
            <form action="{{ route('sections.update', $section->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Section:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}" class="form-control">
                    @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Update Section
                    </button>
                </div>
            </form>

            <!-- Delete Section Form -->
            <form action="{{ route('sections.destroy', $section->id) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger">
                        Delete Section
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection