<!-- Top Bar -->
<div id="topbar" class="fixed top-0 left-0 w-full bg-gray-800 text-white h-14 flex items-center justify-between px-6 shadow-md z-50">
    <!-- Left Side: Sidebar Toggle Button -->
    <button id="toggleButton" class="bg-gray-700 text-white p-3 rounded-lg shadow-lg hover:bg-gray-800 transition">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Right Side: Profile & Notifications -->
    <div class="flex items-center space-x-5">
        <div class="flex items-center space-x-3">
            <div class="flex items-center space-x-3">
                <i class="fas fa-user-circle text-3xl text-gray-400"></i>
                <span class="hidden md:inline-block">John Doe</span>
            </div>

        </div>
    </div>
</div>

<!-- Sidebar -->
<div id="sidebar" class="sidebar bg-gray-900 text-white w-64 min-h-screen p-5 shadow-lg flex flex-col fixed top-14 transition-all duration-300">
    <nav class="flex-grow">
        <ul class="space-y-2">
            <li>
                <a href="{{route('course')}}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-book"></i>
                    <span class="sidebar-text ml-3 transition-all">Courses</span>
                </a>
            </li>
            <li>
                <a href="{{route('students')}}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-user-graduate"></i>
                    <span class="sidebar-text ml-3 transition-all">Students</span>
                </a>
            </li>
            <li>
                <a href="{{route('trainingschedule')}}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="sidebar-text ml-3 transition-all">Training Schedules</span>
                </a>
            </li>
            <li>
                <a href="{{route('optinoptout')}}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-toggle-on"></i>
                    <span class="sidebar-text ml-3 transition-all">Opt-in/Opt-out</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Styles for Sidebar Behavior -->
<style>
    body {
        padding-top: 3.5rem;
        /* To prevent content from being covered by the fixed top bar */
    }

    .sidebar {
        width: 16rem;
        transition: all 0.3s ease-in-out;
        position: fixed;
        left: 0;
    }

    .collapsed {
        width: 4rem;
        padding: 1rem;
    }

    .collapsed .sidebar-text {
        display: none;
    }

    .content {
        margin-left: 16rem;
        transition: margin-left 0.3s ease-in-out;
    }

    .collapsed~.content {
        margin-left: 4rem;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('toggleButton');
        const content = document.querySelector('.content');

        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                content.style.marginLeft = "4rem";
            } else {
                content.style.marginLeft = "16rem";
            }
        });
    });
</script>

<!-- FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">