<!-- Header Section -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="btn btn-outline-secondary" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <span class="ml-3"></span>
        <a class="navbar-brand" href="/">EchoNews</a>
        <div class="navbar-text ml-3">
            <i class="fas fa-calendar-alt"></i> {{ date('F j, Y') }} 
            <i class="fas fa-clock ml-2"></i> {{ date('h:i A') }}
        </div>
        <div class="collapse navbar-collapse">
            <!-- Search Form -->
            <form action="{{ route('posts.search') }}" method="GET" class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search for posts..." aria-label="Search" required>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>