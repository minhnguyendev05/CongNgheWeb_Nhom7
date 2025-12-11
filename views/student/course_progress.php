<?php
// course_progress.php - Course progress page with soft, eye-friendly colors
$title = 'Course Progress';
require 'views/layouts/header.php';
?>

<div class="course-progress-container">
    <div class="container-fluid">
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

    <!-- Lesson Progress -->
    <div class="row" data-aos="fade-up" data-aos-delay="400">
        <div class="col-12">
            <div class="content-card">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-list-check text-info fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Lesson Progress</h5>
                            <p class="text-muted mb-0">Detailed progress for each lesson</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($lessons)): ?>
                        <div class="row g-4">
                            <?php foreach ($lessons as $index => $lesson): ?>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="lesson-progress-card border rounded-3 p-3 h-100">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="lesson-number me-3">
                                                <?php echo $index + 1; ?>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2 fw-semibold text-dark"><?php echo htmlspecialchars($lesson['title']); ?></h6>
                                                <div class="d-flex align-items-center mb-2">
                                                    <small class="text-muted me-3">
                                                        <i class="fas fa-clock me-1"></i><?php echo $lesson['duration_minutes'] ?? 'N/A'; ?> min
                                                    </small>
                                                    <?php if (isset($lesson['completed']) && $lesson['completed']): ?>
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check me-1"></i>Completed
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="fas fa-play me-1"></i>In Progress
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-primary rounded-pill" role="progressbar"
                                                         style="width: <?php echo $lesson['progress'] ?? 0; ?>%"
                                                         aria-valuenow="<?php echo $lesson['progress'] ?? 0; ?>"
                                                         aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <small class="text-muted mt-1 d-block"><?php echo $lesson['progress'] ?? 0; ?>% Complete</small>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="index.php?action=viewLesson&lessonId=<?php echo $lesson['id']; ?>" class="btn btn-primary btn-sm flex-fill">
                                                <i class="fas fa-play me-1"></i><?php echo (isset($lesson['completed']) && $lesson['completed']) ? 'Review' : 'Continue'; ?>
                                            </a>
                                            <?php if (isset($lesson['completed']) && !$lesson['completed']): ?>
                                                <button class="btn btn-success btn-sm" onclick="markCompleted(<?php echo $lesson['id']; ?>)">
                                                    <i class="fas fa-check me-1"></i>Complete
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No lessons available</h5>
                            <p class="text-muted">Lessons will be added to this course soon.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function markCompleted(lessonId) {
    if (confirm('Mark this lesson as completed?')) {
        // Add AJAX call to mark lesson as completed
        fetch('index.php?action=markLessonCompleted', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'lessonId=' + lessonId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating lesson progress');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating lesson progress');
        });
    }
}
</script>

<?php require 'views/layouts/footer.php'; ?>

<div class="course-progress-container">
    <div class="container-fluid">
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
                                <small class="text-muted">Lessons Done</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="h4 mb-1 fw-bold text-info"><?php echo count($lessons) - count($completedLessons ?? []); ?></div>
                            <small class="text-muted">Remaining</small>
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
                <div class="card-body p-4">
                    <div class="lesson-timeline">
                        <?php $lessonNumber = 1; ?>
                        <?php foreach ($lessons as $lesson): ?>
                            <div class="lesson-item <?php echo in_array($lesson['id'], $completedLessons ?? []) ? 'completed' : 'pending'; ?>" data-aos="fade-right" data-aos-delay="<?php echo 500 + ($lessonNumber * 50); ?>">
                                <div class="lesson-marker">
                                    <?php if (in_array($lesson['id'], $completedLessons ?? [])): ?>
                                        <i class="fas fa-check-circle text-success"></i>
                                    <?php else: ?>
                                        <span class="lesson-number"><?php echo $lessonNumber; ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="lesson-content">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold"><?php echo htmlspecialchars($lesson['title']); ?></h6>
                                            <p class="text-muted mb-2"><?php echo htmlspecialchars($lesson['description'] ?? 'Lesson description'); ?></p>
                                        </div>
                                        <div class="lesson-actions">
                                            <?php if (in_array($lesson['id'], $completedLessons ?? [])): ?>
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class="fas fa-check me-1"></i>Completed
                                                </span>
                                            <?php else: ?>
                                                <a href="index.php?action=viewLesson&lessonId=<?php echo $lesson['id']; ?>"
                                                   class="btn btn-primary btn-sm rounded-pill px-4">
                                                    <i class="fas fa-play me-1"></i>Start Lesson
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if (!in_array($lesson['id'], $completedLessons ?? [])): ?>
                                        <div class="lesson-meta d-flex gap-3">
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i><?php echo $lesson['duration'] ?? '30'; ?> mins
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-file-alt me-1"></i>Lesson <?php echo $lessonNumber; ?>
                                            </small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $lessonNumber++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
