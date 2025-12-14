<?php
// list_courses.php - Courses listing page with soft, eye-friendly colors
$title = 'Course List';
require 'views/layouts/header.php';
?>

<style>
    /* Soft, Eye-Friendly Course Page */
    :root {
        --soft-primary: #a8c0ff;
        --soft-secondary: #b8d4f0;
        --soft-success: #c7e9c0;
        --soft-info: #d4e4f7;
        --soft-warning: #f7e4bc;
        --soft-danger: #f8c8dc;
        --soft-purple: #e6ccff;
        --soft-pink: #fce4ec;
        --soft-gray: #f8f9fa;
        --soft-text: #4a5568;
        --soft-text-light: #718096;
        --soft-border: #e2e8f0;
        --soft-shadow: rgba(0,0,0,0.08);
        --soft-gradient: linear-gradient(135deg, #a8c0ff 0%, #c7e9c0 100%);
    }

    .courses-container {
        background: var(--soft-gray);
        min-height: 100vh;
        padding: 2rem 0;
    }

    /* Header Section */
    .courses-header {
        background: var(--soft-gradient);
        padding: 4rem 0;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .courses-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="60" cy="30" r="0.8" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .courses-header h1 {
        color: var(--soft-text);
        font-weight: 700;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }

    .courses-header p {
        color: var(--soft-text-light);
        font-size: 1.2rem;
        margin-bottom: 2rem;
        position: relative;
        z-index: 2;
    }

    .stats-badges {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
        position: relative;
        z-index: 2;
    }

    .stats-badge {
        background: rgba(255,255,255,0.9);
        color: var(--soft-text);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.3);
    }

    /* Search and Filter Section */
    .search-filter-card {
        background: white;
        border: 1px solid var(--soft-border);
        border-radius: 20px;
        box-shadow: 0 8px 32px var(--soft-shadow);
        padding: 2rem;
        margin-bottom: 3rem;
    }

    .search-filter-card .form-label {
        color: var(--soft-text);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .search-filter-card .input-group-text {
        background: var(--soft-gray);
        border: 2px solid var(--soft-border);
        border-right: none;
        color: var(--soft-text-light);
    }

    .search-filter-card .form-control {
        border: 2px solid var(--soft-border);
        border-radius: 12px;
        padding: 0.875rem 1rem;
        background: rgba(255,255,255,0.8);
        transition: all 0.3s ease;
    }

    .search-filter-card .form-control:focus {
        border-color: var(--soft-primary);
        box-shadow: 0 0 0 0.2rem rgba(168, 192, 255, 0.25);
        background: white;
    }

    .search-filter-card .form-select {
        border: 2px solid var(--soft-border);
        border-radius: 12px;
        background: rgba(255,255,255,0.8);
        transition: all 0.3s ease;
    }

    .search-filter-card .form-select:focus {
        border-color: var(--soft-primary);
        box-shadow: 0 0 0 0.2rem rgba(168, 192, 255, 0.25);
        background: white;
    }

    .btn-filter {
        background: var(--soft-gradient);
        border: none;
        border-radius: 50px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(168, 192, 255, 0.3);
    }

    .btn-filter:hover {
        background: linear-gradient(135deg, #8ba7ff 0%, #a8d5b8 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(168, 192, 255, 0.4);
    }

    /* Course Cards */
    .course-card {
        background: white;
        border: 1px solid var(--soft-border);
        border-radius: 20px;
        box-shadow: 0 8px 32px var(--soft-shadow);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        min-width: 320px;
        max-width: 400px;
    }

    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        border-color: var(--soft-primary);
    }

    .card-img-wrapper {
        position: relative;
        overflow: hidden;
    }

    .course-card img {
        transition: transform 0.3s ease;
    }

    .course-card:hover img {
        transform: scale(1.05);
    }

    .course-category-badge {
        background: var(--soft-gradient);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        box-shadow: 0 4px 15px rgba(168, 192, 255, 0.3);
    }

    .hover-overlay {
        background: rgba(0,0,0,0.7);
        transition: opacity 0.3s ease;
        backdrop-filter: blur(2px);
    }

    .course-card:hover .hover-overlay {
        opacity: 1 !important;
    }

    .course-card .card-body {
        padding: 1.5rem;
    }

    .course-card .card-title {
        color: var(--soft-text);
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .course-card .card-text {
        color: var(--soft-text-light);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .course-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.75rem 0;
        border-top: 1px solid var(--soft-border);
        border-bottom: 1px solid var(--soft-border);
        background: rgba(248, 249, 250, 0.5);
        border-radius: 8px;
        margin-top: auto;
    }

    .meta-item {
        display: flex;
        align-items: center;
        color: var(--soft-text-light);
        font-size: 0.875rem;
    }

    .meta-item i {
        margin-right: 0.5rem;
        color: var(--soft-primary);
    }

    .card-actions {
        margin-top: 1rem;
    }

    .card-actions .btn {
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
        border-width: 2px;
        transition: all 0.3s ease;
    }

    /* .card-actions .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    } */

    .card-actions .btn-outline-primary:hover {
        background: var(--soft-primary);
        border-color: var(--soft-primary);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(168, 192, 255, 0.3);
    }

    .card-actions .btn-primary:hover {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    .card-actions .btn-success:hover {
        background: linear-gradient(135deg, #218838 0%, #1aa085 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    /* Courses Grid */
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 400px));
        gap: 1.5rem;
        /* justify-content: center; */
    }

    .empty-wrapper {
        grid-column: 1 / -1;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 32px var(--soft-shadow);
        border: 1px solid var(--soft-border);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--soft-text-light);
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        color: var(--soft-text);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: var(--soft-text-light);
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .btn-browse-all {
        background: var(--soft-gradient);
        border: none;
        border-radius: 50px;
        padding: 1rem 2rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(168, 192, 255, 0.3);
    }

    .btn-browse-all:hover {
        background: linear-gradient(135deg, #8ba7ff 0%, #a8d5b8 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(168, 192, 255, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .courses-header {
            padding: 3rem 0;
        }

        .courses-header h1 {
            font-size: 2rem;
        }

        .stats-badges {
            flex-direction: column;
            align-items: center;
        }

        .stats-badge {
            margin-bottom: 0.5rem;
        }

        .search-filter-card {
            padding: 1.5rem;
        }

        .course-meta {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }
    }
</style>

<div class="courses-container">
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
                                    <i class="fas fa-tachometer-alt me-2"></i>Bảng điều khiển
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
                    <form method="GET" action="<?php echo BASE_PATH; ?>/courses" class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label for="search" class="form-label fw-semibold">Search Courses</label></label>
                            <div class="input-group input-group-lg">
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
                            <select class="form-select form-select-lg" id="category" name="category">
                                <option value="">Tất cả danh mục</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>"
                                            <?php echo (isset($_GET['category']) && $_GET['category'] == $category['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
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
                                <img src="<?php echo htmlspecialchars($course['image'] ?? 'assets/img/default-course.png'); ?>" class="card-img-top" alt="Course Image" style="height: 200px; object-fit: cover;">
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
                                                <a href="<?php echo BASE_PATH; ?>/course/<?php echo $course['id']; ?>/lessons" class="btn btn-primary btn-sm w-100 rounded-pill fw-semibold">
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




