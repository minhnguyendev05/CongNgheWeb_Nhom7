<?php
// sidebar.php - Professional modern sidebar
$role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : null;
$currentAction = $_GET['action'] ?? '';
$sidebarClass = $role == 1 ? 'sidebar-instructor' : ($role == 2 ? 'sidebar-admin' : 'sidebar-student');
$userRole = $role == 1 ? 'instructor' : ($role == 2 ? 'admin' : 'student');
?>
<style>
    /* Modern Sidebar Styles */
    .sidebar-modern {
        background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.98) 100%);
        backdrop-filter: blur(20px);
        border-right: 1px solid rgba(0,0,0,0.1);
        box-shadow: 2px 0 20px rgba(0,0,0,0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 280px;
        flex-shrink: 0;
        min-height: calc(100vh - 76px);
        position: sticky;
        top: 76px;
        z-index: 100;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .sidebar-modern.collapsed {
        width: 70px;
    }

    /* Only enable collapsible on desktop */
    @media (max-width: 991.98px) {
        .sidebar-modern {
            width: 280px !important;
        }
        .sidebar-modern.collapsed {
            width: 280px !important;
        }
        .sidebar-toggle {
            display: none;
        }
    }

    .sidebar-modern.sidebar-student {
        background: linear-gradient(180deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.98) 100%);
        border-right: 1px solid rgba(102, 126, 234, 0.3);
    }

    .sidebar-modern.sidebar-instructor {
        background: linear-gradient(180deg, rgba(17, 153, 142, 0.95) 0%, rgba(56, 239, 125, 0.98) 100%);
        border-right: 1px solid rgba(17, 153, 142, 0.3);
    }

    .sidebar-modern.sidebar-admin {
        background: linear-gradient(180deg, rgba(252, 176, 69, 0.95) 0%, rgba(253, 29, 29, 0.98) 100%);
        border-right: 1px solid rgba(252, 176, 69, 0.3);
    }

    .sidebar-header {
        padding: 2rem 1.5rem 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.2);
        text-align: center;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        margin-bottom: 1rem;
        position: relative;
    }

    .sidebar-toggle {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255,255,255,0.2);
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .sidebar-toggle:hover {
        background: rgba(255,255,255,0.3);
        transform: scale(1.1);
    }

    .sidebar-modern.collapsed .sidebar-toggle {
        right: 50%;
        transform: translateX(50%);
    }

    .sidebar-brand {
        color: white !important;
        font-weight: 700;
        font-size: 1.25rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .sidebar-brand:hover {
        color: rgba(255,255,255,0.9) !important;
        transform: scale(1.02);
    }

    .sidebar-brand .brand-icon {
        font-size: 1.5rem;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    }

    .sidebar-subtitle {
        color: rgba(255,255,255,0.7);
        font-size: 0.875rem;
        font-weight: 500;
        margin: 0;
    }

    .sidebar-nav {
        padding: 1rem 0;
        flex: 1;
    }

    .sidebar-nav-item {
        margin: 0.25rem 0;
        list-style: none;
    }

    .sidebar-nav-link {
        display: flex;
        align-items: center;
        padding: 0.875rem 1.5rem;
        color: rgba(255,255,255,0.8) !important;
        text-decoration: none;
        font-weight: 500;
        border-radius: 0 25px 25px 0;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .sidebar-nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 0;
        background: rgba(255,255,255,0.2);
        transition: width 0.3s ease;
        z-index: -1;
    }

    .sidebar-nav-link:hover::before {
        width: 100%;
    }

    .sidebar-nav-link:hover {
        color: white !important;
        transform: translateX(4px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .sidebar-nav-link.active {
        background: rgba(255,255,255,0.2);
        color: white !important;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .sidebar-nav-link.active::before {
        width: 100%;
    }

    .sidebar-nav-link i {
        margin-right: 0.75rem;
        width: 1.25em;
        text-align: center;
        font-size: 1.1em;
    }

    .sidebar-nav-link span {
        flex-grow: 1;
        transition: opacity 0.3s ease, width 0.3s ease;
    }

    .sidebar-modern.collapsed .sidebar-nav-link span {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    .sidebar-modern.collapsed .sidebar-nav-link:hover span {
        opacity: 1;
        width: auto;
        position: absolute;
        left: 70px;
        background: rgba(0,0,0,0.8);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        white-space: nowrap;
        z-index: 1000;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    .sidebar-nav-link .badge {
        background: rgba(255,255,255,0.3);
        color: white;
        font-size: 0.75em;
        padding: 0.25em 0.5em;
        border-radius: 10px;
        margin-left: auto;
        transition: opacity 0.3s ease;
    }

    .sidebar-modern.collapsed .sidebar-nav-link .badge {
        opacity: 0;
    }

    /* Mobile Offcanvas */
    .sidebar-offcanvas {
        background: linear-gradient(180deg, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.98) 100%);
        backdrop-filter: blur(20px);
        width: 280px !important;
        box-shadow: 2px 0 20px rgba(0,0,0,0.3);
    }

    .sidebar-offcanvas .sidebar-header {
        background: rgba(255,255,255,0.1);
        border-radius: 15px 15px 0 0;
        margin: 0 1rem 1rem;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
    }

    .sidebar-offcanvas .sidebar-nav-link {
        margin: 0.25rem 1rem;
        border-radius: 12px;
        backdrop-filter: blur(10px);
    }

    /* User Profile Section */
    .sidebar-profile {
        padding: 1.5rem;
        border-top: 1px solid rgba(255,255,255,0.2);
        margin-top: auto;
        background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.1) 100%);
    }

    .profile-card {
        background: rgba(255,255,255,0.1);
        border-radius: 15px;
        padding: 1rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .profile-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.5rem;
        color: white;
    }

    .profile-info h6 {
        color: white;
        margin: 0 0 0.25rem 0;
        font-weight: 600;
    }

    .profile-info p {
        color: rgba(255,255,255,0.7);
        margin: 0;
        font-size: 0.875rem;
    }

    /* Account Menu */
    .account-menu {
        margin-top: 1rem;
    }

    .account-menu-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        color: rgba(255,255,255,0.8) !important;
        text-decoration: none;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        margin-bottom: 0.25rem;
    }

    .account-menu-item:hover {
        background: rgba(255,255,255,0.1);
        color: white !important;
        transform: translateX(2px);
    }

    .account-menu-item i {
        margin-right: 0.5rem;
        width: 1em;
        text-align: center;
    }

    .account-menu-item.text-danger:hover {
        background: rgba(220, 53, 69, 0.2);
    }

    /* Scrollbar Styling */
    .sidebar-modern::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-modern::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.1);
        border-radius: 3px;
    }

    .sidebar-modern::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.3);
        border-radius: 3px;
    }

    .sidebar-modern::-webkit-scrollbar-thumb:hover {
        background: rgba(255,255,255,0.5);
    }

    /* Animation Classes */
    .sidebar-nav-item {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .sidebar-nav-item:nth-child(1) { animation-delay: 0.1s; }
    .sidebar-nav-item:nth-child(2) { animation-delay: 0.2s; }
    .sidebar-nav-item:nth-child(3) { animation-delay: 0.3s; }
    .sidebar-nav-item:nth-child(4) { animation-delay: 0.4s; }
    .sidebar-nav-item:nth-child(5) { animation-delay: 0.5s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
        from {
            opacity: 0;
            transform: translateY(20px);
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        .sidebar-nav-link,
        .sidebar-brand,
        .sidebar-toggle-mobile {
            transition: none;
        }

        .sidebar-nav-item {
            animation: none;
            opacity: 1;
        }
    }

    /* Focus states */
    .sidebar-nav-link:focus {
        outline: 2px solid rgba(255,255,255,0.8);
        outline-offset: 2px;
    }
</style>

<!-- Mobile Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start sidebar-offcanvas d-lg-none" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel" style="width: 280px;">
    <div class="offcanvas-header sidebar-header">
        <a class="sidebar-brand" href="index.php">
            <i class="fas fa-graduation-cap brand-icon"></i>
            <span>CourseHub</span>
        </a>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="sidebar-nav">
        <ul class="list-unstyled">
            <?php if ($role == 1): // Instructor ?>
                <!-- Main Navigation -->
                <li class="sidebar-nav-item">
                    <a href="index.php?action=instructorDashboard" class="sidebar-nav-link <?php echo $currentAction === 'instructorDashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=manageCourses" class="sidebar-nav-link <?php echo in_array($currentAction, ['manageCourses', 'createCourse', 'editCourse']) ? 'active' : ''; ?>">
                        <i class="fas fa-book"></i>
                        <span>Courses</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=manageLessons" class="sidebar-nav-link <?php echo in_array($currentAction, ['manageLessons', 'createLesson', 'editLesson']) ? 'active' : ''; ?>">
                        <i class="fas fa-list"></i>
                        <span>Lessons</span>
                    </a>
                </li>

                <!-- Management Section -->
                <li class="sidebar-nav-item">
                    <div class="sidebar-nav-link" style="pointer-events: none; opacity: 0.7; font-size: 0.8em; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fas fa-cog"></i>
                        <span>Management</span>
                    </div>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=manageCourses" class="sidebar-nav-link <?php echo in_array($currentAction, ['manageCourses', 'createCourse', 'editCourse', 'manageLessons', 'createLesson', 'editLesson', 'uploadMaterial']) ? 'active' : ''; ?>">
                        <i class="fas fa-book-open"></i>
                        <span>Manage Courses</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=viewAllStudents" class="sidebar-nav-link <?php echo $currentAction === 'viewAllStudents' ? 'active' : ''; ?>">
                        <i class="fas fa-users"></i>
                        <span>Students</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=uploadMaterial" class="sidebar-nav-link <?php echo $currentAction === 'uploadMaterial' ? 'active' : ''; ?>">
                        <i class="fas fa-upload"></i>
                        <span>Materials</span>
                    </a>
                </li>
            <?php elseif ($role == 2): // Admin ?>
                <!-- Main Navigation -->
                <li class="sidebar-nav-item">
                    <a href="index.php?action=adminDashboard" class="sidebar-nav-link <?php echo $currentAction === 'adminDashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=manageUsers" class="sidebar-nav-link <?php echo $currentAction === 'manageUsers' ? 'active' : ''; ?>">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=approveCourses" class="sidebar-nav-link <?php echo $currentAction === 'approveCourses' ? 'active' : ''; ?>">
                        <i class="fas fa-check-circle"></i>
                        <span>Approve</span>
                        <?php if (isset($pendingCourses) && $pendingCourses > 0): ?>
                            <span class="badge"><?php echo $pendingCourses; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=viewStatistics" class="sidebar-nav-link <?php echo $currentAction === 'viewStatistics' ? 'active' : ''; ?>">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analytics</span>
                    </a>
                </li>

                <!-- Management Section -->
                <li class="sidebar-nav-item">
                    <div class="sidebar-nav-link" style="pointer-events: none; opacity: 0.7; font-size: 0.8em; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fas fa-cog"></i>
                        <span>Management</span>
                    </div>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=manageCategories" class="sidebar-nav-link <?php echo $currentAction === 'manageCategories' ? 'active' : ''; ?>">
                        <i class="fas fa-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
            <?php else: // Student ?>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=listCourses" class="sidebar-nav-link <?php echo $currentAction === 'listCourses' ? 'active' : ''; ?>">
                        <i class="fas fa-book"></i>
                        <span>Browse Courses</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=myCourses" class="sidebar-nav-link <?php echo $currentAction === 'myCourses' ? 'active' : ''; ?>">
                        <i class="fas fa-user-graduate"></i>
                        <span>My Courses</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=studentDashboard" class="sidebar-nav-link <?php echo $currentAction === 'studentDashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-chart-line"></i>
                        <span>My Progress</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
    <div class="sidebar-profile">
        <div class="profile-card">
            <div class="d-flex align-items-center mb-3">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info flex-grow-1">
                    <h6><?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></h6>
                    <p><?php echo ucfirst($userRole); ?> Account</p>
                </div>
            </div>

            <!-- Account Menu -->
            <div class="account-menu">
                <a href="index.php?action=profile" class="account-menu-item">
                    <i class="fas fa-user-cog"></i>
                    <span>Profile Settings</span>
                </a>
                <a href="index.php?action=changePassword" class="account-menu-item">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                </a>
                <hr style="border-color: rgba(255,255,255,0.2); margin: 0.75rem 0;">
                <a href="index.php?action=logout" class="account-menu-item text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Desktop Sidebar -->
<!-- Desktop Sidebar -->
<div class="d-none d-lg-flex flex-column sidebar-modern <?php echo $sidebarClass; ?> mt-4">
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar-header" id="refCourse">
        
        <a class="sidebar-brand" href="index.php">
            <i class="fas fa-graduation-cap brand-icon"></i>
            <span>CourseHub</span>
        </a>
        <p class="sidebar-subtitle">Professional Learning Platform</p>
    </div>

    <div class="sidebar-nav flex-grow-1">
        <ul class="list-unstyled">
            <?php if ($role == 1): // Instructor ?>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=instructorDashboard" class="sidebar-nav-link <?php echo $currentAction === 'instructorDashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=manageCourses" class="sidebar-nav-link <?php echo in_array($currentAction, ['manageCourses', 'createCourse', 'editCourse', 'manageLessons', 'createLesson', 'editLesson', 'uploadMaterial']) ? 'active' : ''; ?>">
                        <i class="fas fa-book"></i>
                        <span>Manage Courses</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=viewAllStudents" class="sidebar-nav-link <?php echo $currentAction === 'viewAllStudents' ? 'active' : ''; ?>">
                        <i class="fas fa-users"></i>
                        <span>Students</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=uploadMaterial" class="sidebar-nav-link <?php echo $currentAction === 'uploadMaterial' ? 'active' : ''; ?>">
                        <i class="fas fa-upload"></i>
                        <span>Materials</span>
                    </a>
                </li>
            <?php elseif ($role == 2): // Admin ?>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=adminDashboard" class="sidebar-nav-link <?php echo $currentAction === 'adminDashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=manageUsers" class="sidebar-nav-link <?php echo $currentAction === 'manageUsers' ? 'active' : ''; ?>">
                        <i class="fas fa-users"></i>
                        <span>Manage Users</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=manageCategories" class="sidebar-nav-link <?php echo $currentAction === 'manageCategories' ? 'active' : ''; ?>">
                        <i class="fas fa-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=viewStatistics" class="sidebar-nav-link <?php echo $currentAction === 'viewStatistics' ? 'active' : ''; ?>">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistics</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=approveCourses" class="sidebar-nav-link <?php echo $currentAction === 'approveCourses' ? 'active' : ''; ?>">
                        <i class="fas fa-check-circle"></i>
                        <span>Approve Courses</span>
                        <?php if (isset($pendingCourses) && $pendingCourses > 0): ?>
                            <span class="badge"><?php echo $pendingCourses; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php else: // Student ?>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=listCourses" class="sidebar-nav-link <?php echo $currentAction === 'listCourses' ? 'active' : ''; ?>">
                        <i class="fas fa-book"></i>
                        <span>Browse Courses</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=myCourses" class="sidebar-nav-link <?php echo $currentAction === 'myCourses' ? 'active' : ''; ?>">
                        <i class="fas fa-user-graduate"></i>
                        <span>My Courses</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="index.php?action=studentDashboard" class="sidebar-nav-link <?php echo $currentAction === 'studentDashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-chart-line"></i>
                        <span>My Progress</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
    <div class="sidebar-profile">
        <div class="profile-card">
            <div class="d-flex align-items-center mb-3">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info flex-grow-1">
                    <h6><?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></h6>
                    <p><?php echo ucfirst($userRole); ?> Account</p>
                </div>
            </div>

            <!-- Account Menu -->
            <div class="account-menu">
                <a href="index.php?action=profile" class="account-menu-item">
                    <i class="fas fa-user-cog"></i>
                    <span>Profile Settings</span>
                </a>
                <a href="index.php?action=changePassword" class="account-menu-item">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                </a>
                <hr style="border-color: rgba(255,255,255,0.2); margin: 0.75rem 0;">
                <a href="index.php?action=logout" class="account-menu-item text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
