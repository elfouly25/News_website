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
                    <td>{{ $subAdmin->email }}</td>
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
@endsection