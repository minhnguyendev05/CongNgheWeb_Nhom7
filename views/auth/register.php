<?php
// register.php - Register page with soft, eye-friendly colors
require 'views/layouts/header.php';
?>

<div class="auth-container">
    <!-- Decorative Elements -->
    <div class="auth-decoration-1"></div>
    <div class="auth-decoration-2"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="auth-card register-card" data-aos="zoom-in">
                    <div class="auth-header">
                        <div class="register-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Create Account</h2>
                        <p class="text-muted mb-0">Join our learning community today</p>
                    </div>

                    <div class="auth-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo BASE_PATH; ?>/register" id="registerForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label fw-semibold">Tên đăng nhập</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 ps-0" id="username" name="username" placeholder="Chọn tên đăng nhập" minlength="3" maxlength="50" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" placeholder="Nhập email của bạn" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Create password" minlength="6" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="form-label fw-semibold">Họ và tên</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-id-card text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 ps-0" id="fullname" name="fullname" placeholder="Nhập họ và tên" minlength="2" maxlength="100" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">What role do you want to join as?</label>
                                <div class="role-selection">
                                    <div class="role-option" data-role="0">
                                        <div class="role-icon">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="role-info">
                                            <h6>Học viên</h6>
                                            <p>Take courses and earn certificates</p>
                                        </div>
                                        <input type="radio" name="role" value="0" checked style="margin-left: auto;">
                                    </div>
                                    <div class="role-option" data-role="1">
                                        <div class="role-icon">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                        <div class="role-info">
                                            <h6>Instructor</h6>
                                            <p>Create and manage your own courses</p>
                                        </div>
                                        <input type="radio" name="role" value="1" style="margin-left: auto;">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-register fw-semibold rounded-3">
                                    <i class="fas fa-user-plus me-2"></i>Create Account
                                </button>
                            </div>
                        </form>

                        <div class="auth-links">
                            <p class="mb-0 text-muted">Đã có tài khoản?
                                <a href="<?php echo BASE_PATH; ?>/login" class="fw-semibold text-decoration-none">Đăng nhập ngay</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Role selection interaction
    document.querySelectorAll('.role-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.role-option').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
        });
    });

    // Form submission with loading state
    document.getElementById('registerForm').addEventListener('submit', function(e) {
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




