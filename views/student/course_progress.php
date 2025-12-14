<?php
// course_progress.php - Course progress page with soft, eye-friendly colors
$title = 'Course Progress';
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
                                <i class="fas fa-chart-line me-3"></i><?php echo htmlspecialchars($course['title']); ?>
                            </h1>
                            <p class="lead mb-4"><?php echo htmlspecialchars($course['description']); ?></p>
                            <div class="course-info-badges">
                                <span class="info-badge">
                                    <i class="fas fa-clock me-1"></i><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần
                                </span>
                                <span class="info-badge">
                                    <i class="fas fa-user-graduate me-1"></i><?php echo $course['instructor_name'] ?? 'Instructor'; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="welcome-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Progress Overview -->
    <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="content-card">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-trophy text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Your Progress</h5>
                                <p class="text-muted mb-0">Track your learning journey</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="h3 mb-0 fw-bold text-primary"><?php echo count($completedLessons ?? []); ?>/<?php echo count($lessons); ?> Lessons</div>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="progress mb-4" style="height: 12px;">
                        <div class="progress-bar bg-primary rounded-pill" role="progressbar"
                             style="width: <?php echo count($lessons) > 0 ? (count($completedLessons ?? []) / count($lessons)) * 100 : 0; ?>%"
                             aria-valuenow="<?php echo count($completedLessons ?? []); ?>"
                             aria-valuemin="0" aria-valuemax="<?php echo count($lessons); ?>">
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="border-end">
                                <div class="h4 mb-1 fw-bold text-primary"><?php echo round((count($completedLessons ?? []) / max(count($lessons), 1)) * 100, 1); ?>%</div>
                                <small class="text-muted">Completion Rate</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border-end">
                                <div class="h4 mb-1 fw-bold text-success"><?php echo count($completedLessons ?? []); ?></div>
                                <small class="text-muted">Lessons Completed</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="h4 mb-1 fw-bold text-info"><?php echo count($lessons) - count($completedLessons ?? []); ?></div>
                            <small class="text-muted">Lessons Remaining</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                    <!-- Lessons List -->
    <div class="row" data-aos="fade-up" data-aos-delay="400">
        <div class="col-12">
            <div class="content-card">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-book-open text-success fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Course Lessons</h5>
                            <p class="text-muted mb-0">Complete all lessons to finish the course</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($lessons)): ?>
                        <div class="lessons-list">
                            <?php $lessonNumber = 1; ?>
                            <?php foreach ($lessons as $lesson): ?>
                                <div class="lesson-item" data-aos="fade-right" data-aos-delay="<?php echo 300 + ($lessonNumber * 50); ?>">
                                    <div class="lesson-number">
                                        <?php echo $lessonNumber; ?>
                                    </div>
                                    <div class="lesson-content">
                                        <h6 class="lesson-title"><?php echo htmlspecialchars($lesson['title']); ?></h6>
                                        <p class="lesson-description"><?php echo htmlspecialchars(substr($lesson['description'] ?? '', 0, 150)); ?>...</p>
                                        <div class="lesson-meta">
                                            <span><i class="fas fa-clock"></i> <?php echo $lesson['duration'] ?? 30; ?> min</span>
                                            <span><i class="fas fa-play-circle"></i> Lesson <?php echo $lessonNumber; ?></span>
                                        </div>
                                    </div>
                                    <div class="lesson-actions">
                                        <a href="<?php echo BASE_PATH; ?>/lesson/<?php echo $lesson['id']; ?>" class="btn btn-sm btn-primary btn-lesson">
                                            <i class="fas fa-play me-1"></i>Start Lesson
                                        </a>
                                    </div>
                                </div>
                                <?php $lessonNumber++; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <div class="mb-4">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h3>No lessons available</h3>
                            <p>This course doesn't have any lessons yet. Please check back later.</p>
                            <a href="<?php echo BASE_PATH; ?>/my-courses" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-2"></i>Back to My Courses
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>


