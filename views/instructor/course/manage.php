<?php
$title = 'Manage Courses';
require 'views/layouts/header.php';
?>

<div class="container-fluid dashboard-container">
    <!-- Header Section -->
    <div class="row mb-5" data-aos="fade-down">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white border-0 rounded-4 shadow-lg">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold mb-3">
                                <i class="fas fa-book me-3"></i>Manage Your Courses
                            </h1>
                            <p class="lead mb-4 opacity-75">Organize, update, and track your course performance</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="index.php?action=createCourse" class="btn btn-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-plus me-2"></i>Create Course
                                </a>
                                <a href="index.php?action=dashboard" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-cogs fa-6x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Grid -->
    <div class="row g-4">
        <?php if (!empty($courses)): ?>
            <?php $delay = 0; ?>
            <?php foreach ($courses as $course): ?>
                <div class="col-xl-4 col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                    <div class="card h-100 border-0 shadow-lg course-card rounded-4 overflow-hidden hover-lift">
                        <div class="card-img-wrapper position-relative">
                            <img src="<?php echo htmlspecialchars($course['image'] ?? 'assets/img/default-course.png'); ?>" class="card-img-top" alt="Course Image" style="height: 200px; object-fit: cover;">
                            <div class="card-img-overlay d-flex align-items-start justify-content-end p-3">
                                <span class="badge <?php echo $course['status'] == 'approved' ? 'bg-success' : 'bg-warning'; ?> rounded-pill px-3 py-2">
                                    <?php echo ucfirst($course['status'] ?? 'pending'); ?>
                                </span>
                            </div>
                            <div class="card-img-overlay d-flex align-items-end justify-content-center p-3 opacity-0 hover-overlay">
                                <div class="d-flex gap-2">
                                    <a href="index.php?action=manageLessons&courseId=<?php echo $course['id']; ?>" class="btn btn-light btn-sm rounded-pill">
                                        <i class="fas fa-list me-1"></i>Lessons
                                    </a>
                                    <a href="index.php?action=editCourse&courseId=<?php echo $course['id']; ?>" class="btn btn-primary btn-sm rounded-pill">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title fw-bold mb-3 text-dark"><?php echo htmlspecialchars($course['title']); ?></h5>
                            <p class="card-text text-muted flex-grow-1 mb-3"><?php echo htmlspecialchars(substr($course['description'], 0, 120)); ?>...</p>

                            <!-- Course Stats -->
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="text-center p-2 bg-light rounded-3">
                                        <div class="fw-bold text-primary"><?php echo $course['enrollment_count'] ?? 0; ?></div>
                                        <small class="text-muted">Students</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center p-2 bg-light rounded-3">
                                        <div class="fw-bold text-success"><?php echo $course['lesson_count'] ?? 0; ?></div>
                                        <small class="text-muted">Lessons</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-auto">
                                <a href="index.php?action=manageLessons&courseId=<?php echo $course['id']; ?>" class="btn btn-primary rounded-pill flex-fill">
                                    <i class="fas fa-list me-1"></i>Lessons
                                </a>
                                <a href="index.php?action=viewEnrolledStudents&courseId=<?php echo $course['id']; ?>" class="btn btn-outline-success rounded-pill">
                                    <i class="fas fa-users me-1"></i>Students
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $delay += 100; if ($delay > 400) $delay = 0; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12" data-aos="fade-up">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-book-open fa-6x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted fw-bold mb-3">No courses yet</h4>
                    <p class="text-muted fs-5 mb-4">Start creating your first course to share knowledge with students.</p>
                    <a href="index.php?action=createCourse" class="btn btn-primary btn-lg rounded-pill px-4 py-3">
                        <i class="fas fa-plus me-2"></i>Create Your First Course
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
AOS.init({
    duration: 800,
    once: true
});
</script>

<?php require 'views/layouts/footer.php'; ?>
