<?php
// lesson_detail.php - Lesson detail page with soft, eye-friendly colors
$title = 'Lesson Details';
require 'views/layouts/header.php';
?>

<div class="page-container p-0">
    <div class="container-fluid content-padding">
        <!-- Lesson Header -->
        <div class="row mb-5" data-aos="fade-down">
            <div class="col-12">
                <div class="welcome-header">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <?php if ($lesson): ?>
                                <h1 class="display-5 fw-bold">
                                    <i class="fas fa-play-circle me-3"></i><?php echo htmlspecialchars($lesson['title']); ?>
                                </h1>
                                <p class="lead mb-4">Part of: <?php echo htmlspecialchars($course['title']); ?></p>
                                <div class="lesson-info-badges">
                                    <span class="info-badge">
                                        <i class="fas fa-clock me-1"></i><?php echo $lesson['duration']; ?> minutes
                                    </span>
                                    <span class="info-badge">
                                        <i class="fas fa-book-open me-1"></i>Lesson <?php echo $lessonNumber; ?>
                                    </span>
                                    <span class="info-badge">
                                        <i class="fas fa-user-graduate me-1"></i><?php echo htmlspecialchars($course['instructor_name']); ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <h1 class="display-5 fw-bold">
                                    <i class="fas fa-exclamation-triangle me-3"></i>Lesson Not Found
                                </h1>
                                <p class="lead mb-4">The lesson you're looking for doesn't exist or has been removed.</p>
                                <div class="lesson-info-badges">
                                    <span class="info-badge">
                                        <i class="fas fa-info-circle me-1"></i>Lesson Unavailable
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="welcome-icon">
                                <?php if ($lesson): ?>
                                    <i class="fas fa-graduation-cap"></i>
                                <?php else: ?>
                                    <i class="fas fa-question-circle"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Lesson Content -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-lg-8 mb-4">
            <div class="content-card">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-play text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Lesson Content</h5>
                            <p class="text-muted mb-0">Watch and learn from this lesson</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if ($lesson): ?>
                    <!-- Video Player Placeholder -->
                    <div class="video-player mb-4">
                        <?php if (!empty($lesson['video_url'])): ?>
                            <!-- Embedded Video Player -->
                            <div class="ratio ratio-16x9 bg-dark rounded-4 overflow-hidden">
                                <?php
                                $videoUrl = $lesson['video_url'];
                                $youtubeMatch = [];
                                
                                // Check if it's a YouTube URL and extract video ID
                                if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $youtubeMatch)) {
                                    $youtubeId = $youtubeMatch[1];
                                    echo '<iframe class="rounded-4" width="100%" height="100%" src="https://www.youtube.com/embed/' . htmlspecialchars($youtubeId) . '" title="Lesson Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                } 
                                // Check if it's a direct video file
                                elseif (preg_match('/\.(mp4|webm|ogg)$/i', $videoUrl)) {
                                    echo '<video class="rounded-4" width="100%" height="100%" controls style="background: #000;">
                                            <source src="' . htmlspecialchars($videoUrl) . '" type="video/mp4">
                                            Your browser does not support the video tag.
                                          </video>';
                                }
                                // Otherwise show placeholder
                                else {
                                    echo '<div class="d-flex align-items-center justify-content-center h-100" style="background: linear-gradient(135deg, rgba(168, 192, 255, 0.1) 0%, rgba(200, 150, 255, 0.1) 100%);">
                                            <div class="text-center text-white">
                                                <i class="fas fa-video fa-4x mb-3 opacity-75"></i>
                                                <h5>Invalid Video URL</h5>
                                                <p class="mb-0 opacity-75">The video URL could not be processed</p>
                                            </div>
                                          </div>';
                                }
                                ?>
                            </div>
                        <?php else: ?>
                            <!-- Video Placeholder -->
                            <div class="ratio ratio-16x9 bg-dark rounded-4 d-flex align-items-center justify-content-center">
                                <div class="text-center text-white">
                                    <i class="fas fa-play-circle fa-4x mb-3 opacity-75"></i>
                                    <h5>Video Player</h5>
                                    <p class="mb-0 opacity-75">No video available for this lesson</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Lesson Description -->
                    <div class="lesson-description rounded-3" style="background: rgba(168, 192, 255, 0.02);">
                        <h6 class="fw-bold mb-3">Lesson Overview</h6>
                        <p class="text-muted mb-4"><?php echo htmlspecialchars($lesson['description'] ?? 'This lesson covers important concepts that will help you understand the topic better. Follow along with the video and complete the exercises.'); ?></p>

                        <!-- Learning Objectives -->
                        <div class="mb-0">
                            <h6 class="fw-bold mb-3">Learning Objectives</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Understand the core concepts presented in this lesson
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Apply the learned concepts to practical examples
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Complete the associated exercises and quizzes
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Materials Section -->
                    <?php if (!empty($materials)): ?>
                        <div class="materials-section rounded-3" style="background: rgba(168, 192, 255, 0.02);">
                            <h6 class="fw-bold mb-3">Study Materials</h6>
                            <div class="materials-list">
                                <?php foreach ($materials as $material): ?>
                                    <div class="material-item d-flex align-items-center p-3 mb-2 border rounded-3">
                                        <div class="material-icon me-3">
                                            <?php
                                            $fileExt = pathinfo($material['filename'], PATHINFO_EXTENSION);
                                            $iconClass = 'fas fa-file';
                                            if (in_array(strtolower($fileExt), ['pdf'])) {
                                                $iconClass = 'fas fa-file-pdf text-danger';
                                            } elseif (in_array(strtolower($fileExt), ['doc', 'docx'])) {
                                                $iconClass = 'fas fa-file-word text-primary';
                                            } elseif (in_array(strtolower($fileExt), ['xls', 'xlsx'])) {
                                                $iconClass = 'fas fa-file-excel text-success';
                                            } elseif (in_array(strtolower($fileExt), ['ppt', 'pptx'])) {
                                                $iconClass = 'fas fa-file-powerpoint text-warning';
                                            } elseif (in_array(strtolower($fileExt), ['jpg', 'jpeg', 'png', 'gif'])) {
                                                $iconClass = 'fas fa-file-image text-info';
                                            } elseif (in_array(strtolower($fileExt), ['mp4', 'avi', 'mov'])) {
                                                $iconClass = 'fas fa-file-video text-secondary';
                                            }
                                            ?>
                                            <i class="<?php echo $iconClass; ?> fa-lg"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold"><?php echo htmlspecialchars($material['filename']); ?></div>
                                            <small class="text-muted">Uploaded: <?php echo date('M d, Y', strtotime($material['uploaded_at'])); ?></small>
                                        </div>
                                        <a href="<?php echo BASE_PATH; ?>/material/<?php echo $material['id']; ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fas fa-download me-1"></i>View
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php else: ?>
                        <!-- No Lesson Found Message -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-exclamation-triangle fa-4x text-warning opacity-50"></i>
                            </div>
                            <h4 class="text-muted fw-bold mb-3">Lesson Not Available</h4>
                            <p class="text-muted fs-5 mb-4">The lesson you're trying to access doesn't exist or has been removed.</p>
                            <a href="<?php echo BASE_PATH; ?>/my-courses" class="btn btn-primary-custom">
                                <i class="fas fa-arrow-left me-2"></i>Back to My Courses
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Lesson Progress -->
            <div class="content-card mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-chart-line text-success fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Your Progress</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <div class="progress-circle mb-3">
                            <div class="progress-circle-inner">
                                <span class="progress-text">75%</span>
                            </div>
                        </div>
                        <small class="text-muted">Lesson Completion</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-success rounded-pill">
                            <i class="fas fa-check me-2"></i>Mark as Complete
                        </button>
                        <button class="btn btn-outline-primary rounded-pill">
                            <i class="fas fa-redo me-2"></i>Restart Lesson
                        </button>
                    </div>
                </div>
            </div>

            <!-- Lesson Navigation -->
            <div class="content-card mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-list text-info fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Course Lessons</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="lesson-nav">
                        <?php if (!empty($lessons)): ?>
                            <?php foreach ($lessons as $index => $l): ?>
                                <?php 
                                    $isActive = $l['id'] === ($lesson['id'] ?? null);
                                    $isCompleted = isset($lesson['id']) && array_key_exists($lesson['id'], array_flip(array_column($lessons, 'id'))) && $index < array_search($lesson['id'], array_column($lessons, 'id'));
                                ?>
                                <div class="lesson-nav-item <?php echo $isActive ? 'active' : ($isCompleted ? 'completed' : ''); ?>">
                                    <div class="lesson-nav-marker">
                                        <?php if ($isActive): ?>
                                            <span><?php echo $index + 1; ?></span>
                                        <?php elseif ($isCompleted): ?>
                                            <i class="fas fa-check"></i>
                                        <?php else: ?>
                                            <span><?php echo $index + 1; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="lesson-nav-content">
                                        <small class="text-muted">Lesson <?php echo $index + 1; ?></small>
                                        <div class="fw-semibold"><?php echo htmlspecialchars($l['title']); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="content-card" data-aos="fade-up" data-aos-delay="500">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-bolt text-warning fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Quick Actions</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id'] ?? 1; ?>/progress" class="btn btn-outline-primary rounded-pill">
                            <i class="fas fa-chart-line me-2"></i>View Progress
                        </a>
                        <a href="#" onclick="alert('Q&A feature coming soon')" class="btn btn-outline-info rounded-pill">
                            <i class="fas fa-question me-2"></i>Ask Question
                        </a>
                        <a href="<?php echo BASE_PATH; ?>/my-courses" class="btn btn-outline-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Back to Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>




