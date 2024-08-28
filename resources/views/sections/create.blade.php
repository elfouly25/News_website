@extends('admin.dashboard.dashboard-layout')

@section('title', 'Create Section')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1 class="mb-4">Create New Section</h1>

            <form action="{{ route('sections.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Section:</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" required>
                    @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Create Section
                </button>
            </form>
        </div>
    </div>
@endsection