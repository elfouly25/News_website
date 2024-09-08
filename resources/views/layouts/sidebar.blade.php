<!-- resources/views/layouts/sidebar.blade.php -->
<div class="sidebar" id="sidebar">
    <div class="p-4">
        <h4 class="font-weight-bold">Sections</h4>
        {{-- <h4 class="font-weight-bold">{{ __('navbar.sections') }}</h4> --}}
        <ul class="nav flex-column">
            @foreach($sections as $section)
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center" href="{{ route('posts.bySection', $section->id) }}">
                        <i class="fas fa-folder mr-2"></i> 
                        <span>{{ $section->title }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Custom styles for sidebar -->
<style>
    .sidebar {
        height: 100%;
        width: 300px; /* Increased width for more space */
        position: fixed;
        top: 0;
        left: -300px; /* Hidden by default */
        background-color: #fff; /* White background */
        transition: left 0.3s;
        z-index: 1000;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        padding: 20px; /* Padding for spacing */
        border-right: 1px solid #ddd; /* Optional: Add a border for separation */
    }

    .sidebar.active {
        left: 0; /* Show sidebar */
    }

    .sidebar .nav-link {
        font-weight: bold;
        color: #333; /* Darker text color */
        padding: 10px 15px; /* Padding for better click area */
        border-radius: 4px; /* Rounded corners */
        transition: background-color 0.3s; /* Smooth background transition */
        text-decoration: none; /* Remove underline */
    }

    .sidebar .nav-link:hover {
        background-color: #f1f1f1; /* Light background on hover */
    }

    .sidebar h4 {
        margin-bottom: 20px; /* Spacing below the title */
        font-size: 1.5rem; /* Larger title size */
        color: #333; /* Darker title color */
    }

    /* Icon styles */
    .sidebar .nav-link i {
        font-size: 20px; /* Icon size */
        color: #555; /* Icon color */
    }
</style>

<!-- Script for sidebar functionality -->
<script>
    // Toggle sidebar visibility
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    });
</script>

<!-- Font Awesome for icons (add this in your layout head) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">