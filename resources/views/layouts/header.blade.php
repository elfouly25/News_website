<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="btn btn-outline-secondary" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand ml-3" href="/">EchoNews</a>

        {{-- Date and Time --}}
        <div class="w-100 text-center">
            <div class="navbar-text d-flex justify-content-center align-items-center">
                <div class="d-flex align-items-center mx-2">
                    <i class="fas fa-calendar-alt fa-lg"></i>
                    <span class="ml-2">{{ date('F j, Y') }}</span>
                </div>
                <div class="d-flex align-items-center mx-2">
                    <i class="fas fa-clock fa-lg"></i>
                    <span class="ml-2">{{ date('h:i A') }}</span>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse">
            <!-- Search Form -->
            <form action="{{ route('posts.search') }}" method="GET" class="form-inline my-2 my-lg-0 ml-auto">
                <div class="input-group" style="width: 250px;">
                    <input 
                        class="form-control @if(session('locale') === 'ar') text-right @else text-left @endif" 
                        type="search" 
                        name="query" 
                        placeholder="{{ __('message.search for posts...') }}" 
                        aria-label="Search" 
                        required
                    >
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">@lang('message.search')</button>
                    </div>
                </div>
            </form>

            <!-- Language Dropdown -->
            <div class="dropdown ml-3">
                <button 
                    class="btn btn-secondary dropdown-toggle" 
                    type="button" 
                    id="languageDropdown" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false"
                >
                    @lang('message.Language') 
                </button>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <a class="dropdown-item" href="{{ route('set.language', 'en') }}">English</a>
                    <a class="dropdown-item" href="{{ route('set.language', 'ar') }}">Arabic</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    window.addEventListener('pageshow', function() {
        const searchInput = document.querySelector('input[name="query"]');
        if (searchInput) {
            searchInput.value = ''; 
        }
    });
</script>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>