<?php
// register.php - Register page with soft, eye-friendly colors
require 'views/layouts/header.php';
?>

<style>
    /* Soft, Eye-Friendly Auth Page */
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

    .auth-container {
        min-height: 100vh;
        background: var(--soft-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
        position: relative;
        overflow: hidden;
    }

    .auth-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="90" r="0.8" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="20" r="0.6" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="0.4" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.4;
    }

    .auth-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        overflow: hidden;
        max-width: 600px;
        width: 100%;
        position: relative;
        z-index: 2;
    }

    .auth-header {
        background: linear-gradient(135deg, #fce4ec 0%, #e6ccff 100%);
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
    }

    .auth-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .register-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--soft-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 8px 25px rgba(168, 192, 255, 0.3);
        position: relative;
        z-index: 3;
    }

    .register-icon i {
        font-size: 2.5rem;
        color: white;
    }

    .auth-header h2 {
        color: var(--soft-text);
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 3;
    }

    .auth-header p {
        color: var(--soft-text-light);
        font-size: 1rem;
        margin-bottom: 0;
        position: relative;
        z-index: 3;
    }

    .auth-body {
        padding: 2.5rem;
    }

    .form-label {
        color: var(--soft-text);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid var(--soft-border);
        border-radius: 12px;
        padding: 0.875rem 1rem;
        font-size: 1rem;
        background: rgba(255,255,255,0.8);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--soft-primary);
        box-shadow: 0 0 0 0.2rem rgba(168, 192, 255, 0.25);
        background: white;
    }

    .form-select {
        border: 2px solid var(--soft-border);
        border-radius: 12px;
        background: rgba(255,255,255,0.8);
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: var(--soft-primary);
        box-shadow: 0 0 0 0.2rem rgba(168, 192, 255, 0.25);
        background: white;
    }

    .btn-register {
        background: var(--soft-gradient);
        border: none;
        border-radius: 50px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(168, 192, 255, 0.3);
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #8ba7ff 0%, #a8d5b8 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(168, 192, 255, 0.4);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .auth-links {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--soft-border);
    }

    .auth-links p {
        color: var(--soft-text-light);
        margin-bottom: 0;
    }

    .auth-links a {
        color: var(--soft-primary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .auth-links a:hover {
        color: #8ba7ff;
        text-decoration: underline;
    }

    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.25rem;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8c8dc 0%, #fce4ec 100%);
        color: #c53030;
    }

    /* Role selection styling */
    .role-option {
        display: flex;
        align-items: center;
        padding: 1rem;
        border: 2px solid var(--soft-border);
        border-radius: 12px;
        background: rgba(255,255,255,0.8);
        transition: all 0.3s ease;
        cursor: pointer;
        margin-bottom: 1rem;
    }

    .role-option:hover {
        border-color: var(--soft-primary);
        background: rgba(168, 192, 255, 0.05);
    }

    .role-option.selected {
        border-color: var(--soft-primary);
        background: rgba(168, 192, 255, 0.1);
    }

    .role-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--soft-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.25rem;
    }

    .role-info h6 {
        color: var(--soft-text);
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .role-info p {
        color: var(--soft-text-light);
        font-size: 0.875rem;
        margin: 0;
    }

    /* Decorative elements */
    .auth-decoration-1 {
        position: absolute;
        top: 10%;
        right: 10%;
        width: 60px;
        height: 60px;
        background: radial-gradient(circle, rgba(168, 192, 255, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }

    .auth-decoration-2 {
        position: absolute;
        bottom: 15%;
        left: 8%;
        width: 40px;
        height: 40px;
        background: radial-gradient(circle, rgba(198, 233, 192, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite reverse;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .auth-container {
            padding: 1rem;
        }

        .auth-card {
            margin-top: 1rem;
            max-width: none;
        }

        .auth-header {
            padding: 2rem 1.5rem;
        }

        .auth-body {
            padding: 2rem 1.5rem;
        }

        .register-icon {
            width: 70px;
            height: 70px;
        }

        .register-icon i {
            font-size: 2rem;
        }
    }

    /* Loading state */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="auth-container">
    <!-- Decorative Elements -->
    <div class="auth-decoration-1"></div>
    <div class="auth-decoration-2"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="auth-card" data-aos="zoom-in">
                    <div class="auth-header">
                        <div class="register-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Tạo tài khoản</h2>
                        <p class="text-muted mb-0">Tham gia cộng đồng học tập của chúng tôi ngay hôm nay</p>
                    </div>

                    <div class="auth-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="index.php?action=register" id="registerForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label fw-semibold">Tên đăng nhập</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 ps-0" id="username" name="username" placeholder="Chọn tên đăng nhập" required>
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
                                        <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Tạo mật khẩu" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="form-label fw-semibold">Họ và tên</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-id-card text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 ps-0" id="fullname" name="fullname" placeholder="Nhập họ và tên" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Bạn muốn tham gia với vai trò nào?</label>
                                <div class="role-selection">
                                    <div class="role-option" data-role="0">
                                        <div class="role-icon">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="role-info">
                                            <h6>Học viên</h6>
                                            <p>Học các khóa học và nhận chứng chỉ</p>
                                        </div>
                                        <input type="radio" name="role" value="0" checked style="margin-left: auto;">
                                    </div>
                                    <div class="role-option" data-role="1">
                                        <div class="role-icon">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                        <div class="role-info">
                                            <h6>Giảng viên</h6>
                                            <p>Tạo và quản lý các khóa học của bạn</p>
                                        </div>
                                        <input type="radio" name="role" value="1" style="margin-left: auto;">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-register fw-semibold rounded-3">
                                    <i class="fas fa-user-plus me-2"></i>Tạo tài khoản
                                </button>
                            </div>
                        </form>

                        <div class="auth-links">
                            <p class="mb-0 text-muted">Đã có tài khoản?
                                <a href="index.php?action=login" class="fw-semibold text-decoration-none">Đăng nhập ngay</a>
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
