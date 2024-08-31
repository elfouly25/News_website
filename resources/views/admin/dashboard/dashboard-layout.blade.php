<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f7fafc; /* Light background */
        }

        .sidebar {
            width: 250px;
            background-color: #3182ce; /* Match header color */
            color: white;
            padding: 1rem;
            height: 100vh; /* Full height */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            margin-top: 0;
            color: white; /* Ensure header is white */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 1rem 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
            padding: 0.5rem 1rem; /* Add padding for a button-like effect */
            border-radius: 4px; /* Rounded corners */
            display: block; /* Make the entire area clickable */
        }

        .sidebar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Lighten background on hover */
            color: #ffffff; /* Keep text white on hover */
        }

        .dashboard-content {
            flex: 1;
            padding: 2rem;
            background-color: #ffffff; /* White background for content */
            border-left: 1px solid #dee2e6; /* Light border */
            display: flex; /* Enable flexbox */
            flex-direction: column; /* Stack children vertically */
            justify-content: center; /* Center vertically */
            align-items: center; /* Center horizontally */
            height: calc(100vh - 4rem); /* Adjust height to fill the remaining space */
            position: relative; /* Allow absolute positioning of flash message */
        }

        .dashboard-content h1 {
            color: #343a40; /* Darker text for headers */
        }

        .dashboard-content p {
            color: #6c757d; /* Lighter text for paragraphs */
        }

        /* Flash message style */
        #flash-message {
            position: absolute; /* Position it absolutely */
            top: 1rem; /* Distance from the top */
            left: 50%; /* Center horizontally */
            transform: translateX(-50%); /* Adjust to center */
            z-index: 1000; /* Ensure it appears above other content */
            width: 80%; /* Optional: set a width */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-3 sidebar">
                <h2 class="text-center">Admin Menu</h2>
                <ul class="list-unstyled">
                    {{-- <li><a href="{{ url('/admin/users') }}" class="text-white"><i class="fas fa-users"></i> Manage Users</a></li> --}}
                    <li><a href="{{ route('admin.index') }}" class="text-white"><i class="fas fa-user-shield"></i> Manage SubAdmins</a></li>
                    <li><a href="{{ route('posts.index') }}" class="text-white"><i class="fas fa-file-alt"></i> Manage Posts</a></li>
                    <li><a href="{{ route('sections.index') }}" class="text-white"><i class="fas fa-th-list"></i> Manage Sections</a></li>
                </ul>
                <!-- Logout Button -->
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block mt-3">Logout</button>
                </form>
            </aside>

            <main class="col-md-9 dashboard-content">
                <!-- Flash Messages -->
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

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Hide flash message after 3 seconds
        setTimeout(function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.display = 'none';
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</body>
</html>