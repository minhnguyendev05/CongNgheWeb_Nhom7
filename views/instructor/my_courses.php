<?php
$title = 'My Courses';
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
                                <i class="fas fa-book me-3"></i>My Courses
                            </h1>
                            <p class="lead mb-4 opacity-75">Overview of all your created courses</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="index.php?action=createCourse" class="btn btn-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-plus me-2"></i>Create New Course
                                </a>
                                <a href="index.php?action=dashboard" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-chalkboard-teacher fa-6x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Statistics -->
    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary bg-opacity-10 rounded-4 p-3 d-inline-block mb-3">
                        <i class="fas fa-book fa-2x text-primary"></i>
                    </div>
                    <h3 class="text-primary mb-1"><?php echo $stats['total_courses'] ?? 0; ?></h3>
                    <p class="text-muted mb-0 fw-bold">Total Courses</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-success bg-opacity-10 rounded-4 p-3 d-inline-block mb-3">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                    <h3 class="text-success mb-1"><?php echo $stats['total_students'] ?? 0; ?></h3>
                    <p class="text-muted mb-0 fw-bold">Total Students</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-warning bg-opacity-10 rounded-4 p-3 d-inline-block mb-3">
                        <i class="fas fa-clock fa-2x text-warning"></i>
                    </div>
                    <h3 class="text-warning mb-1"><?php echo $stats['pending_approval'] ?? 0; ?></h3>
                    <p class="text-muted mb-0 fw-bold">Pending Approval</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-info bg-opacity-10 rounded-4 p-3 d-inline-block mb-3">
                        <i class="fas fa-star fa-2x text-info"></i>
                    </div>
                    <h3 class="text-info mb-1"><?php echo $stats['avg_rating'] ?? 0; ?></h3>
                    <p class="text-muted mb-0 fw-bold">Avg. Rating</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Grid -->
    <div class="row" data-aos="fade-up" data-aos-delay="400">
        <?php if (!empty($courses)): ?>
            <?php $delay = 0; ?>
            <?php foreach ($courses as $course): ?>
                <div class="col-xl-4 col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                    <div class="card h-100 border-0 shadow-lg course-card rounded-4 overflow-hidden hover-lift">
                        <div class="card-img-wrapper position-relative">
                            <img src="<?php echo htmlspecialchars($course['image'] ?? 'assets/img/default-course.jpg'); ?>" class="card-img-top" alt="Course Image" style="height: 200px; object-fit: cover;">
                            <div class="card-img-overlay d-flex align-items-start justify-content-end p-3">
                                <span class="badge <?php echo $course['status'] == 'approved' ? 'bg-success' : 'bg-warning'; ?> rounded-pill px-3 py-2">
                                    <?php echo ucfirst($course['status'] ?? 'pending'); ?>
                                </span>
                            </div>
                            <div class="card-img-overlay d-flex align-items-end justify-content-center p-3 opacity-0 hover-overlay">
                                <div class="btn-group">
                                    <a href="index.php?action=editCourse&id=<?php echo $course['id']; ?>" class="btn btn-light btn-sm rounded-pill me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?action=viewCourse&id=<?php echo $course['id']; ?>" class="btn btn-light btn-sm rounded-pill me-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-light btn-sm rounded-pill" onclick="confirmDelete(<?php echo $course['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold text-dark mb-2"><?php echo htmlspecialchars($course['title']); ?></h5>
                            <p class="card-text text-muted small mb-3"><?php echo htmlspecialchars(substr($course['description'] ?? '', 0, 100)); ?>...</p>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Students</small>
                                    <span class="fw-bold text-dark"><?php echo $course['student_count'] ?? 0; ?></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Lessons</small>
                                    <span class="fw-bold text-dark"><?php echo $course['lesson_count'] ?? 0; ?></span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                        $<?php echo htmlspecialchars($course['price'] ?? 0); ?>
                                    </span>
                                </div>
                                <div class="d-flex gap-1">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?php echo $i <= ($course['rating'] ?? 0) ? 'text-warning' : 'text-muted'; ?> small"></i>
                                    <?php endfor; ?>
                                    <small class="text-muted ms-1">(<?php echo $course['review_count'] ?? 0; ?>)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $delay += 100; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5 text-center">
                        <i class="fas fa-book fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">No courses found</h5>
                        <p class="text-muted">Start by creating your first course</p>
                        <a href="index.php?action=createCourse" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i>Create First Course
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 bg-danger bg-opacity-10">
                <h5 class="modal-title text-danger fw-bold" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0">Are you sure you want to delete this course? This action cannot be undone and will remove all associated lessons and materials.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteLink" class="btn btn-danger rounded-pill px-4">Delete Course</a>
            </div>
        </div>
    </div>
</div>

<script>
AOS.init({
    duration: 800,
    once: true
});

function confirmDelete(courseId) {
    const deleteLink = document.getElementById('deleteLink');
    deleteLink.href = `index.php?action=deleteCourse&id=${courseId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>

<?php require 'views/layouts/footer.php'; ?>
