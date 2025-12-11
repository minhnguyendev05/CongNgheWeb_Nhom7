<?php
// my_courses.php - My Courses page with soft, eye-friendly colors
$title = 'My Courses';
require 'views/layouts/header.php';
?>

<div class="courses-container">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row mb-5" data-aos="fade-down">
            <div class="col-12">
                <div class="welcome-header">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold">
                                <i class="fas fa-book me-3"></i>My Learning Journey
                            </h1>
                            <p class="lead mb-4">Continue your courses and track your progress</p>
                            <div class="welcome-actions">
                                <a href="index.php?action=listCourses" class="btn-welcome">
                                    <i class="fas fa-search me-2"></i>Browse Courses
                                </a>
                                <a href="index.php?action=studentDashboard" class="btn-welcome">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="welcome-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="row g-4">
            <?php if (!empty($courses)): ?>
                <?php $delay = 0; ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-xl-4 col-lg-6 col-md-12 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="course-card h-100">
                            <div class="card-img-wrapper position-relative">
                                <img src="<?php echo htmlspecialchars($course['image'] ?? 'assets/img/default-course.png'); ?>" class="card-img-top" alt="Course Image" style="height: 200px; object-fit: cover;">
                                <div class="card-img-overlay d-flex align-items-start justify-content-end p-3">
                                    <span class="course-status-badge">Enrolled</span>
                                </div>
                                <div class="card-img-overlay d-flex align-items-end justify-content-center p-3 hover-overlay opacity-0">
                                    <div class="d-flex gap-2">
                                        <a href="index.php?action=viewLesson&lessonId=1" class="btn btn-light btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-play me-1"></i>Continue
                                        </a>
                                        <a href="index.php?action=trackProgress&courseId=<?php echo $course['id']; ?>" class="btn btn-success btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-chart-line me-1"></i>Progress
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($course['description'], 0, 120)); ?>...</p>

                                <!-- Progress Section -->
                                <div class="progress-section">
                                    <div class="progress-label">
                                        <small>Progress</small>
                                        <span class="progress-percentage"><?php echo $course['progress'] ?? 0; ?>%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: <?php echo $course['progress'] ?? 0; ?>%"
                                             aria-valuenow="<?php echo $course['progress'] ?? 0; ?>"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="course-meta mt-auto">
                                    <div class="meta-item">
                                        <i class="fas fa-user-circle"></i>
                                        <span><?php echo htmlspecialchars($course['instructor_name'] ?? 'Instructor'); ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần</span>
                                    </div>
                                </div>

                                <div class="card-actions">
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <a href="index.php?action=viewLesson&lessonId=1" class="btn btn-primary btn-sm w-100 rounded-pill fw-semibold">
                                                <i class="fas fa-play me-1"></i>Continue
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="index.php?action=viewEnrolledCourseLessons&courseId=<?php echo $course['id']; ?>" class="btn btn-success btn-sm w-100 rounded-pill fw-semibold">
                                                <i class="fas fa-list me-1"></i>Lessons
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="index.php?action=trackProgress&courseId=<?php echo $course['id']; ?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-semibold">
                                                <i class="fas fa-chart-line me-1"></i>Progress
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $delay += 100; if ($delay > 400) $delay = 0; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12" data-aos="fade-up">
                    <div class="empty-state">
                        <div class="mb-4">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3>No enrolled courses yet</h3>
                        <p>Start your learning journey by enrolling in a course.</p>
                        <a href="index.php?action=listCourses" class="btn btn-browse-all">
                            <i class="fas fa-search me-2"></i>Browse Courses
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>

<div class="courses-container">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row mb-5" data-aos="fade-down">
            <div class="col-12">
                <div class="welcome-header">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold">
                                <i class="fas fa-book me-3"></i>My Learning Journey
                            </h1>
                            <p class="lead mb-4">Continue your courses and track your progress</p>
                            <div class="welcome-actions">
                                <a href="index.php?action=listCourses" class="btn-welcome">
                                    <i class="fas fa-search me-2"></i>Browse Courses
                                </a>
                                <a href="index.php?action=studentDashboard" class="btn-welcome">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="welcome-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="row g-4">
            <?php if (!empty($courses)): ?>
                <?php $delay = 0; ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-xl-4 col-lg-6 col-md-12 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="course-card h-100">
                            <div class="card-img-wrapper position-relative">
                                <img src="<?php echo htmlspecialchars($course['image'] ?? 'assets/img/default-course.png'); ?>" class="card-img-top" alt="Course Image" style="height: 200px; object-fit: cover;">
                                <div class="card-img-overlay d-flex align-items-start justify-content-end p-3">
                                    <span class="course-status-badge">Enrolled</span>
                                </div>
                                <div class="card-img-overlay d-flex align-items-end justify-content-center p-3 hover-overlay opacity-0">
                                    <div class="d-flex gap-2">
                                        <a href="index.php?action=viewLesson&lessonId=1" class="btn btn-light btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-play me-1"></i>Continue
                                        </a>
                                        <a href="index.php?action=trackProgress&courseId=<?php echo $course['id']; ?>" class="btn btn-success btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-chart-line me-1"></i>Progress
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($course['description'], 0, 120)); ?>...</p>

                                <!-- Progress Section -->
                                <div class="progress-section">
                                    <div class="progress-label">
                                        <small>Progress</small>
                                        <span class="progress-percentage"><?php echo $course['progress'] ?? 0; ?>%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: <?php echo $course['progress'] ?? 0; ?>%"
                                             aria-valuenow="<?php echo $course['progress'] ?? 0; ?>"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="course-meta mt-auto">
                                    <div class="meta-item">
                                        <i class="fas fa-user-circle"></i>
                                        <span><?php echo htmlspecialchars($course['instructor_name'] ?? 'Instructor'); ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần</span>
                                    </div>
                                </div>

                                <div class="card-actions">
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <a href="index.php?action=viewLesson&lessonId=1" class="btn btn-primary btn-sm w-100 rounded-pill fw-semibold">
                                                <i class="fas fa-play me-1"></i>Continue
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="index.php?action=viewEnrolledCourseLessons&courseId=<?php echo $course['id']; ?>" class="btn btn-success btn-sm w-100 rounded-pill fw-semibold">
                                                <i class="fas fa-list me-1"></i>Lessons
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="index.php?action=trackProgress&courseId=<?php echo $course['id']; ?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-semibold">
                                                <i class="fas fa-chart-line me-1"></i>Progress
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $delay += 100; if ($delay > 400) $delay = 0; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12" data-aos="fade-up">
                    <div class="empty-state">
                        <div class="mb-4">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3>No enrolled courses yet</h3>
                        <p>Start your learning journey by enrolling in a course.</p>
                        <a href="index.php?action=listCourses" class="btn btn-browse-all">
                            <i class="fas fa-search me-2"></i>Browse Courses
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
