<?php
// header.php - Professional header with modern navbar
$role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : null;
$navbarClass = $role == 1 ? 'navbar-instructor' : ($role == 2 ? 'navbar-admin' : 'navbar-student');
$brandText = $role == 1 ? 'Instructor' : ($role == 2 ? 'Admin' : 'Student');
$userRole = $role == 1 ? 'instructor' : ($role == 2 ? 'admin' : 'student');
$currentAction = $_GET['action'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Professional Online Course Platform - Learn, Teach, and Grow">
    <meta name="keywords" content="online courses, learning platform, education, e-learning">
    <title><?php echo $title ?? 'Online Course Platform'; ?> - <?php echo $brandText; ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Google Fonts: Inter for modern look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Lux Theme -->
    <link rel="stylesheet" href="assets/css/bootstrap-lux.min.css">

    <!-- AOS Animation Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Role-specific Styles -->
    <?php if ($role == 2): ?>
        <link rel="stylesheet" href="assets/css/admin/style.css">
    <?php elseif ($role == 1): ?>
        <link rel="stylesheet" href="assets/css/instructor/style.css">
    <?php else: ?>
        <link rel="stylesheet" href="assets/css/student/style.css">
    <?php endif; ?>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #fcb045 0%, #fd1d1d 100%);
            --info-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.15);
            --shadow-lg: 0 8px 32px rgba(0,0,0,0.2);
            --border-radius: 12px;
            --border-radius-lg: 16px;
        }

        /* Main Layout Styles */
        .main-layout-wrapper {
            min-height: calc(100vh - 76px);
        }

        .main-content {
            padding: 0;
            background: #f8f9fa;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .main-layout-wrapper {
                flex-direction: column;
            }

            .main-content {
                margin-left: 0 !important;
            }
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding-top: 76px;
        }

        /* Modern Navbar Styles */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.1);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .navbar-modern.navbar-student {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
            border-bottom: 1px solid rgba(102, 126, 234, 0.3);
        }

        .navbar-modern.navbar-instructor {
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.95) 0%, rgba(56, 239, 125, 0.95) 100%);
            border-bottom: 1px solid rgba(17, 153, 142, 0.3);
        }

        .navbar-modern.navbar-admin {
            background: linear-gradient(135deg, rgba(252, 176, 69, 0.95) 0%, rgba(253, 29, 29, 0.95) 100%);
            border-bottom: 1px solid rgba(252, 176, 69, 0.3);
        }

        .navbar-brand-modern {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand-modern:hover {
            color: rgba(255, 255, 255, 0.9) !important;
            transform: scale(1.02);
        }

        .navbar-brand-modern .brand-icon {
            font-size: 2rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.75rem 1rem;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
            font-weight: 600;
        }

        .navbar-nav .nav-link i {
            margin-right: 0.5rem;
            width: 1.2em;
        }

        /* User Dropdown */
        .user-dropdown .dropdown-toggle {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            color: white !important;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .user-dropdown .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .user-dropdown .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            margin-top: 0.5rem;
            min-width: 200px;
        }

        .user-dropdown .dropdown-item {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin: 0.25rem;
            transition: all 0.2s ease;
        }

        .user-dropdown .dropdown-item:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateX(4px);
        }

        .user-dropdown .dropdown-item i {
            margin-right: 0.5rem;
            width: 1.2em;
        }

        .user-dropdown .dropdown-item.text-danger:hover {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        }

        /* Auth Buttons */
        .auth-buttons .btn {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .auth-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        /* Mobile Menu */
        .navbar-toggler-modern {
            border: none;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 0.75rem;
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .navbar-toggler-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .navbar-toggler-modern:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .navbar-toggler-modern:hover::before {
            opacity: 1;
        }

        .navbar-toggler-modern:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.3);
        }

        /* Mobile Sidebar Toggle */
        .sidebar-mobile-toggle {
            border: none;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white !important;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .sidebar-mobile-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
            color: white !important;
        }

        .sidebar-mobile-toggle:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.3);
            outline: none;
        }

        /* Hide navbar toggler and collapse on mobile for all roles */
        @media (max-width: 991.98px) {
            .navbar-modern.navbar-instructor .navbar-toggler,
            .navbar-modern.navbar-admin .navbar-toggler,
            .navbar-modern.navbar-student .navbar-toggler,
            .navbar-modern.navbar-instructor .navbar-collapse,
            .navbar-modern.navbar-admin .navbar-collapse,
            .navbar-modern.navbar-student .navbar-collapse {
                display: none !important;
            }
        }

        /* Mobile navbar layout */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(0, 0, 0, 0.9);
                backdrop-filter: blur(20px);
                border-radius: 12px;
                margin-top: 1rem;
                padding: 1rem;
                box-shadow: var(--shadow-lg);
            }

            .navbar-nav {
                margin: 0;
            }

            .navbar-nav .nav-link {
                margin: 0.25rem 0;
                color: white !important;
            }

            .user-dropdown .dropdown-menu {
                background: rgba(0, 0, 0, 0.9);
                backdrop-filter: blur(20px);
            }

            /* Mobile navbar layout */
            .navbar-nav {
                flex-direction: row;
                justify-content: space-around;
                width: 100%;
            }

            .navbar-nav .nav-item {
                flex: 1;
                text-align: center;
            }
        }

        /* Loading Animation */
        .navbar-loading {
            position: relative;
            overflow: hidden;
        }

        .navbar-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            .navbar-nav .nav-link,
            .user-dropdown .dropdown-toggle,
            .auth-buttons .btn,
            .navbar-toggler-modern {
                transition: none;
            }
        }

        /* Focus states for accessibility */
        .navbar-nav .nav-link:focus,
        .user-dropdown .dropdown-toggle:focus,
        .auth-buttons .btn:focus,
        .navbar-toggler-modern:focus {
            outline: 2px solid rgba(255, 255, 255, 0.8);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <!-- Modern Navbar -->
    <nav class="navbar navbar-expand-lg navbar-modern <?php echo $navbarClass; ?> fixed-top">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand navbar-brand-modern" href="index.php">
                <i class="fas fa-graduation-cap brand-icon"></i>
                <span>CourseHub</span>
                <small class="text-white-50 ms-2 d-none d-sm-inline"><?php echo $brandText; ?></small>
            </a>

            <!-- Mobile Sidebar Toggle (only on mobile when logged in) -->
            <?php if (isset($_SESSION['user'])): ?>
                <button class="btn btn-link sidebar-mobile-toggle d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas" aria-label="Toggle sidebar">
                    <i class="fas fa-list-ul text-white"></i>
                </button>
            <?php endif; ?>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler navbar-toggler-modern" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navigation Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                    <?php if ($role == 1): // Instructor ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentAction === 'instructorDashboard' ? 'active' : ''; ?>" href="index.php?action=instructorDashboard">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo in_array($currentAction, ['manageCourses', 'createCourse', 'editCourse']) ? 'active' : ''; ?>" href="index.php?action=manageCourses">
                                <i class="fas fa-book"></i>Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo in_array($currentAction, ['manageLessons', 'createLesson', 'editLesson']) ? 'active' : ''; ?>" href="index.php?action=manageLessons&courseId=1">
                                <i class="fas fa-list"></i>Lessons
                            </a>
                        </li>
                    <?php elseif ($role == 2): // Admin ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentAction === 'adminDashboard' ? 'active' : ''; ?>" href="index.php?action=adminDashboard">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentAction === 'manageUsers' ? 'active' : ''; ?>" href="index.php?action=manageUsers">
                                <i class="fas fa-users"></i>Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentAction === 'approveCourses' ? 'active' : ''; ?>" href="index.php?action=approveCourses">
                                <i class="fas fa-check-circle"></i>Approve
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentAction === 'viewStatistics' ? 'active' : ''; ?>" href="index.php?action=viewStatistics">
                                <i class="fas fa-chart-bar"></i>Analytics
                            </a>
                        </li>
                    <?php else: // Student ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentAction === 'listCourses' ? 'active' : ''; ?>" href="index.php?action=listCourses">
                                <i class="fas fa-book"></i>Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentAction === 'myCourses' ? 'active' : ''; ?>" href="index.php?action=myCourses">
                                <i class="fas fa-user-graduate"></i>My Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentAction === 'studentDashboard' ? 'active' : ''; ?>" href="index.php?action=studentDashboard">
                                <i class="fas fa-chart-line"></i>Progress
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- User Menu / Auth Buttons -->
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item user-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-circle p-1 me-2">
                                        <i class="fas fa-user-circle fa-lg"></i>
                                    </div>
                                    <div class="d-none d-md-block">
                                        <div class="fw-semibold"><?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></div>
                                        <small class="text-white-50"><?php echo $brandText; ?></small>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="index.php?action=profile">
                                        <i class="fas fa-user"></i>Profile Settings
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=changePassword">
                                        <i class="fas fa-key"></i>Change Password
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="index.php?action=logout">
                                        <i class="fas fa-sign-out-alt"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item auth-buttons">
                            <a class="btn btn-outline-light me-2" href="index.php?action=login">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                            <a class="btn btn-light" href="index.php?action=register">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Layout Wrapper -->
    <div class="main-layout-wrapper d-flex">
        <!-- Sidebar will be included here -->
        <?php if (isset($_SESSION['user'])): ?>
            <?php require 'views/layouts/sidebar.php'; ?>
        <?php endif; ?>

        <!-- Main Content Area -->
        <div class="main-content flex-grow-1 min-vh-100">
