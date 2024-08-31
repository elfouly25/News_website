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
                        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-info btn-sm mr-2" style="height: 38px;">Edit</a>
                        
                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="height: 38px;">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="pagination" style="margin-top: 20px; display: flex; justify-content: center; align-items: center;">
                {{-- Previous Page Link --}}
                @if ($sections->onFirstPage())
                    <span style="visibility: hidden;">&laquo; Previous</span>
                @else
                    <a href="{{ $sections->previousPageUrl() }}" style="margin: 0 5px; font-size: 14px;">&laquo; Previous</a>
                @endif

                {{-- Page Number Links --}}
                @foreach ($sections->getUrlRange(1, $sections->lastPage()) as $page => $url)
                    @if ($page == $sections->currentPage())
                        <span style="margin: 0 5px; font-weight: bold;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="margin: 0 5px; text-decoration: none; color: #3182ce;">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($sections->hasMorePages())
                    <a href="{{ $sections->nextPageUrl() }}" style="margin: 0 5px; font-size: 14px;">Next &raquo;</a>
                @else
                    <span style="visibility: hidden;">Next &raquo;</span>
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .pagination a {
        padding: 8px 12px;
        border: 1px solid #3182ce;
        border-radius: 4px;
        color: #3182ce;
        transition: background-color 0.3s;
    }

    .pagination a:hover {
        background-color: #3182ce;
        color: white;
    }

    .pagination span {
        padding: 8px 12px;
    }
</style>