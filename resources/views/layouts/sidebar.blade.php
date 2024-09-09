<div class="sidebar" id="sidebar">
    <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-3 @if(session('locale') === 'ar') flex-row-reverse @endif">
            <h4 class="font-weight-bold @if(session('locale') === 'ar') text-right @else text-left @endif" style="flex: 1; margin: 0;">
                @lang('message.sections')
            </h4>
            <button id="closeSidebar" class="btn btn-link text-dark" style="z-index: 1001;">
                <i class="fas fa-arrow-left"></i> <!-- Arrow icon -->
            </button>
        </div>
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

<style>
    .sidebar {
        height: 100%;
        max-height: 100vh; /* Set maximum height to the viewport height */
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
        overflow-y: auto; /* Enable vertical scrolling */
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
        margin-bottom: 0; /* Remove default margin for better alignment */
        font-size: 1.5rem; /* Larger title size */
        color: #333; /* Darker title color */
        text-align: inherit; /* Inherit text alignment from the parent */
    }

    /* Icon styles */
    .sidebar .nav-link i {
        font-size: 20px; 
        color: #555; 
    }

    
    #closeSidebar {
        background: none; 
        border: none; 
        cursor: pointer; 
    }
</style>


<script>
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        closeSidebar.style.display = sidebar.classList.contains('active') ? 'block' : 'none'; // Show or hide the close button
    });

    closeSidebar.addEventListener('click', function() {
        sidebar.classList.remove('active');
        closeSidebar.style.display = 'none'; // Hide the close button
    });

    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('active');
            closeSidebar.style.display = 'none'; // Hide the close button
        }
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">