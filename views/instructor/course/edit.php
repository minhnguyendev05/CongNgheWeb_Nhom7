<?php
$title = 'Edit Course';
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
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo BASE_PATH; ?>/instructor/course/<?php echo htmlspecialchars($course['id'] ?? ''); ?>/edit" enctype="multipart/form-data" class="row g-4">
                        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['id'] ?? ''); ?>">

                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="title" class="form-label fw-semibold">Course Title</label>
                                <input type="text" class="form-control rounded-2" id="title" name="title" value="<?php echo htmlspecialchars($course['title'] ?? ''); ?>" minlength="3" maxlength="255" required>
                                <small class="form-text text-muted">3-255 characters</small>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold">Course Description</label>
                                <textarea class="form-control rounded-2" id="description" name="description" rows="6" minlength="10" required><?php echo htmlspecialchars($course['description'] ?? ''); ?></textarea>
                                <small class="form-text text-muted">Minimum 10 characters</small>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label fw-semibold">Category</label>
                                    <select class="form-select rounded-2" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['id']; ?>" <?php echo ($course['category_id'] ?? '') == $category['id'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($category['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="duration_weeks" class="form-label fw-semibold">Duration (weeks)</label>
                                    <input type="number" class="form-control rounded-2" id="duration_weeks" name="duration_weeks" value="<?php echo htmlspecialchars($course['duration_weeks'] ?? ''); ?>" min="1" max="999">
                                    <small class="form-text text-muted">Positive number</small>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="price" class="form-label fw-semibold">Price ($)</label>
                                    <input type="number" class="form-control rounded-2" id="price" name="price" value="<?php echo htmlspecialchars($course['price'] ?? ''); ?>" min="0" step="0.01" required>
                                    <small class="form-text text-muted">Non-negative number</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="level" class="form-label fw-semibold">Difficulty Level</label>
                                    <select class="form-select rounded-2" id="level" name="level" required>
                                        <option value="">Select Level</option>
                                        <option value="beginner" <?php echo ($course['level'] ?? '') == 'beginner' ? 'selected' : ''; ?>>Beginner</option>
                                        <option value="intermediate" <?php echo ($course['level'] ?? '') == 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                        <option value="advanced" <?php echo ($course['level'] ?? '') == 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light border-0 rounded-4 p-4">
                                <div class="text-center mb-4">
                                    <div class="bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3 mb-3">
                                        <i class="fas fa-image fa-2x text-primary"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark">Course Image</h6>
                                    <p class="text-muted small">Upload new image or keep current</p>
                                </div>

                                <?php if (!empty($course['image'])): ?>
                                    <div id="currentImage" class="mb-3 text-center">
                                        <img src="<?php echo BASE_URL.'/'.htmlspecialchars($course['image']); ?>" alt="Current Image" class="img-fluid rounded-2" style="max-height: 180px; object-fit: cover;">
                                        <p class="text-muted small mt-2">Current image</p>
                                    </div>
                                <?php endif; ?>

                                <div id="imagePreview" class="mb-3 text-center" style="display: none;">
                                    <img id="previewImg" src="" alt="Preview" class="img-fluid rounded-2" style="max-height: 180px; object-fit: cover;">
                                    <p class="text-muted small mt-2" id="fileName"></p>
                                </div>

                                <div class="mb-3">
                                    <input type="file" class="form-control rounded-2" id="image" name="image" accept="image/*">
                                    <div class="form-text">Formats: JPG, PNG, GIF. Max: 5MB</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="my-4">
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="<?php echo BASE_PATH; ?>/instructor/courses" class="btn btn-outline-secondary rounded-2 px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Courses
                                </a>
                                <button type="submit" class="btn btn-primary rounded-2 px-4">
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
// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('previewImg').src = event.target.result;
            document.getElementById('fileName').textContent = file.name;
            document.getElementById('imagePreview').style.display = 'block';
            // Hide current image when new one is selected
            const currentImage = document.getElementById('currentImage');
            if (currentImage) {
                currentImage.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php require 'views/layouts/footer.php'; ?>




