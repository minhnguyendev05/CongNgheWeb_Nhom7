<?php
$title = 'Upload Material';
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
                                <i class="fas fa-upload me-3"></i>Upload Material
                            </h1>
                            <p class="lead mb-4 opacity-75">Share supplementary materials with your students</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Resource Sharing</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Student Support</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Quality Content</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-file-upload fa-6x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Form -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-cloud-upload-alt text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Upload New Material</h5>
                            <p class="text-muted mb-0">Add resources to support your lessons</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="index.php?action=uploadMaterial" enctype="multipart/form-data" class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <label for="lesson_id" class="form-label fw-bold text-dark">Lesson <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg rounded-3 border-0 shadow-sm" id="lesson_id" name="lesson_id" required>
                                    <option value="">Select Lesson</option>
                                    <?php foreach ($lessons as $lesson): ?>
                                        <option value="<?php echo $lesson['id']; ?>">
                                            <?php echo htmlspecialchars($lesson['title']); ?> (<?php echo htmlspecialchars($lesson['course_title'] ?? 'Unknown Course'); ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold text-dark">Material Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="title" name="title" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold text-dark">Description</label>
                                <textarea class="form-control rounded-3 border-0 shadow-sm" id="description" name="description" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="file" class="form-label fw-bold text-dark">File <span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-control-lg rounded-3 border-0 shadow-sm" id="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar,.txt,.jpg,.jpeg,.png,.gif" required>
                                <div class="form-text">Supported formats: PDF, DOC, PPT, XLS, ZIP, TXT, Images</div>
                            </div>

                            <div class="mb-4">
                                <label for="type" class="form-label fw-bold text-dark">Material Type</label>
                                <select class="form-select form-select-lg rounded-3 border-0 shadow-sm" id="type" name="type">
                                    <option value="document">Document</option>
                                    <option value="presentation">Presentation</option>
                                    <option value="spreadsheet">Spreadsheet</option>
                                    <option value="image">Image</option>
                                    <option value="archive">Archive</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_downloadable" name="is_downloadable" checked>
                                    <label class="form-check-label fw-bold text-dark" for="is_downloadable">
                                        Allow students to download
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="my-4">
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="index.php?action=manageMaterials" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                                    <i class="fas fa-upload me-2"></i>Upload Material
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Materials -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="400">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-history text-success fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Recent Materials</h5>
                            <p class="text-muted mb-0">Your recently uploaded materials</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($recentMaterials)): ?>
                        <div class="row g-4">
                            <?php foreach ($recentMaterials as $material): ?>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="card border-0 shadow-sm rounded-3 h-100">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-start">
                                                <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                                    <i class="fas fa-file-<?php echo getFileIcon($material['file_path']); ?> text-primary"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($material['title']); ?></h6>
                                                    <p class="text-muted small mb-2"><?php echo htmlspecialchars($material['lesson_title'] ?? 'Unknown Lesson'); ?></p>
                                                    <small class="text-muted">
                                                        <?php echo date('M d, Y', strtotime($material['created_at'])); ?> •
                                                        <?php echo formatFileSize($material['file_size'] ?? 0); ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-file-upload fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No materials uploaded yet</p>
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

<?php
function getFileIcon($filePath) {
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    switch ($extension) {
        case 'pdf': return 'pdf';
        case 'doc':
        case 'docx': return 'word';
        case 'ppt':
        case 'pptx': return 'powerpoint';
        case 'xls':
        case 'xlsx': return 'excel';
        case 'zip':
        case 'rar': return 'archive';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif': return 'image';
        default: return 'alt';
    }
}

function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}
?>
</script>

<?php require 'views/layouts/footer.php'; ?>
