<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'News Website')</title>
</head>
<body>

    <header>
        <nav>
            <div class="nav-left">
                <a href="/">Home</a>
            </div>
            <div class="nav-right">
                {{-- <a href="{{ route('UserLogin') }}" class="nav-button">Log In</a> --}}
                {{-- <a href="{{ route('UserRegister') }}" class="nav-button">Register</a> --}}
            </div>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div style="
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
    
</body>
</html>

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

    .nav-left a {
        color: white;
        margin-left: 1rem;
        text-decoration: none;
    }

    .nav-left a:hover {
        text-decoration: underline;
    }

    .nav-right {
        margin-left: auto;
    }

    .nav-button {
        color: white;
        background-color: #2b6cb0; /* Button color */
        padding: 0.5rem 1rem;
        border-radius: 4px;
        text-align: center;
        text-decoration: none;
        margin-left: 1rem;
        font-weight: bold;
    }

    .nav-button:hover {
        background-color: #2b6cb0; /* Button hover color */
        text-decoration: none;
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
