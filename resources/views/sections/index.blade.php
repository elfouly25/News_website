@extends('admin.dashboard.dashboard-layout')

@section('title', 'Sections')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h1>Sections</h1>
            <a href="{{ route('sections.create') }}" class="btn btn-primary mb-3">
                Add New Section
            </a>

            @foreach($sections as $section)
                <div class="bg-white shadow-sm rounded p-3 mb-3 d-flex justify-content-between align-items-center">
                    <h2 class="m-0">{{ $section->title }}</h2>
                    <div>
                        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-info btn-sm mr-2">Edit</a>

                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection