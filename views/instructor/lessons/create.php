<?php
$title = 'Create Lesson';
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
                                <i class="fas fa-plus-circle me-3"></i>Create New Lesson
                            </h1>
                            <p class="lead mb-4 opacity-75">Add engaging content to your course</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Interactive Learning</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Quality Content</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Student Engagement</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-book-open fa-6x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lesson Creation Form -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-edit text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Lesson Information</h5>
                            <p class="text-muted mb-0">Fill in the details to create your lesson</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="index.php?action=createLesson" enctype="multipart/form-data" class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="course_id" class="form-label fw-bold text-dark">Course <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg rounded-3 border-0 shadow-sm" id="course_id" name="course_id" required>
                                    <option value="">Select Course</option>
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?php echo $course['id']; ?>">
                                            <?php echo htmlspecialchars($course['title']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold text-dark">Lesson Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="title" name="title" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold text-dark">Lesson Description</label>
                                <textarea class="form-control rounded-3 border-0 shadow-sm" id="description" name="description" rows="4"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="content" class="form-label fw-bold text-dark">Lesson Content <span class="text-danger">*</span></label>
                                <textarea class="form-control rounded-3 border-0 shadow-sm" id="content" name="content" rows="8" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="video_url" class="form-label fw-bold text-dark">Video URL</label>
                                <input type="url" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="video_url" name="video_url" placeholder="https://youtube.com/...">
                                <div class="form-text">Optional: Add a video link for this lesson</div>
                            </div>

                            <div class="mb-4">
                                <label for="order" class="form-label fw-bold text-dark">Order Number <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="order" name="order" min="1" required>
                                <div class="form-text">The order this lesson appears in the course</div>
                            </div>

                            <div class="mb-4">
                                <label for="duration" class="form-label fw-bold text-dark">Duration (minutes)</label>
                                <input type="number" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="duration" name="duration" min="0">
                            </div>

                            <div class="mb-4">
                                <label for="materials" class="form-label fw-bold text-dark">Additional Materials</label>
                                <input type="file" class="form-control rounded-3 border-0 shadow-sm" id="materials" name="materials[]" multiple accept=".pdf,.doc,.docx,.ppt,.pptx,.zip">
                                <div class="form-text">Upload supplementary materials (PDF, DOC, PPT, ZIP)</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="my-4">
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="index.php?action=manageLessons" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                                    <i class="fas fa-save me-2"></i>Create Lesson
                                </button>
                            </div>
                        </div>
                    </form>
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
