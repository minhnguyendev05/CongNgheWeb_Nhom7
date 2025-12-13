<?php
// index.php - Home page with soft, eye-friendly colors
require 'views/layouts/header.php';
?>

<style>
    /* Soft, Eye-Friendly Color Scheme */
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
        --soft-gradient-secondary: linear-gradient(135deg, #b8d4f0 0%, #e6ccff 100%);
    }

    /* Hero Section - Soft and Calming */
    .hero-section {
        background: var(--soft-gradient);
        color: var(--soft-text);
        position: relative;
        overflow: hidden;
        padding: 6rem 0;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="60" cy="30" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .hero-section h1 {
        color: var(--soft-text);
        font-weight: 700;
        text-shadow: none;
    }

    .hero-section .lead {
        color: var(--soft-text-light);
        font-size: 1.2rem;
        line-height: 1.6;
    }

    .hero-section .btn-light {
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(255,255,255,0.3);
        color: var(--soft-text);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .hero-section .btn-light:hover {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .hero-section .btn-outline-light {
        border: 2px solid rgba(255,255,255,0.8);
        color: white;
        background: transparent;
    }

    .hero-section .btn-outline-light:hover {
        background: rgba(255,255,255,0.9);
        color: var(--soft-text);
        border-color: rgba(255,255,255,0.9);
    }

    /* Features Section - Soft and Clean */
    .features-section {
        background: var(--soft-gray);
        padding: 5rem 0;
    }

    .features-section h2 {
        color: var(--soft-text);
        font-weight: 600;
    }

    .features-section .lead {
        color: var(--soft-text-light);
    }

    .feature-card {
        background: white;
        border: 1px solid var(--soft-border);
        border-radius: 16px;
        box-shadow: 0 4px 20px var(--soft-shadow);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        border-color: var(--soft-primary);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        background: var(--soft-gradient);
        color: white;
        font-size: 2rem;
    }

    .feature-card h5 {
        color: var(--soft-text);
        font-weight: 600;
    }

    .feature-card p {
        color: var(--soft-text-light);
        line-height: 1.6;
    }

    /* Stats Section */
    .stats-section {
        background: var(--soft-gradient-secondary);
        padding: 4rem 0;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 20px var(--soft-shadow);
        border: 1px solid var(--soft-border);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--soft-primary);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--soft-text-light);
        font-weight: 500;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #fce4ec 0%, #e6ccff 100%);
        padding: 5rem 0;
        text-align: center;
    }

    .cta-section h2 {
        color: var(--soft-text);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .cta-section p {
        color: var(--soft-text-light);
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .cta-section .btn {
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .cta-section .btn-primary {
        background: var(--soft-primary);
        border: none;
        box-shadow: 0 4px 15px rgba(168, 192, 255, 0.3);
    }

    .cta-section .btn-primary:hover {
        background: #8ba7ff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(168, 192, 255, 0.4);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 2.5rem;
        }

        .hero-section .lead {
            font-size: 1rem;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">Chào mừng đến với Nền tảng Học tập Trực tuyến</h1>
                <p class="lead mb-4 fs-5">Học hỏi từ những giảng viên giỏi nhất trên thế giới với các khóa học toàn diện của chúng tôi. Bắt đầu hành trình của bạn ngay hôm nay!</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a class="btn btn-light btn-lg px-4 py-3 shadow-lg" href="index.php?action=listCourses" role="button">
                        <i class="fas fa-search me-2"></i>Khám phá Khóa học
                    </a>
                    <a class="btn btn-outline-light btn-lg px-4 py-3" href="index.php?action=register">
                        <i class="fas fa-user-plus me-2"></i>Bắt đầu
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center mt-4 mt-lg-0" data-aos="fade-left">
                <div class="position-relative">
                    <img src="assets/img/learning-illustration.png" alt="Learning" class="img-fluid rounded-3 shadow-lg" style="max-width: 80%; filter: brightness(1.1);">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <i class="fas fa-play-circle fa-3x text-white opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Tại sao chọn chúng tôi?</h2>
                <p class="lead">Khám phá những lợi ích của việc học tập với nền tảng của chúng tôi</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card h-100 p-4">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Giảng viên Chuyên nghiệp</h5>
                    <p class="text-muted">Học từ các chuyên gia ngành với nhiều năm kinh nghiệm và thành tích đã được chứng minh.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card h-100 p-4">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Học tập Linh hoạt</h5>
                    <p class="text-muted">Học theo tốc độ của bạn, bất cứ lúc nào và bất cứ đâu với nền tảng truy cập 24/7.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card h-100 p-4">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Chứng chỉ Công nhận</h5>
                    <p class="text-muted">Nhận chứng chỉ được công nhận khi hoàn thành khóa học để thúc đẩy sự nghiệp của bạn.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Học viên</div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Khóa học</div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-number">200+</div>
                    <div class="stat-label">Giảng viên</div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-card">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Hài lòng</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <h2>Sẵn sàng bắt đầu hành trình học tập?</h2>
                <p>Tham gia cộng đồng học viên của chúng tôi và mở khóa tiềm năng của bạn với các khóa học chất lượng cao.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="index.php?action=register" class="btn btn-primary">
                        <i class="fas fa-rocket me-2"></i>Đăng ký ngay
                    </a>
                    <a href="index.php?action=listCourses" class="btn btn-outline-primary">
                        <i class="fas fa-search me-2"></i>Khám phá khóa học
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'views/layouts/footer.php'; ?>
