<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin layout')</title>
</head>
<body>

    <header>
        <nav>
            <div>
                <a href="{{ route('admin.login') }}">Admin</a>
            </div>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div id="flash-message" style="
                max-width: 800px;
                margin: 0 auto;
                padding: 1rem;
                background-color: #d4edda;
                border-left: 5px solid #28a745;
                color: #155724;
                border-radius: 4px;
                margin-bottom: 1rem;
            ">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} All rights reserved.</p>
    </footer>
    
    <!-- Inline Styles -->
    <style>
        body {
            background-color: #f7fafc;
            color: #2d3748;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3182ce;
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        header nav a {
            color: white;
            margin-left: 1rem;
            text-decoration: none;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        footer {
            background-color: #3182ce;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>

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