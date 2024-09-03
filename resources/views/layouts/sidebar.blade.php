<!-- resources/views/layouts/sidebar.blade.php -->
<div class="sidebar" id="sidebar">
    <div class="p-4">
        <h4>Sections</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">Section 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Section 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Section 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Section 4</a>
            </li>
        </ul>
    </div>
</div>

<!-- Custom styles for sidebar -->
<style>
    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: -250px; /* Hidden by default */
        background-color: #f8f9fa;
        transition: left 0.3s;
        z-index: 1000;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
    }

    .sidebar.active {
        left: 0; /* Show sidebar */
    }

    .sidebar .nav-link {
        font-weight: bold;
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