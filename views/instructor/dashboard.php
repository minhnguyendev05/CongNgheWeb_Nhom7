<?php
$title = 'Bảng điều khiển giảng viên';
require 'views/layouts/header.php';
?>



<div class="dashboard-container content-padding mt-3">
    <!-- Welcome Header -->
    <div class="row mb-5" data-aos="fade-down">
        <div class="col-12">
            <div class="welcome-header">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold">
                            <i class="fas fa-chalkboard-teacher me-3"></i>Chào mừng trở lại, giảng viên!
                        </h1>
                        <p class="lead mb-4">Quản lý khóa học và truyền cảm hứng cho học viên trên toàn thế giới</p>
                        <div class="welcome-actions">
                            <a href="<?php echo BASE_PATH; ?>/instructor/course/create" class="btn-welcome">
                                <i class="fas fa-plus me-2"></i>Tạo khóa học
                            </a>
                            <a href="<?php echo BASE_PATH; ?>/instructor/courses" class="btn-welcome">
                                <i class="fas fa-cog me-2"></i>Quản lý khóa học
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="welcome-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="stats-grid">
        <div class="stat-card stat-courses" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Khóa học của tôi</h3>
                        <div class="stat-value"><?php echo count($courses); ?></div>
                        <div class="stat-label">
                            <i class="fas fa-arrow-up"></i>Đã xuất bản
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: <?php echo count($courses) > 0 ? '85%' : '0%'; ?>"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-enrollments" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Tổng số đăng ký</h3>
                        <div class="stat-value"><?php
                            $totalEnrollments = 0;
                            foreach ($courses as $course) {
                                $totalEnrollments += $course['enrollment_count'] ?? 0;
                            }
                            echo $totalEnrollments;
                        ?></div>
                        <div class="stat-label">
                            <i class="fas fa-users"></i>Học viên
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: <?php echo $totalEnrollments > 0 ? min(($totalEnrollments / max(count($courses) * 10, 1)) * 100, 100) : 0; ?>%"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-rating" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Đánh giá trung bình</h3>
                        <div class="stat-value">4.5</div>
                        <div class="stat-label">
                            <i class="fas fa-star"></i>Xuất sắc
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: 90%"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-revenue" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Tổng doanh thu</h3>
                        <div class="stat-value">$<?php
                            $totalRevenue = 0;
                            foreach ($courses as $course) {
                                $totalRevenue += ($course['enrollment_count'] ?? 0) * 49.99;
                            }
                            echo number_format($totalRevenue, 0);
                        ?></div>
                        <div class="stat-label">
                            <i class="fas fa-dollar-sign"></i>Thu nhập
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: <?php echo $totalRevenue > 0 ? min(($totalRevenue / 10000) * 100, 100) : 0; ?>%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Courses & Quick Actions -->
    <div class="content-grid">
        <div class="courses-section" data-aos="fade-up" data-aos-delay="100">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <h3 class="section-title">Khóa học gần đây</h3>
                    <p class="section-subtitle">Quản lý và theo dõi các khóa học đã xuất bản</p>
                </div>
            </div>

            <?php if (!empty($courses)): ?>
                <div class="row g-3">
                    <?php foreach (array_slice($courses, 0, 6) as $course): ?>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="course-card h-100">
                                <div class="card-body h-100">
                                    <div class="course-header">
                                        <div class="course-icon">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div class="course-info">
                                            <h6 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h6>
                                            <div class="course-meta">
                                                <div class="meta-item">
                                                    <i class="fas fa-users"></i><?php echo $course['enrollment_count'] ?? 0; ?> học viên
                                                </div>
                                                <div class="meta-item">
                                                    <i class="fas fa-clock"></i><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-actions">
                                        <a href="<?php echo BASE_PATH; ?>/instructor/course/<?php echo $course['id']; ?>/lessons" class="btn-manage">
                                            <i class="fas fa-cog me-1"></i>Quản lý
                                        </a>
                                        <a href="<?php echo BASE_PATH; ?>/instructor/course/<?php echo $course['id']; ?>/students" class="btn-students">
                                            <i class="fas fa-users me-1"></i>Học viên
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state" data-aos="fade-up">
                    <div class="mb-4">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h4>Chưa có khóa học nào</h4>
                    <p>Bắt đầu tạo khóa học đầu tiên để chia sẻ kiến thức với học viên.</p>
                    <a href="<?php echo BASE_PATH; ?>/instructor/course/create" class="btn-create-first">
                        <i class="fas fa-plus me-2"></i>Tạo khóa học đầu tiên
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="actions-section" data-aos="fade-up" data-aos-delay="300">
            <div class="actions-header">
                <div class="actions-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div>
                    <h3 class="actions-title">Hành động nhanh</h3>
                    <p class="actions-subtitle">Các tác vụ phổ biến của giảng viên</p>
                </div>
            </div>

            <div class="d-grid gap-3">
                <a href="<?php echo BASE_PATH; ?>/instructor/course/create" class="action-button action-create">
                    <div class="action-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="action-info">
                        <h6>Tạo khóa học</h6>
                        <small>Thêm nội dung khóa học mới</small>
                    </div>
                </a>

                <a href="<?php echo BASE_PATH; ?>/instructor/courses" class="action-button action-manage">
                    <div class="action-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="action-info">
                        <h6>Quản lý khóa học</h6>
                        <small>Chỉnh sửa khóa học hiện có</small>
                    </div>
                </a>

                <a href="<?php echo BASE_PATH; ?>/instructor/courses" class="action-button action-analytics">
                    <div class="action-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="action-info">
                        <h6>Xem thống kê</h6>
                        <small>Theo dõi hiệu suất</small>
                    </div>
                </a>

                <a href="<?php echo BASE_PATH; ?>/instructor/courses" class="action-button action-upload">
                    <div class="action-icon">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="action-info">
                        <h6>Tải lên tài liệu</h6>
                        <small>Thêm tài nguyên khóa học</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>




