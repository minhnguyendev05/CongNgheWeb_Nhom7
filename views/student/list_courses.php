<?php
// list_courses.php - Courses listing page with soft, eye-friendly colors
$title = 'Course List';
require 'views/layouts/header.php';
?>

<div class="page-container p-0">
    <div class="container-fluid content-padding">
        <!-- Header Section -->
        <div class="row mb-5" data-aos="fade-down">
            <div class="col-12">
                <div class="welcome-header">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold">
                                <i class="fas fa-search me-3"></i>Explore Courses
                            </h1>
                            <p class="lead mb-4">Search and enroll in courses that suit you</p>
                            <div class="welcome-actions">
                                <a href="<?php echo BASE_PATH; ?>/my-courses" class="btn-welcome">
                                    <i class="fas fa-book me-2"></i>My Courses
                                </a>
                                <a href="<?php echo BASE_PATH; ?>/dashboard" class="btn-welcome">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="welcome-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="search-filter-card">
                    <form method="GET" action="<?php echo BASE_PATH; ?>/index.php" class="row g-3 align-items-end">
                        <input type="hidden" name="action" value="listCourses">
                        <div class="col-md-5">
                            <label for="search" class="form-label fw-semibold">Search Courses</label></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" id="search" name="search"
                                       placeholder="Search by title, description or instructor..."
                                       value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="category" class="form-label fw-semibold">Danh mục</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Tất cả danh mục</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>"
                                            <?php echo (isset($_GET['category']) && $_GET['category'] == $category['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-filter btn-lg w-100 rounded-pill">
                                <i class="fas fa-filter me-2"></i>Lọc
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="courses-grid">
            <?php if (!empty($courses)): ?>
                <?php $delay = 0; ?>
                <?php foreach ($courses as $course): ?>
                    <div data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="course-card h-100">
                            <div class="card-img-wrapper position-relative">
                                <img src="<?php echo htmlspecialchars($course['image'] ?? BASE_PATH . '/assets/img/default-course.png'); ?>" class="card-img-top" alt="Course Image" style="height: 200px; object-fit: cover;">
                                <div class="card-img-overlay d-flex align-items-start justify-content-end p-3">
                                    <span class="course-category-badge"><?php echo htmlspecialchars($course['category_name'] ?? 'Tổng quát'); ?></span>
                                </div>
                                <div class="card-img-overlay d-flex align-items-end justify-content-center p-3 hover-overlay opacity-0">
                                    <div class="d-flex gap-2">
                                        <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>" class="btn btn-light btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-eye me-1"></i>Xem
                                        </a>
                                        <?php if (in_array($course['id'], $enrolledCourses)): ?>
                                            <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>/lessons" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                                <i class="fas fa-play me-1"></i>Xem khóa học
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>/enroll" class="btn btn-success btn-sm rounded-pill shadow-sm">
                                                <i class="fas fa-plus me-1"></i>Đăng ký
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($course['description'], 0, 120)); ?>...</p>
                                <div class="course-meta mt-auto">
                                    <div class="meta-item">
                                        <i class="fas fa-user-circle"></i>
                                        <span><?php echo htmlspecialchars($course['instructor_name'] ?? 'Giảng viên'); ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần</span>
                                    </div>
                                </div>
                                <div class="card-actions mt-3">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-semibold">
                                                <i class="fas fa-eye me-1"></i>Chi tiết
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <?php if (in_array($course['id'], $enrolledCourses)): ?>
                                                <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>/lessons" class="btn btn-primary btn-sm w-100 rounded-pill fw-semibold text-truncate">
                                                    <i class="fas fa-play me-1"></i>Xem khóa học
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>/enroll" class="btn btn-success btn-sm w-100 rounded-pill fw-semibold">
                                                    <i class="fas fa-plus me-1"></i>Đăng ký
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $delay += 100; if ($delay > 400) $delay = 0; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-wrapper" data-aos="fade-up">
                    <div class="empty-state">
                        <div class="mb-4">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Không tìm thấy khóa học nào</h3>
                        <p>Hãy thử điều chỉnh tiêu chí tìm kiếm hoặc duyệt tất cả khóa học.</p>
                        <a href="<?php echo BASE_PATH; ?>/courses" class="btn btn-browse-all">
                            <i class="fas fa-list me-2"></i>Duyệt tất cả khóa học
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>




