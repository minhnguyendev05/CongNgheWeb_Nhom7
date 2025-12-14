<?php
$title = isset($isAllStudents) && $isAllStudents ? 'All Students' : 'Enrolled Students';
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
                                <i class="fas fa-users me-3"></i><?php echo isset($isAllStudents) && $isAllStudents ? 'All Students' : 'Enrolled Students'; ?>
                            </h1>
                            <p class="lead mb-4 opacity-75"><?php echo isset($isAllStudents) && $isAllStudents ? 'Monitor all your students across all courses' : 'Monitor your students\' progress and engagement'; ?></p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Student Management</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Progress Tracking</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Engagement Analytics</span>
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

    <!-- Course Selection and Stats -->
    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <?php if (!isset($isAllStudents) || !$isAllStudents): ?>
                        <div class="col-md-6">
                            <label for="courseSelect" class="form-label fw-bold text-dark">Select Course</label>
                            <select class="form-select form-select-lg rounded-3 border-0 shadow-sm" id="courseSelect">
                                <option value="">All Courses</option>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?php echo $course['id']; ?>" <?php echo ($selectedCourse ?? '') == $course['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($course['title']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <div class="<?php echo (!isset($isAllStudents) || !$isAllStudents) ? 'col-md-6' : 'col-12'; ?>">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="p-3 bg-primary bg-opacity-10 rounded-4">
                                        <h3 class="text-primary mb-1"><?php echo $stats['total_students'] ?? 0; ?></h3>
                                        <small class="text-muted fw-bold">Total Students</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-success bg-opacity-10 rounded-4">
                                        <h3 class="text-success mb-1"><?php echo $stats['active_students'] ?? 0; ?></h3>
                                        <small class="text-muted fw-bold">Active</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-warning bg-opacity-10 rounded-4">
                                        <h3 class="text-warning mb-1"><?php echo $stats['completion_rate'] ?? 0; ?>%</h3>
                                        <small class="text-muted fw-bold">Avg. Completion</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students List -->
    <div class="row" data-aos="fade-up" data-aos-delay="400">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-users text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Student List</h5>
                                <p class="text-muted mb-0">Detailed view of enrolled students</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control rounded-pill border-0 shadow-sm" id="searchInput" placeholder="Search students...">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($enrollments)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="studentsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-bold text-dark ps-4 py-4">Student</th>
                                        <?php if (isset($isAllStudents) && $isAllStudents): ?>
                                        <th class="border-0 fw-bold text-dark py-4">Course</th>
                                        <?php endif; ?>
                                        <th class="border-0 fw-bold text-dark py-4">Progress</th>
                                        <th class="border-0 fw-bold text-dark py-4">Enrollment Date</th>
                                        <th class="border-0 fw-bold text-dark py-4">Last Activity</th>
                                        <th class="border-0 fw-bold text-dark py-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($enrollments as $enrollment): ?>
                                        <tr class="student-row" data-course-id="<?php echo $enrollment['course_id']; ?>">
                                            <td class="ps-4 py-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= BASE_URL.'/' ?><?php echo htmlspecialchars($enrollment['avatar'] ?? 'assets/img/default-avatar.png'); ?>"
                                                         alt="Avatar" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($enrollment['student_name']); ?></h6>
                                                        <p class="text-muted mb-0 small"><?php echo htmlspecialchars($enrollment['student_email']); ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php if (isset($isAllStudents) && $isAllStudents): ?>
                                            <td class="py-4">
                                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                                                    <?php echo htmlspecialchars($enrollment['course_title']); ?>
                                                </span>
                                            </td>
                                            <?php endif; ?>
                                            <td class="py-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 me-3" style="height: 8px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                             style="width: <?php echo isset($enrollment['progress']) ? $enrollment['progress'] : 0; ?>%"
                                                             aria-valuenow="<?php echo isset($enrollment['progress']) ? $enrollment['progress'] : 0; ?>"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="text-muted fw-bold"><?php echo isset($enrollment['progress']) ? $enrollment['progress'] : 0; ?>%</small>
                                                </div>
                                            </td>
                                            <td class="py-4">
                                                <span class="text-muted">
                                                    <?php echo isset($enrollment['enrollment_date']) && $enrollment['enrollment_date'] ? date('M d, Y', strtotime($enrollment['enrollment_date'])) : 'N/A'; ?>
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <span class="text-muted">
                                                    <?php echo isset($enrollment['last_activity']) && $enrollment['last_activity'] ? date('M d, Y', strtotime($enrollment['last_activity'])) : 'Never'; ?>
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo BASE_PATH; ?>/instructor/course/<?php echo $enrollment['course_id']; ?>/student/<?php echo $enrollment['student_id']; ?>/progress"
                                                       class="btn btn-outline-primary btn-sm rounded-pill me-1" title="View Progress">
                                                        <i class="fas fa-chart-line"></i>
                                                    </a>
                                                    <?php if (isset($enrollment['student_email']) && $enrollment['student_email']): ?>
                                                    <a href="mailto:<?php echo htmlspecialchars($enrollment['student_email']); ?>"
                                                       class="btn btn-outline-info btn-sm rounded-pill me-1" title="Contact">
                                                        <i class="fas fa-envelope"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No enrolled students found</h5>
                            <p class="text-muted">Students will appear here once they enroll in your courses</p>
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

// Course filter functionality
const courseSelect = document.getElementById('courseSelect');
if (courseSelect) {
    courseSelect.addEventListener('change', function() {
        const selectedCourseId = this.value;
        const rows = document.querySelectorAll('.student-row');

        rows.forEach(row => {
            if (selectedCourseId === '' || row.dataset.courseId === selectedCourseId) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('.student-row');

    rows.forEach(row => {
        const studentName = row.querySelector('h6').textContent.toLowerCase();
        const studentEmail = row.querySelector('p').textContent.toLowerCase();
        const courseTitle = row.querySelector('.badge').textContent.toLowerCase();

        if (studentName.includes(searchTerm) || studentEmail.includes(searchTerm) || courseTitle.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

<?php require 'views/layouts/footer.php'; ?>




