<?php
$title = 'Create Course';
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
                                <i class="fas fa-plus-circle me-3"></i>Create New Course
                            </h1>
                            <p class="lead mb-4 opacity-75">Share your knowledge and create an amazing learning experience</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Expert Instructor</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Quality Content</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Student Success</span>
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

    <!-- Course Creation Form -->
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
                            <p class="text-muted mb-0">Fill in the details to create your course</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="index.php?action=createCourse" enctype="multipart/form-data" class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="title" class="form-label fw-semibold">Course Title</label>
                                <input type="text" class="form-control form-control-lg rounded-pill" id="title" name="title"
                                       placeholder="Enter an engaging course title..." required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold">Course Description</label>
                                <textarea class="form-control rounded-3" id="description" name="description" rows="6"
                                          placeholder="Describe what students will learn..." required></textarea>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="category" class="form-label fw-semibold">Category</label>
                                    <select class="form-select form-select-lg rounded-pill" id="category" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories ?? [] as $category): ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="duration" class="form-label fw-semibold">Duration (weeks)</label>
                                    <input type="number" class="form-control form-control-lg rounded-pill" id="duration" name="duration_weeks"
                                           placeholder="e.g., 4" min="1" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="price" class="form-label fw-semibold">Price ($)</label>
                                    <input type="number" class="form-control form-control-lg rounded-pill" id="price" name="price"
                                           placeholder="e.g., 99" min="0" step="0.01" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="level" class="form-label fw-semibold">Level</label>
                                    <select class="form-select form-select-lg rounded-pill" id="level" name="level">
                                        <option value="">Select Level</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
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
                                    <p class="text-muted small">Upload an attractive image for your course</p>
                                </div>

                                <div class="mb-3">
                                    <input type="file" class="form-control rounded-pill" id="image" name="image" accept="image/*">
                                    <div class="form-text">Supported formats: JPG, PNG, GIF. Max size: 5MB</div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                        <i class="fas fa-plus me-2"></i>Create Course
                                    </button>
                                    <a href="index.php?action=manageCourses" class="btn btn-outline-secondary rounded-pill">
                                        <i class="fas fa-arrow-left me-2"></i>Back to Courses
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips Section -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="400">
        <div class="col-12">
            <div class="card bg-light border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3 mb-3">
                                <i class="fas fa-lightbulb fa-2x text-primary"></i>
                            </div>
                            <h6 class="fw-bold">Engaging Title</h6>
                            <p class="text-muted small">Choose a title that clearly describes what students will learn</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="bg-success bg-opacity-10 rounded-3 d-inline-flex p-3 mb-3">
                                <i class="fas fa-users fa-2x text-success"></i>
                            </div>
                            <h6 class="fw-bold">Target Audience</h6>
                            <p class="text-muted small">Describe who your course is for and their learning goals</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="bg-info bg-opacity-10 rounded-3 d-inline-flex p-3 mb-3">
                                <i class="fas fa-star fa-2x text-info"></i>
                            </div>
                            <h6 class="fw-bold">Quality Content</h6>
                            <p class="text-muted small">Create comprehensive lessons with practical examples</p>
                        </div>
                    </div>
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
