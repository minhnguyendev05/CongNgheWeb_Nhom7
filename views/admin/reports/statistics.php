<?php
$title = 'Thống kê hệ thống';
require 'views/layouts/header.php';
?>

<div class="container-fluid mt-4">
    <!-- Header Section -->
    <div class="row mb-5" data-aos="fade-down">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white border-0 rounded-4 shadow-lg">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold mb-3">
                                <i class="fas fa-chart-line me-3"></i>Thống kê hệ thống
                            </h1>
                            <p class="lead mb-4 opacity-75">Phân tích dữ liệu và báo cáo chi tiết về hoạt động của nền tảng</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">
                                    <i class="fas fa-calendar-alt me-1"></i><?php echo date('d/m/Y'); ?>
                                </span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">
                                    <i class="fas fa-clock me-1"></i>Cập nhật real-time
                                </span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">
                                    <i class="fas fa-chart-bar me-1"></i>Analytics
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-chart-line fa-6x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-users text-primary fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-1 fw-bold text-dark">
                                <?php echo isset($stats['total_users']) ? number_format($stats['total_users']) : '1,234'; ?>
                            </h3>
                            <p class="text-muted mb-0 small">Tổng người dùng</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-graduation-cap text-success fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-1 fw-bold text-dark">
                                <?php echo isset($stats['total_courses']) ? number_format($stats['total_courses']) : '156'; ?>
                            </h3>
                            <p class="text-muted mb-0 small">Tổng khóa học</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-book-open text-info fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-1 fw-bold text-dark">
                                <?php echo isset($stats['total_enrollments']) ? number_format($stats['total_enrollments']) : '2,847'; ?>
                            </h3>
                            <p class="text-muted mb-0 small">Lượt đăng ký</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-dollar-sign text-warning fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-1 fw-bold text-dark">
                                <?php echo isset($stats['total_revenue']) ? '$' . number_format($stats['total_revenue'], 2) : '$12,847'; ?>
                            </h3>
                            <p class="text-muted mb-0 small">Tổng doanh thu</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4" data-aos="fade-up" data-aos-delay="400">
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Đăng ký theo tháng</h5>
                            <p class="text-muted mb-0 small">Thống kê lượt đăng ký trong 12 tháng qua</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-calendar me-1"></i>12 tháng
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">6 tháng</a></li>
                                <li><a class="dropdown-item" href="#">12 tháng</a></li>
                                <li><a class="dropdown-item" href="#">24 tháng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <canvas id="enrollmentChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="mb-1 fw-bold text-dark">Phân loại người dùng</h5>
                    <p class="text-muted mb-0 small">Tỷ lệ học viên và giảng viên</p>
                </div>
                <div class="card-body p-4">
                    <canvas id="userTypeChart" height="250"></canvas>
                    <div class="mt-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                <span class="small text-muted">Học viên</span>
                            </div>
                            <span class="fw-semibold">78%</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                <span class="small text-muted">Giảng viên</span>
                            </div>
                            <span class="fw-semibold">22%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Statistics -->
    <div class="row" data-aos="fade-up" data-aos-delay="600">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="mb-1 fw-bold text-dark">Khóa học phổ biến</h5>
                    <p class="text-muted mb-0 small">Top 5 khóa học được đăng ký nhiều nhất</p>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php
                        $popularCourses = isset($stats['popular_courses']) ? $stats['popular_courses'] : [
                            ['title' => 'React.js Masterclass', 'enrollments' => 245, 'rating' => 4.8],
                            ['title' => 'Python for Data Science', 'enrollments' => 198, 'rating' => 4.9],
                            ['title' => 'UI/UX Design Fundamentals', 'enrollments' => 176, 'rating' => 4.7],
                            ['title' => 'Node.js Backend Development', 'enrollments' => 152, 'rating' => 4.6],
                            ['title' => 'Digital Marketing 2024', 'enrollments' => 134, 'rating' => 4.5]
                        ];

                        foreach ($popularCourses as $index => $course): ?>
                        <div class="list-group-item border-0 px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-primary bg-opacity-10 rounded-3 p-2">
                                        <span class="fw-bold text-primary"><?php echo $index + 1; ?></span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold"><?php echo htmlspecialchars($course['title']); ?></h6>
                                    <div class="d-flex align-items-center gap-3">
                                        <small class="text-muted">
                                            <i class="fas fa-users me-1"></i><?php echo $course['enrollments']; ?> học viên
                                        </small>
                                        <small class="text-warning">
                                            <i class="fas fa-star me-1"></i><?php echo $course['rating']; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="mb-1 fw-bold text-dark">Hoạt động gần đây</h5>
                    <p class="text-muted mb-0 small">Các hoạt động quan trọng trong hệ thống</p>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php
                        $recentActivities = isset($stats['recent_activities']) ? $stats['recent_activities'] : [
                            ['type' => 'enrollment', 'message' => 'Nguyễn Văn A đăng ký khóa React.js', 'time' => '2 phút trước', 'icon' => 'fas fa-user-plus', 'color' => 'success'],
                            ['type' => 'course', 'message' => 'Khóa học mới "Vue.js Advanced" được tạo', 'time' => '15 phút trước', 'icon' => 'fas fa-plus-circle', 'color' => 'primary'],
                            ['type' => 'payment', 'message' => 'Thanh toán thành công $49.99', 'time' => '1 giờ trước', 'icon' => 'fas fa-credit-card', 'color' => 'info'],
                            ['type' => 'user', 'message' => 'Trần Thị B trở thành giảng viên', 'time' => '2 giờ trước', 'icon' => 'fas fa-graduation-cap', 'color' => 'warning'],
                            ['type' => 'review', 'message' => 'Đánh giá 5 sao cho khóa Python', 'time' => '3 giờ trước', 'icon' => 'fas fa-star', 'color' => 'warning']
                        ];

                        foreach ($recentActivities as $activity): ?>
                        <div class="list-group-item border-0 px-4 py-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-<?php echo $activity['color']; ?> bg-opacity-10 rounded-3 p-2">
                                        <i class="<?php echo $activity['icon']; ?> text-<?php echo $activity['color']; ?>"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-medium"><?php echo htmlspecialchars($activity['message']); ?></p>
                                    <small class="text-muted"><?php echo $activity['time']; ?></small>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js for visualizations -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Enrollment Chart
const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
new Chart(enrollmentCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Đăng ký',
            data: [65, 78, 90, 81, 96, 105, 120, 135, 142, 158, 165, 178],
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                }
            },
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                }
            }
        }
    }
});

// User Type Chart
const userTypeCtx = document.getElementById('userTypeChart').getContext('2d');
new Chart(userTypeCtx, {
    type: 'doughnut',
    data: {
        labels: ['Học viên', 'Giảng viên'],
        datasets: [{
            data: [78, 22],
            backgroundColor: ['#667eea', '#28a745'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        cutout: '70%'
    }
});
</script>

<style>
/* Custom styles for statistics page */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.dashboard-card {
    transition: all 0.3s ease;
    border-radius: 16px !important;
}

.dashboard-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.progress {
    background-color: rgba(0,0,0,0.1);
}

.list-group-item {
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background-color: rgba(102, 126, 234, 0.05);
}
</style>

<?php require 'views/layouts/footer.php'; ?>

