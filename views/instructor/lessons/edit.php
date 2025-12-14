<?php
$title = 'Edit Lesson';
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
                                <i class="fas fa-edit me-3"></i>Edit Lesson
                            </h1>
                            <p class="lead mb-4 opacity-75">Update your lesson content and information</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Content Management</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Quality Update</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Student Learning</span>
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

    <!-- Lesson Edit Form -->
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
                            <p class="text-muted mb-0">Update the details of your lesson</p>
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
                    <form method="POST" action="<?php echo BASE_PATH; ?>/instructor/lesson/<?php echo htmlspecialchars($lesson['id'] ?? ''); ?>/edit" enctype="multipart/form-data" class="row g-4">
                        <input type="hidden" name="lesson_id" value="<?php echo htmlspecialchars($lesson['id'] ?? ''); ?>">

                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="title" class="form-label fw-semibold">Lesson Title</label>
                                <input type="text" class="form-control rounded-2" id="title" name="title" value="<?php echo htmlspecialchars($lesson['title'] ?? ''); ?>" minlength="3" maxlength="255" required>
                                <small class="form-text text-muted">3-255 characters</small>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold">Lesson Description</label>
                                <textarea class="form-control rounded-2" id="description" name="description" rows="4"><?php echo htmlspecialchars($lesson['description'] ?? ''); ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="content" class="form-label fw-semibold">Lesson Content</label>
                                <textarea class="form-control rounded-2" id="content" name="content" rows="8" minlength="10" required><?php echo htmlspecialchars($lesson['content'] ?? ''); ?></textarea>
                                <small class="form-text text-muted">Minimum 10 characters</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="video_url" class="form-label fw-semibold">Video URL</label>
                                <input type="url" class="form-control rounded-2" id="video_url" name="video_url" value="<?php echo htmlspecialchars($lesson['video_url'] ?? ''); ?>" placeholder="https://youtube.com/...">
                                <div class="form-text">Optional: Add a video link for this lesson</div>
                            </div>

                            <div class="mb-4">
                                <label for="order" class="form-label fw-semibold">Order Number</label>
                                <input type="number" class="form-control rounded-2" id="order" name="order" value="<?php echo htmlspecialchars($lesson['order_number'] ?? ''); ?>" min="1" max="999" required>
                                <div class="form-text">The order this lesson appears in the course</div>
                            </div>

                            <div class="mb-4">
                                <label for="duration" class="form-label fw-semibold">Duration (minutes)</label>
                                <input type="number" class="form-control rounded-2" id="duration" name="duration" value="<?php echo htmlspecialchars($lesson['duration'] ?? ''); ?>" min="1" max="10000">
                                <small class="form-text text-muted">Positive number</small>
                            </div>

                            <div class="mb-4">
                                <label for="materials" class="form-label fw-semibold">Additional Materials</label>
                                <input type="file" class="form-control rounded-2" id="materials" name="materials[]" multiple accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar,.txt,.jpg,.jpeg,.png,.gif">
                                <div class="form-text">Upload supplementary materials (PDF, DOC, PPT, XLS, ZIP, TXT, Images)</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="my-4">
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="<?php echo BASE_PATH; ?>/instructor/course/<?php echo htmlspecialchars($lesson['course_id'] ?? ''); ?>/lessons" class="btn btn-outline-secondary rounded-2 px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Lessons
                                </a>
                                <button type="submit" class="btn btn-primary rounded-2 px-4">
                                    <i class="fas fa-save me-2"></i>Update Lesson
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require 'views/layouts/footer.php'; ?>




