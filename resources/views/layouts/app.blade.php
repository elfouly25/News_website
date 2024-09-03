<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EchoNews')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <!-- Header Section -->
    @include('layouts.header')

<!-- Include Sidebar -->
@include('layouts.sidebar') 

    <!-- Main Content Section -->
    <main>
        @yield('content')
    </main>

    <!-- Include Footer Section -->
    @include('layouts.footer') 


</body>
</html>