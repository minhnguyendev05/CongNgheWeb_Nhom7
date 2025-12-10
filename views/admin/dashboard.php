<?php
$title = 'Bảng điều khiển quản trị';
require 'views/layouts/header.php';
?>



<div class="dashboard-container mt-3">
    <!-- Welcome Header -->
    <div class="row mb-5" data-aos="fade-down">
        <div class="col-12">
            <div class="welcome-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold">
                            <i class="fas fa-crown me-3"></i>Chào mừng trở lại, Quản trị viên!
                        </h1>
                        <p class="lead mb-4">Quản lý nền tảng và giám sát tất cả hoạt động</p>
                        <div class="welcome-actions">
                            <a href="index.php?action=approveCourses" class="btn-welcome">
                                <i class="fas fa-check me-2"></i>Duyệt khóa học
                            </a>
                            <a href="index.php?action=manageUsers" class="btn-welcome">
                                <i class="fas fa-users me-2"></i>Quản lý người dùng
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="welcome-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card stat-users" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Tổng người dùng</h3>
                        <div class="stat-value"><?php echo $totalUsers; ?></div>
                        <div class="stat-label">
                            <i class="fas fa-arrow-up"></i>Nền tảng hoạt động
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: 85%"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-courses" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Khóa học đã duyệt</h3>
                        <div class="stat-value"><?php echo $totalCourses; ?></div>
                        <div class="stat-label">
                            <i class="fas fa-check"></i>Nội dung đã xuất bản
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: 75%"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-pending" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Khóa học chờ duyệt</h3>
                        <div class="stat-value"><?php echo $pendingCourses; ?></div>
                        <div class="stat-label">
                            <i class="fas fa-clock"></i>Đang chờ xem xét
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: <?php echo $pendingCourses > 0 ? min(($pendingCourses / max($totalCourses + $pendingCourses, 1)) * 100, 100) : 0; ?>%"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-enrollments" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Tổng đăng ký</h3>
                        <div class="stat-value"><?php echo $totalEnrollments; ?></div>
                        <div class="stat-label">
                            <i class="fas fa-graduation-cap"></i>Học tập tích cực
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: 90%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions and Recent Activity -->
    <div class="content-grid">
        <div class="actions-section" data-aos="fade-up" data-aos-delay="100">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div>
                    <h3 class="section-title">Hành động nhanh</h3>
                    <p class="section-subtitle">Các tác vụ quản trị và quản lý</p>
                </div>
            </div>

            <div class="d-grid gap-3">
                <a href="index.php?action=approveCourses" class="action-button action-approve">
                    <div class="action-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="action-info">
                        <h6>Duyệt khóa học</h6>
                        <small>Xem xét và xuất bản khóa học chờ duyệt</small>
                    </div>
                </a>

                <a href="index.php?action=manageUsers" class="action-button action-users">
                    <div class="action-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="action-info">
                        <h6>Quản lý người dùng</h6>
                        <small>Tài khoản và quyền người dùng</small>
                    </div>
                </a>

                <a href="index.php?action=manageCategories" class="action-button action-categories">
                    <div class="action-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="action-info">
                        <h6>Quản lý danh mục</h6>
                        <small>Danh mục khóa học và tổ chức</small>
                    </div>
                </a>

                <a href="index.php?action=viewStatistics" class="action-button action-stats">
                    <div class="action-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-info">
                        <h6>Xem thống kê</h6>
                        <small>Phân tích và báo cáo nền tảng</small>
                    </div>
                </a>
            </div>
        </div>

        <div class="activity-section" data-aos="fade-up" data-aos-delay="300">
            <div class="activity-header">
                <div class="activity-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div>
                    <h3 class="activity-title">Hoạt động gần đây</h3>
                    <p class="activity-subtitle">Các hoạt động và cập nhật mới nhất của nền tảng</p>
                </div>
            </div>

            <div class="timeline-modern">
                <div class="timeline-item" data-aos="fade-right" data-aos-delay="400">
                    <div class="timeline-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6>Người dùng mới đăng ký</h6>
                            <small class="timeline-time">2 phút trước</small>
                        </div>
                        <p>Một học viên mới đã tham gia nền tảng và sẵn sàng bắt đầu học tập.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-right" data-aos-delay="500">
                    <div class="timeline-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6>Khóa học đã được duyệt</h6>
                            <small class="timeline-time">5 phút trước</small>
                        </div>
                        <p>Một khóa học mới đã được xem xét và xuất bản thành công.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-right" data-aos-delay="600">
                    <div class="timeline-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6>Học viên hoàn thành khóa học</h6>
                            <small class="timeline-time">12 phút trước</small>
                        </div>
                        <p>Chúc mừng John Doe đã hoàn thành "Web Development Fundamentals"!</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-right" data-aos-delay="700">
                    <div class="timeline-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6>Tài liệu mới được tải lên</h6>
                            <small class="timeline-time">18 phút trước</small>
                        </div>
                        <p>Giảng viên Sarah đã tải lên tài liệu học tập mới cho "Data Science Basics".</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
