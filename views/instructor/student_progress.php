<?php
$title = 'Student Progress';
require 'views/layouts/header.php';
?>

<div class="container-fluid content-padding">
    <!-- Header Section -->
    <div class="row mb-5" data-aos="fade-down">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white border-0 rounded-4 shadow-lg">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold mb-3">
                                <i class="fas fa-chart-line me-3"></i>Student Progress
                            </h1>
                            <p class="lead mb-4 opacity-75">Detailed view of individual student performance</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Progress Tracking</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Performance Analytics</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Student Insights</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-user-graduate fa-6x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Info and Overview -->
    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="col-lg-4">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <img src="<?= BASE_URL.'/' ?><?php echo isset($student) && isset($student['avatar']) ? htmlspecialchars($student['avatar']) : 'assets/img/default-avatar.png'; ?>"
                         alt="Student Avatar" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                    <h5 class="fw-bold text-dark mb-1"><?php echo isset($student) && isset($student['name']) ? htmlspecialchars($student['name']) : 'N/A'; ?></h5>
                    <p class="text-muted mb-3"><?php echo isset($student) && isset($student['email']) ? htmlspecialchars($student['email']) : 'N/A'; ?></p>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">Enrolled: <?php echo isset($enrollment) && isset($enrollment['enrollment_date']) ? date('M d, Y', strtotime($enrollment['enrollment_date'])) : 'Unknown'; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">Course Progress Overview</h6>
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div class="p-3 bg-primary bg-opacity-10 rounded-4">
                                <h4 class="text-primary mb-1"><?php echo isset($progress) && isset($progress['completed_lessons']) ? $progress['completed_lessons'] : 0; ?></h4>
                                <small class="text-muted fw-bold">Completed Lessons</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="p-3 bg-success bg-opacity-10 rounded-4">
                                <h4 class="text-success mb-1"><?php echo isset($progress) && isset($progress['total_lessons']) ? $progress['total_lessons'] : 0; ?></h4>
                                <small class="text-muted fw-bold">Total Lessons</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="p-3 bg-info bg-opacity-10 rounded-4">
                                <h4 class="text-info mb-1"><?php echo isset($progress) && isset($progress['progress_percentage']) ? $progress['progress_percentage'] : 0; ?>%</h4>
                                <small class="text-muted fw-bold">Progress</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="p-3 bg-warning bg-opacity-10 rounded-4">
                                <h4 class="text-warning mb-1"><?php echo isset($progress) && isset($progress['time_spent']) ? $progress['time_spent'] : 0; ?>h</h4>
                                <small class="text-muted fw-bold">Time Spent</small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-muted fw-bold">Overall Progress</small>
                            <small class="text-muted fw-bold"><?php echo isset($progress) && isset($progress['progress_percentage']) ? $progress['progress_percentage'] : 0; ?>%</small>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: <?php echo isset($progress) && isset($progress['progress_percentage']) ? $progress['progress_percentage'] : 0; ?>%"
                                 aria-valuenow="<?php echo isset($progress) && isset($progress['progress_percentage']) ? $progress['progress_percentage'] : 0; ?>"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lesson Progress -->
    <div class="row" data-aos="fade-up" data-aos-delay="400">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-list-check text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Lesson Progress</h5>
                            <p class="text-muted mb-0">Detailed progress for each lesson</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($lessonProgress) && !empty($lessonProgress)): ?>
                        <div class="row g-4">
                            <?php foreach ($lessonProgress as $lesson): ?>
                                <div class="col-lg-12">
                                    <div class="card border-0 shadow-sm rounded-4">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-start justify-content-between mb-3">
                                                <div class="flex-grow-1">
                                                    <h6 class="fw-bold text-dark mb-1"><?php echo isset($lesson['title']) ? htmlspecialchars($lesson['title']) : 'Unknown'; ?></h6>
                                                    <p class="text-muted small mb-2"><?php echo isset($lesson['description']) ? htmlspecialchars($lesson['description']) : ''; ?></p>
                                                </div>
                                                <div class="text-end">
                                                    <?php if (isset($lesson['completed']) && $lesson['completed']): ?>
                                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                                            <i class="fas fa-check me-1"></i>Completed
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning rounded-pill px-3 py-2">
                                                            <i class="fas fa-clock me-1"></i>In Progress
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <small class="text-muted fw-bold">Progress</small>
                                                    <small class="text-muted fw-bold"><?php echo isset($lesson['progress_percentage']) ? $lesson['progress_percentage'] : 0; ?>%</small>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar <?php echo isset($lesson['completed']) && $lesson['completed'] ? 'bg-success' : 'bg-primary'; ?>"
                                                         role="progressbar"
                                                         style="width: <?php echo isset($lesson['progress_percentage']) ? $lesson['progress_percentage'] : 0; ?>%"
                                                         aria-valuenow="<?php echo isset($lesson['progress_percentage']) ? $lesson['progress_percentage'] : 0; ?>"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Last Accessed</small>
                                                    <small class="fw-bold text-dark">
                                                        <?php echo isset($lesson['last_accessed']) && $lesson['last_accessed'] ? date('M d, Y', strtotime($lesson['last_accessed'])) : 'Never'; ?>
                                                    </small>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Time Spent</small>
                                                    <small class="fw-bold text-dark"><?php echo isset($lesson['time_spent']) ? $lesson['time_spent'] : 0; ?> min</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No lesson progress data available</h5>
                            <p class="text-muted">The student hasn't started any lessons yet</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="row mt-4" data-aos="fade-up" data-aos-delay="600">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-history text-info fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Recent Activity</h5>
                            <p class="text-muted mb-0">Student's learning activity timeline</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($activities) && !empty($activities)): ?>
                        <div class="timeline">
                            <?php foreach ($activities as $activity): ?>
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold text-dark mb-1"><?php echo isset($activity['title']) ? htmlspecialchars($activity['title']) : 'Unknown'; ?></h6>
                                        <p class="text-muted small mb-1"><?php echo isset($activity['description']) ? htmlspecialchars($activity['description']) : ''; ?></p>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i><?php echo isset($activity['timestamp']) ? date('M d, Y H:i', strtotime($activity['timestamp'])) : 'Unknown'; ?>
                                        </small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-history fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No recent activity found</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
AOS.init({
    duration: 800,
    once: true
});
</script>

<?php require 'views/layouts/footer.php'; ?>




