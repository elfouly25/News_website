    @extends('admin.dashboard.dashboard-layout')

    @section('title', 'Manage Sections')

    @section('content')
        <h1>Manage Sections</h1>

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

        <!-- Create Section Button -->
        <div class="mb-3">
            <a href="{{ route('sections.create') }}" class="btn btn-primary">Add New Section</a>
        </div>

        <!-- Sections Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($sections as $section)
                    <tr data-id="{{ $section->id }}">
                        <td>{{ $section->id }}</td>
                        <td>{{ $section->title }}</td>
                        <td>
                            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this section?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
    @endsection

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Sortable
            var el = document.getElementById('sortable');
            var sortable = Sortable.create(el, {
                animation: 150,
                onEnd: function (evt) {
                    // Get the new order
                    let order = [];
                    for (let i = 0; i < el.children.length; i++) {
                        order.push(el.children[i].getAttribute('data-id'));
                    }

                    // Send the new order to the server
                    fetch('{{ route('sections.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Sections reordered successfully!');
                        } else {
                            alert('Error reordering sections.');
                        }
                    });
                }
            });
        });
    </script>

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

