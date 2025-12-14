<?php
// enrolled_course_lessons.php - View lessons for enrolled course
$title = 'Lessons: ' . htmlspecialchars($course['title']);
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
                                <i class="fas fa-book-open me-3"></i><?php echo htmlspecialchars($course['title']); ?>
                            </h1>
                            <p class="lead mb-4">Access all lessons in this course</p>
                            <div class="course-info-badges">
                                <span class="info-badge">
                                    <i class="fas fa-clock me-1"></i><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần
                                </span>
                                <span class="info-badge">
                                    <i class="fas fa-user-graduate me-1"></i><?php echo htmlspecialchars($course['instructor_name'] ?? 'Instructor'); ?>
                                </span>
                                <span class="info-badge">
                                    <i class="fas fa-play-circle me-1"></i><?php echo count($lessons); ?> lessons
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

        <!-- Lessons List -->
        <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="content-card">
                    <div class="card-header bg-white border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-book-open text-success fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Course Lessons</h5>
                                <p class="text-muted mb-0">Complete all lessons to finish this course</p>
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
                                            <p class="lesson-description"><?php echo htmlspecialchars(substr($lesson['content'] ?? $lesson['description'] ?? '', 0, 150)); ?>...</p>
                                            <div class="lesson-meta">
                                                <span><i class="fas fa-clock"></i> <?php echo $lesson['duration'] ?? $lesson['duration_minutes'] ?? 30; ?> min</span>
                                                <span><i class="fas fa-play-circle"></i> Lesson <?php echo $lessonNumber; ?></span>
                                            </div>
                                        </div>
                                        <div class="lesson-actions">
                                            <a href="<?php echo BASE_PATH; ?>/lesson/<?php echo $lesson['id']; ?>" class="btn btn-sm btn-primary btn-lesson">
                                                <i class="fas fa-play me-1"></i>Start Lesson
                                            </a>
                                            <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>/progress" class="btn btn-sm btn-outline-primary btn-lesson">
                                                <i class="fas fa-chart-line me-1"></i>Progress
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
</div>

<?php require 'views/layouts/footer.php'; ?>




