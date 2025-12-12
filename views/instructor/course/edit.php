<?php
$title = 'Edit Course';
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
                                <i class="fas fa-edit me-3"></i>Edit Course
                            </h1>
                            <p class="lead mb-4 opacity-75">Update your course information and content</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Course Management</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Content Update</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Quality Enhancement</span>
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

    <!-- Course Edit Form -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-edit text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Course Information</h5>
                            <p class="text-muted mb-0">Update the details of your course</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="index.php?action=editCourse&courseId=<?php echo htmlspecialchars($course['id'] ?? ''); ?>" enctype="multipart/form-data" class="row g-4">
                        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['id'] ?? ''); ?>">

                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold text-dark">Course Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="title" name="title" value="<?php echo htmlspecialchars($course['title'] ?? ''); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold text-dark">Course Description <span class="text-danger">*</span></label>
                                <textarea class="form-control rounded-3 border-0 shadow-sm" id="description" name="description" rows="6" required><?php echo htmlspecialchars($course['description'] ?? ''); ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="category_id" class="form-label fw-bold text-dark">Category <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg rounded-3 border-0 shadow-sm" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['id']; ?>" <?php echo ($course['category_id'] ?? '') == $category['id'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($category['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="price" class="form-label fw-bold text-dark">Price (USD) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="price" name="price" value="<?php echo htmlspecialchars($course['price'] ?? ''); ?>" min="0" step="0.01" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="image" class="form-label fw-bold text-dark">Course Image</label>
                                <input type="file" class="form-control rounded-3 border-0 shadow-sm" id="image" name="image" accept="image/*">
                                <div class="form-text">Leave empty to keep current image</div>
                                <?php if (!empty($course['image'])): ?>
                                    <div class="mt-2">
                                        <img src="<?php echo htmlspecialchars($course['image']); ?>" alt="Current Image" class="img-fluid rounded-3 shadow-sm" style="max-height: 150px;">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-4">
                                <label for="duration_weeks" class="form-label fw-bold text-dark">Duration (weeks)</label>
                                <input type="number" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="duration_weeks" name="duration_weeks" value="<?php echo htmlspecialchars($course['duration_weeks'] ?? ''); ?>" min="1">
                            </div>

                            <div class="mb-4">
                                <label for="level" class="form-label fw-bold text-dark">Difficulty Level</label>
                                <select class="form-select form-select-lg rounded-3 border-0 shadow-sm" id="level" name="level">
                                    <option value="beginner" <?php echo ($course['level'] ?? '') == 'beginner' ? 'selected' : ''; ?>>Beginner</option>
                                    <option value="intermediate" <?php echo ($course['level'] ?? '') == 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                    <option value="advanced" <?php echo ($course['level'] ?? '') == 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="my-4">
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="index.php?action=manageCourses" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                                    <i class="fas fa-save me-2"></i>Update Course
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
