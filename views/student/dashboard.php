<?php
$title = 'Bảng điều khiển học viên';
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
                            <i class="fas fa-graduation-cap me-3"></i>Chào mừng trở lại, <?php echo htmlspecialchars($_SESSION['user']['fullname'] ?? 'Học viên'); ?>!
                        </h1>
                        <p class="lead mb-4">Continue your learning journey and achieve your goals</p>
                        <div class="welcome-actions">
                            <a href="<?php echo BASE_PATH; ?>/courses" class="btn-welcome">
                                <i class="fas fa-search me-2"></i>Explore Courses
                            </a>
                            <a href="<?php echo BASE_PATH; ?>/my-courses" class="btn-welcome">
                                <i class="fas fa-book me-2"></i>My Courses
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="welcome-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="stats-grid">
        <div class="stat-card stat-enrolled" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Enrolled Courses</h3>
                        <div class="stat-value"><?php echo count($enrollments); ?></div>
                        <div class="stat-label">
                            <i class="fas fa-arrow-up"></i>Đang học tích cực
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: <?php echo count($enrollments) > 0 ? '75%' : '0%'; ?>"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-completed" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Completed Courses</h3>
                        <div class="stat-value"><?php echo count(array_filter($enrollments, fn($e) => ($e['progress'] ?? 0) == 100)); ?></div>
                        <div class="stat-label">
                            <i class="fas fa-check"></i>Thành tích
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: <?php echo count($enrollments) > 0 ? (count(array_filter($enrollments, fn($e) => ($e['progress'] ?? 0) == 100)) / count($enrollments)) * 100 : 0; ?>%"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-progress" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Tiến độ trung bình</h3>
                        <div class="stat-value"><?php echo round(array_sum(array_column($enrollments, 'progress')) / max(count($enrollments), 1), 1); ?>%</div>
                        <div class="stat-label">
                            <i class="fas fa-chart-line"></i>Tiến độ tổng thể
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: <?php echo round(array_sum(array_column($enrollments, 'progress')) / max(count($enrollments), 1), 1); ?>%"></div>
                </div>
            </div>
        </div>

        <div class="stat-card stat-certificates" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Chứng chỉ</h3>
                        <div class="stat-value"><?php echo count(array_filter($enrollments, fn($e) => ($e['progress'] ?? 0) == 100)); ?></div>
                        <div class="stat-label">
                            <i class="fas fa-certificate"></i>Đã nhận
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                </div>
                <div class="stat-progress-bar">
                    <div class="stat-progress-fill" style="width: <?php echo count($enrollments) > 0 ? (count(array_filter($enrollments, fn($e) => ($e['progress'] ?? 0) == 100)) / count($enrollments)) * 100 : 0; ?>%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- My Courses Progress -->
    <div class="courses-section" data-aos="fade-up">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-book"></i>
            </div>
            <h3 class="section-title">My Course Progress</h3>
        </div>

        <div class="row g-4">
            <?php if (!empty($enrollments)): ?>
                <?php $delay = 0; ?>
                <?php foreach ($enrollments as $enrollment): ?>
                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="course-progress-card">
                            <div class="card-body">
                                <div class="course-header">
                                    <div class="course-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div class="course-info">
                                        <h6 class="course-title"><?php echo htmlspecialchars($enrollment['title'] ?? 'Unknown Course'); ?></h6>
                                        <div class="progress-info">
                                            <span class="progress-label">Tiến độ:</span>
                                            <span class="progress-value"><?php echo $enrollment['progress'] ?? 0; ?>%</span>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="progress-bar-fill" style="width: <?php echo $enrollment['progress'] ?? 0; ?>%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-actions">
                                    <a href="<?php echo BASE_PATH; ?>/lesson/<?php echo $enrollment['next_lesson_id'] ?? 1; ?>" class="btn-continue">
                                        <i class="fas fa-play me-1"></i>Tiếp tục
                                    </a>
                                    <a href="<?php echo BASE_PATH; ?>/course/<?php echo $enrollment['course_id']; ?>/progress" class="btn-details">
                                        <i class="fas fa-chart-line me-1"></i>Chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $delay += 100; if ($delay > 300) $delay = 0; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state" data-aos="fade-up">
                        <div class="mb-4">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4>No Courses Enrolled Yet</h4>
                        <p>Start your learning journey by enrolling in a course.</p>
                        <a href="<?php echo BASE_PATH; ?>/courses" class="btn-browse">
                            <i class="fas fa-search me-2"></i>Khám phá khóa học
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>




