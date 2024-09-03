@extends('admin.dashboard.dashboard-layout')

@section('title', 'Manage Sub-Admins')

@section('content')
    <h1>Manage Sub-Admins</h1>

    @if(session('success'))
        <div id="flash-message" class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="flash-message" class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Create Sub-Admin Button -->
    <div class="mb-3">
        <a href="{{ route('admin.create') }}" class="btn btn-primary">Create Sub-Admin</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subAdmins as $subAdmin)
                <tr>
                    <td>{{ $subAdmin->id }}</td>
                    <td>{{ $subAdmin->Login_email }}</td> <!-- Change to Login_email if you're using Admin model -->
                    <td>
                        <!-- Edit button linking to the edit route -->
                        <a href="{{ route('admin.edit', $subAdmin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <!-- Delete button -->
                        <form action="{{ route('admin.destroy', $subAdmin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sub-admin?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination" style="margin-top: 20px; display: flex; justify-content: center; align-items: center;">
        {{-- Previous Page Link --}}
        @if ($subAdmins->onFirstPage())
            <span style="visibility: hidden;">&laquo; Previous</span>
        @else
            <a href="{{ $subAdmins->previousPageUrl() }}" style="margin: 0 5px; font-size: 14px;">&laquo; Previous</a>
        @endif

        {{-- Page Number Links --}}
        @foreach ($subAdmins->getUrlRange(1, $subAdmins->lastPage()) as $page => $url)
            @if ($page == $subAdmins->currentPage())
                <span style="margin: 0 5px; font-weight: bold;">{{ $page }}</span>
            @else
                <a href="{{ $url }}" style="margin: 0 5px; text-decoration: none; color: #3182ce;">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($subAdmins->hasMorePages())
            <a href="{{ $subAdmins->nextPageUrl() }}" style="margin: 0 5px; font-size: 14px;">Next &raquo;</a>
        @else
            <span style="visibility: hidden;">Next &raquo;</span>
        @endif
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