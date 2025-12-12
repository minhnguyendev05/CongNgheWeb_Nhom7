<?php
$title = 'Manage Lessons';
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
                                <i class="fas fa-book me-3"></i>Manage Your Lessons
                            </h1>
                            <p class="lead mb-4 opacity-75">Organize, update, and manage your course lessons</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="index.php?action=createLesson" class="btn btn-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-plus me-2"></i>Create Lesson
                                </a>
                                <a href="index.php?action=manageCourses" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-book me-2"></i>Manage Courses
                                </a>
                                <a href="index.php?action=dashboard" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-chalkboard fa-6x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lessons Management -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-list text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">All Lessons</h5>
                                <p class="text-muted mb-0">Manage your course content</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <select class="form-select rounded-pill border-0 shadow-sm" id="courseFilter">
                                <option value="">All Courses</option>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?php echo $course['id']; ?>"><?php echo htmlspecialchars($course['title']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($lessons)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-bold text-dark ps-4 py-4">Lesson</th>
                                        <th class="border-0 fw-bold text-dark py-4">Course</th>
                                        <th class="border-0 fw-bold text-dark py-4">Order</th>
                                        <th class="border-0 fw-bold text-dark py-4">Duration</th>
                                        <th class="border-0 fw-bold text-dark py-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lessons as $lesson): ?>
                                        <tr class="lesson-row" data-course-id="<?php echo $lesson['course_id']; ?>">
                                            <td class="ps-4 py-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                                        <i class="fas fa-book-open text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($lesson['title']); ?></h6>
                                                        <p class="text-muted mb-0 small"><?php echo htmlspecialchars(substr($lesson['description'] ?? '', 0, 50)); ?>...</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4">
                                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                                                    <?php echo htmlspecialchars($lesson['course_title'] ?? 'Unknown Course'); ?>
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                                    #<?php echo htmlspecialchars($lesson['order_number']); ?>
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <span class="text-muted">
                                                    <?php echo $lesson['duration'] ? htmlspecialchars($lesson['duration']) . ' min' : 'N/A'; ?>
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <div class="btn-group" role="group">
                                                    <a href="index.php?action=editLesson&lessonId=<?php echo $lesson['id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill me-1" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill" title="Delete" onclick="confirmDelete(<?php echo $lesson['id']; ?>, <?php echo $lesson['course_id']; ?>)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No lessons found</h5>
                            <p class="text-muted">Start by creating your first lesson</p>
                            <a href="index.php?action=createLesson" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-plus me-2"></i>Create First Lesson
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
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
                <p class="mb-0">Are you sure you want to delete this lesson? This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteLink" class="btn btn-danger rounded-pill px-4">Delete Lesson</a>
            </div>
        </div>
    </div>
</div>



<script>
AOS.init({
    duration: 800,
    once: true
});

function confirmDelete(lessonId, courseId) {
    const deleteLink = document.getElementById('deleteLink');
    deleteLink.href = `index.php?action=deleteLesson&lessonId=${lessonId}&courseId=${courseId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Course filter functionality
document.getElementById('courseFilter').addEventListener('change', function() {
    const selectedCourseId = this.value;
    const rows = document.querySelectorAll('.lesson-row');

    rows.forEach(row => {
        if (selectedCourseId === '' || row.dataset.courseId === selectedCourseId) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

<?php require 'views/layouts/footer.php'; ?>
