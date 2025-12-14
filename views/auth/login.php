<?php
// login.php - Login page with soft, eye-friendly colors
require 'views/layouts/header.php';
?>

<div class="auth-container">
    <!-- Decorative Elements -->
    <div class="auth-decoration-1"></div>
    <div class="auth-decoration-2"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card" data-aos="zoom-in">
                    <div class="auth-header">
                        <div class="login-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Chào mừng trở lại</h2>
                        <p class="text-muted mb-0">Log in to continue your learning journey</p>
                    </div>

                    <div class="auth-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo BASE_PATH; ?>/login" id="loginForm">
                            <div class="mb-4">
                                <label for="username" class="form-label fw-semibold">Tên đăng nhập</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                </div>
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-login fw-semibold rounded-3">
                                    <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                                </button>
                            </div>
                        </form>

                        <div class="auth-links">
                            <p class="mb-0 text-muted">Chưa có tài khoản?
                                <a href="<?php echo BASE_PATH; ?>/register" class="fw-semibold text-decoration-none">Create Account Now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Form submission with loading state
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;
    });

    // Auto-focus first input
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('username').focus();
    });
</script>

<?php require 'views/layouts/footer.php'; ?>




