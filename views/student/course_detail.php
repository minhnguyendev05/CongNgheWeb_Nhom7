<?php
// course_detail.php - Course detail page with soft, eye-friendly colors
$title = 'Course Details';
require 'views/layouts/header.php';
?>

<div class="page-container p-0">
    <div class="container-fluid content-padding">
        <!-- Course Header -->
        <div class="row mb-5" data-aos="fade-down">
            <div class="col-12">
                <div class="welcome-header">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold">
                                <i class="fas fa-graduation-cap me-3"></i><?php echo htmlspecialchars($course['title']); ?>
                            </h1>
                            <p class="lead mb-4"><?php echo htmlspecialchars($course['description']); ?></p>
                            <div class="course-info-badges">
                                <span class="info-badge">
                                    <i class="fas fa-clock me-1"></i><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần
                                </span>
                                <span class="info-badge">
                                    <i class="fas fa-user-graduate me-1"></i><?php echo $course['instructor_name'] ?? 'Instructor'; ?>
                                </span>
                                <span class="info-badge">
                                    <i class="fas fa-book me-1"></i><?php echo count($lessons); ?> bài học
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="welcome-icon">
                                <img src="<?= BASE_URL.'/' ?><?php echo htmlspecialchars($course['image'] ?? 'assets/img/default-course.png'); ?>" alt="Course Image" class="img-fluid" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Course Content -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-lg-8 mb-4">
            <div class="content-card">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-book-open text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Course Content</h5>
                            <p class="text-muted mb-0">Explore the lessons in this course</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($lessons)): ?>
                        <div class="lessons-list">
                            <?php $lessonNumber = 1; ?>
                            <?php foreach ($lessons as $lesson): ?>
                                <div class="lesson-item">
                                    <div class="lesson-number">
                                        <?php echo $lessonNumber; ?>
                                    </div>
                                    <div class="lesson-content">
                                        <h6 class="lesson-title"><?php echo htmlspecialchars($lesson['title']); ?></h6>
                                        <p class="lesson-description"><?php echo htmlspecialchars(substr($lesson['content'] ?? $lesson['description'] ?? '', 0, 100)); ?>...</p>
                                        <div class="lesson-meta">
                                            <span><i class="fas fa-clock"></i> <?php echo $lesson['duration'] ?? 30; ?> phút</span>
                                            <span><i class="fas fa-play-circle"></i> Lesson <?php echo $lessonNumber; ?></span>
                                        </div>
                                    </div>
                                    <div class="lesson-actions">
                                        <a href="<?php echo BASE_PATH; ?>/lesson/<?php echo $lesson['id']; ?>" class="btn btn-sm btn-primary btn-lesson">
                                            <i class="fas fa-play me-1"></i>View
                                        </a>
                                    </div>
                                </div>
                                <?php $lessonNumber++; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-book fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No lessons in this course yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="content-card sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="mb-0 fw-bold text-dark">Course Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Danh mục</h6>
                        <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill"><?php echo htmlspecialchars($course['category_name'] ?? 'Uncategorized'); ?></span>
                    </div>
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Instructor</h6>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-tie text-primary me-2"></i>
                            <span><?php echo htmlspecialchars($course['instructor_name'] ?? 'Unknown'); ?></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Thời lượng</h6>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock text-primary me-2"></i>
                            <span><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Số bài học</h6>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-book text-primary me-2"></i>
                            <span><?php echo count($lessons); ?> bài học</span>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <?php if ($isEnrolled): ?>
                            <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>/lessons" class="btn btn-primary">
                                <i class="fas fa-eye me-2"></i>View Course
                            </a>
                        <?php else: ?>
                            <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>/enroll" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Enroll in Course
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo BASE_PATH; ?>/courses" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>




