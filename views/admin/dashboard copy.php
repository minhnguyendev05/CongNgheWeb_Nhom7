<?php
require 'views/layouts/header.php';
require 'views/layouts/sidebar.php';
?>

<div class="content-wrapper d-md-none d-lg-block" style="margin-left: 16.666667%; padding: 20px;">
    <!-- Welcome Header -->
    <div class="row mb-5" data-aos="fade-down">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white border-0 rounded-4 shadow-lg">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold mb-3">
                                <i class="fas fa-crown me-3"></i>Welcome back, Administrator!
                            </h1>
                            <p class="lead mb-4 opacity-75">Manage the platform and oversee all activities</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="index.php?action=approveCourses" class="btn btn-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-check me-2"></i>Approve Courses
                                </a>
                                <a href="index.php?action=manageUsers" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-users me-2"></i>Manage Users
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-crown fa-6x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5 g-4">
        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted fw-semibold mb-1">Total Users</div>
                            <div class="h2 mb-0 fw-bold text-primary"><?php echo $totalUsers; ?></div>
                            <small class="text-success fw-semibold">
                                <i class="fas fa-arrow-up me-1"></i>Active Platform
                            </small>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary bg-opacity-10 border-0 p-3">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-primary" style="width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted fw-semibold mb-1">Approved Courses</div>
                            <div class="h2 mb-0 fw-bold text-success"><?php echo $totalCourses; ?></div>
                            <small class="text-success fw-semibold">
                                <i class="fas fa-check me-1"></i>Published Content
                            </small>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-book fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-success bg-opacity-10 border-0 p-3">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted fw-semibold mb-1">Pending Courses</div>
                            <div class="h2 mb-0 fw-bold text-warning"><?php echo $pendingCourses; ?></div>
                            <small class="text-warning fw-semibold">
                                <i class="fas fa-clock me-1"></i>Awaiting Review
                            </small>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-warning bg-opacity-10 border-0 p-3">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: <?php echo $pendingCourses > 0 ? min(($pendingCourses / max($totalCourses + $pendingCourses, 1)) * 100, 100) : 0; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted fw-semibold mb-1">Total Enrollments</div>
                            <div class="h2 mb-0 fw-bold text-info"><?php echo $totalEnrollments; ?></div>
                            <small class="text-info fw-semibold">
                                <i class="fas fa-graduation-cap me-1"></i>Active Learning
                            </small>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-graduation-cap fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-info bg-opacity-10 border-0 p-3">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-info" style="width: 90%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions and Recent Activity -->
    <div class="row g-4">
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-bolt text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Quick Actions</h5>
                            <p class="text-muted mb-0">Administrative tasks and management</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <a href="index.php?action=approveCourses" class="btn btn-primary btn-lg rounded-pill d-flex align-items-center justify-content-center">
                            <i class="fas fa-check fa-lg me-3"></i>
                            <div class="text-start">
                                <div class="fw-bold">Approve Courses</div>
                                <small class="opacity-75">Review and publish pending courses</small>
                            </div>
                        </a>

                        <a href="index.php?action=manageUsers" class="btn btn-outline-primary btn-lg rounded-pill d-flex align-items-center justify-content-center">
                            <i class="fas fa-users fa-lg me-3"></i>
                            <div class="text-start">
                                <div class="fw-bold">Manage Users</div>
                                <small class="opacity-75">User accounts and permissions</small>
                            </div>
                        </a>

                        <a href="index.php?action=manageCategories" class="btn btn-outline-success btn-lg rounded-pill d-flex align-items-center justify-content-center">
                            <i class="fas fa-tags fa-lg me-3"></i>
                            <div class="text-start">
                                <div class="fw-bold">Manage Categories</div>
                                <small class="opacity-75">Course categories and organization</small>
                            </div>
                        </a>

                        <a href="index.php?action=viewStatistics" class="btn btn-outline-info btn-lg rounded-pill d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-bar fa-lg me-3"></i>
                            <div class="text-start">
                                <div class="fw-bold">View Statistics</div>
                                <small class="opacity-75">Platform analytics and reports</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-bell text-info fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Recent Activity</h5>
                            <p class="text-muted mb-0">Latest platform activities and updates</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="timeline timeline-modern">
                        <div class="timeline-item" data-aos="fade-right" data-aos-delay="400">
                            <div class="timeline-marker bg-primary">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold">New user registered</h6>
                                    <small class="text-muted">2 mins ago</small>
                                </div>
                                <p class="mb-0 text-muted">A new student has joined the platform and is ready to start learning.</p>
                            </div>
                        </div>

                        <div class="timeline-item" data-aos="fade-right" data-aos-delay="500">
                            <div class="timeline-marker bg-success">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold">Course approved</h6>
                                    <small class="text-muted">5 mins ago</small>
                                </div>
                                <p class="mb-0 text-muted">A new course has been reviewed and published successfully.</p>
                            </div>
                        </div>

                        <div class="timeline-item" data-aos="fade-right" data-aos-delay="600">
                            <div class="timeline-marker bg-warning">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold">Student completed course</h6>
                                    <small class="text-muted">12 mins ago</small>
                                </div>
                                <p class="mb-0 text-muted">Congratulations to John Doe for completing "Web Development Fundamentals"!</p>
                            </div>
                        </div>

                        <div class="timeline-item" data-aos="fade-right" data-aos-delay="700">
                            <div class="timeline-marker bg-info">
                                <i class="fas fa-upload"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold">New material uploaded</h6>
                                    <small class="text-muted">18 mins ago</small>
                                </div>
                                <p class="mb-0 text-muted">Instructor Sarah uploaded new study materials for "Data Science Basics".</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
