<?php
$title = 'Approve Courses';
require 'views/layouts/header.php';
?>

<div class="container-fluid mt-4">
    <!-- Header Section -->
    <div class="row mb-5" data-aos="fade-down">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white border-0 rounded-4 shadow-lg">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold mb-3">
                                <i class="fas fa-check-circle me-3"></i>Approve Courses
                            </h1>
                            <p class="lead mb-4 opacity-85">Review and approve pending course submissions</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill"><?php echo count($courses ?? []); ?> Pending Courses</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Course Approval</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Quality Control</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-check-circle fa-6x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-clock text-warning fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Pending Courses</h5>
                                <p class="text-muted mb-0">Courses awaiting approval</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 ps-4 py-3">Title</th>
                                    <th class="border-0 py-3">Instructor</th>
                                    <th class="border-0 pe-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $course): ?>
                                <tr>
                                    <td class="ps-4 py-3 fw-semibold"><?php echo htmlspecialchars($course['title']); ?></td>
                                    <td class="py-3 text-muted"><?php echo htmlspecialchars($course['instructor_name'] ?? 'Unknown'); ?></td>
                                    <td class="pe-4 py-3">
                                        <div class="d-flex gap-2">
                                            <a href="index.php?action=approveCourse&id=<?php echo $course['id']; ?>" class="btn btn-outline-success btn-sm rounded-pill">
                                                <i class="fas fa-check me-1"></i>Approve
                                            </a>
                                            <a href="index.php?action=rejectCourse&id=<?php echo $course['id']; ?>" class="btn btn-outline-danger btn-sm rounded-pill">
                                                <i class="fas fa-times me-1"></i>Reject
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
