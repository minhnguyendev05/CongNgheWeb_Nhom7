<?php
// 404.php - Custom 404 error page
require 'views/layouts/header.php';
?>
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="text-center">
        <div class="mb-4">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 5rem;"></i>
        </div>
        <h1 class="display-1 fw-bold text-muted">404</h1>
        <h2 class="h3 mb-3">Trang không tìm thấy</h2>
        <p class="lead text-muted mb-4">
            Xin lỗi, trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="<?php echo BASE_PATH; ?>/" class="btn btn-primary btn-lg">
                <i class="fas fa-home me-2"></i>Về trang chủ
            </a>
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Quay lại
            </a>
        </div>
    </div>
</div>
<?php
require 'views/layouts/footer.php';
?>




