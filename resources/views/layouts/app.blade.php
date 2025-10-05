<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .sidebar {
            min-height: 100vh;
            background: #1f2937;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar a {
            color: #d1d5db;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #fff;
        }
        .sidebar .active {
            background-color: #374151;
            border-radius: 8px;
        }
        
        /* Toggle button styling */
        .sidebar-toggle {
            position: fixed;
            bottom: 20px;
            left: 10px;
            z-index: 1060;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #1f2937;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        
        /* Half-circle effect */
        .sidebar-toggle::before {
            content: '';
            position: absolute;
            top: 0;
            left: -10px;
            width: 20px;
            height: 40px;
            background: #1f2937;
            border-radius: 20px 0 0 20px;
            z-index: -1;
        }
        
        /* Overlay for mobile when sidebar is open */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        
        /* Mobile styles */
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 250px;
                z-index: 1050;
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .content-area {
                margin-left: 0;
                transition: margin-left 0.3s ease-in-out;
            }
            
            .sidebar-toggle {
                display: flex;
            }
        }
        
        /* Desktop styles */
        @media (min-width: 768px) {
            .sidebar-toggle {
                display: none;
            }
            
            .content-area {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <!-- Sidebar -->
        <div class="col-auto col-md-3 col-lg-2 px-3 sidebar d-flex flex-column py-4" id="sidebar">
            <h4 class="text-white text-center mb-4">Anime Tracker</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route('dashboard') }}" class="nav-link px-3 {{ request()->is('/') ? 'active' : '' }}"><i class="bi bi-house me-2"></i> Dashboard</a></li>
                <li class="nav-item mb-2"><a href="{{ route('season.index') }}" class="nav-link px-3 {{ request()->is('season*') ? 'active' : '' }}"><i class="bi bi-calendar4 me-2"></i> Season</a></li>
                <li class="nav-item mb-2"><a href="{{ route('anime.index') }}" class="nav-link px-3 {{ request()->is('anime*') ? 'active' : '' }}"><i class="bi bi-tv me-2"></i> Anime</a></li>
            </ul>
            <div class="mt-auto text-center text-secondary small">
                <p>© 2025 Anime Tracker</p>
            </div>
        </div>

        <!-- Content -->
        <div class="col py-4 px-4 content-area" id="content">
            @yield('content')
        </div>
    </div>
</div>

<!-- Overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle">
    <i class="bi bi-chevron-right"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const content = document.getElementById('content');
        
        // Toggle sidebar
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            sidebarOverlay.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
            
            // Rotate the arrow icon
            const icon = this.querySelector('i');
            if (sidebar.classList.contains('show')) {
                icon.classList.remove('bi-chevron-right');
                icon.classList.add('bi-chevron-left');
            } else {
                icon.classList.remove('bi-chevron-left');
                icon.classList.add('bi-chevron-right');
            }
        });
        
        // Close sidebar when clicking on overlay
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            this.style.display = 'none';
            
            // Reset the arrow icon
            const icon = sidebarToggle.querySelector('i');
            icon.classList.remove('bi-chevron-left');
            icon.classList.add('bi-chevron-right');
        });
        
        // Close sidebar when clicking on a link (mobile only)
        if (window.innerWidth < 768) {
            const sidebarLinks = document.querySelectorAll('.sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.style.display = 'none';
                    
                    // Reset the arrow icon
                    const icon = sidebarToggle.querySelector('i');
                    icon.classList.remove('bi-chevron-left');
                    icon.classList.add('bi-chevron-right');
                });
            });
        }
    });
</script>
</body>
</html>