<?php
// index.php - Courses listing page with soft, eye-friendly colors
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
        margin-bottom: 1.5rem;
        padding: 1rem 0;
        border-top: 1px solid var(--soft-border);
        border-bottom: 1px solid var(--soft-border);
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

    .btn-view-course {
        background: var(--soft-gradient);
        border: none;
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(168, 192, 255, 0.3);
    }

    .btn-view-course:hover {
        background: linear-gradient(135deg, #8ba7ff 0%, #a8d5b8 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(168, 192, 255, 0.4);
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

    /* Pagination */
    .pagination {
        margin-top: 3rem;
    }

    .page-link {
        color: var(--soft-text);
        border: 2px solid var(--soft-border);
        border-radius: 50px !important;
        margin: 0 0.25rem;
        padding: 0.75rem 1.25rem;
        font-weight: 600;
        background: white;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        color: white;
        background: var(--soft-primary);
        border-color: var(--soft-primary);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(168, 192, 255, 0.3);
    }

    .page-item.active .page-link {
        background: var(--soft-gradient);
        border-color: var(--soft-primary);
        color: white;
        box-shadow: 0 4px 15px rgba(168, 192, 255, 0.3);
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
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-12 text-center courses-header" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3">Khám phá các khóa học</h1>
                <p class="lead fs-5 mb-4">Khám phá các kỹ năng mới và thúc đẩy sự nghiệp của bạn với các khóa học do chuyên gia hướng dẫn</p>
                <div class="stats-badges">
                    <span class="stats-badge"><?php echo count($courses ?? []); ?> Khóa học có sẵn</span>
                    <span class="stats-badge">Giảng viên chuyên nghiệp</span>
                    <span class="stats-badge">Truy cập trọn đời</span>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="search-filter-card">
                    <form method="GET" action="index.php" class="row g-3 align-items-end">
                        <input type="hidden" name="action" value="listCourses">
                        <div class="col-md-6">
                            <label for="search" class="form-label fw-semibold">Tìm kiếm khóa học</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" id="search" name="search"
                                       placeholder="Tìm kiếm theo tiêu đề, mô tả hoặc giảng viên..."
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
        <div class="row g-4">
            <?php if (!empty($courses)): ?>
                <?php $delay = 0; ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="course-card h-100">
                            <div class="card-img-wrapper position-relative">
                                <img src="<?php echo htmlspecialchars($course['image'] ?? 'assets/img/default-course.jpg'); ?>" class="card-img-top" alt="Course Image" style="height: 200px; object-fit: cover;">
                                <div class="card-img-overlay d-flex align-items-start justify-content-end p-3">
                                    <span class="course-category-badge"><?php echo htmlspecialchars($course['category_name'] ?? 'Tổng quát'); ?></span>
                                </div>
                                <div class="card-img-overlay d-flex align-items-end justify-content-center p-3 hover-overlay">
                                    <a href="index.php?action=viewCourse&id=<?php echo $course['id']; ?>" class="btn btn-light btn-lg rounded-pill shadow">
                                        <i class="fas fa-play-circle me-2"></i>Bắt đầu học
                                    </a>
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
                                        <span><?php echo $course['duration_weeks'] ?? 'N/A'; ?> tuần</span></span>
                                    </div>
                                </div>
                                <a href="index.php?action=viewCourse&id=<?php echo $course['id']; ?>" class="btn btn-view-course rounded-pill fw-semibold">
                                    <i class="fas fa-eye me-2"></i>Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php $delay += 100; if ($delay > 400) $delay = 0; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12" data-aos="fade-up">
                    <div class="empty-state">
                        <div class="mb-4">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Không tìm thấy khóa học nào</h3>
                        <p>Hãy thử điều chỉnh tiêu chí tìm kiếm hoặc duyệt tất cả khóa học.</p>
                        <a href="index.php?action=listCourses" class="btn btn-browse-all">
                            <i class="fas fa-list me-2"></i>Duyệt tất cả khóa học
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <div class="row mt-5" data-aos="fade-up">
                <div class="col-12">
                    <nav aria-label="Course pagination">
                        <ul class="pagination justify-content-center pagination-lg">
                            <?php
                            $currentPage = $currentPage ?? 1;
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($totalPages, $currentPage + 2);
                            ?>

                            <!-- Previous Button -->
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link rounded-pill me-2 px-4 py-3" href="index.php?action=listCourses&page=<?php echo $currentPage - 1; ?>&search=<?php echo urlencode($_GET['search'] ?? ''); ?>&category=<?php echo $_GET['category'] ?? ''; ?>" aria-label="Previous">
                                        <i class="fas fa-chevron-left me-1"></i>Trước
                                    </a>
                                </li>
                            <?php endif; ?>

                            <!-- Page Numbers -->
                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                                    <a class="page-link rounded-pill mx-1 px-4 py-3" href="index.php?action=listCourses&page=<?php echo $i; ?>&search=<?php echo urlencode($_GET['search'] ?? ''); ?>&category=<?php echo $_GET['category'] ?? ''; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link rounded-pill ms-2 px-4 py-3" href="index.php?action=listCourses&page=<?php echo $currentPage + 1; ?>&search=<?php echo urlencode($_GET['search'] ?? ''); ?>&category=<?php echo $_GET['category'] ?? ''; ?>" aria-label="Next">
                                        Sau<i class="fas fa-chevron-right ms-1"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
