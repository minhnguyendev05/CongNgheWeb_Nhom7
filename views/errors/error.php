<?php
// Error display template
$title = 'Lỗi';
$code = $code ?? 500;
$message = $message ?? 'An unexpected error occurred';

// Determine if we can show header/footer
$canShowLayout = true;
if ($code === 500 || $code === 0) {
    $canShowLayout = false;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lỗi - <?php echo $code; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            background: white;
            border-radius: 20px;
            padding: 4rem 2rem;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #2d3748;
        }
        .error-message {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        .error-actions a {
            padding: 0.75rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-back {
            background: #e2e8f0;
            color: #2d3748;
        }
        .btn-back:hover {
            background: #cbd5e0;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code"><?php echo $code; ?></div>
        <div class="error-title">
            <?php 
            $titles = [
                400 => 'Yêu cầu không hợp lệ',
                401 => 'Chưa xác thực',
                403 => 'Không có quyền truy cập',
                404 => 'Không tìm thấy',
                500 => 'Lỗi máy chủ',
                503 => 'Dịch vụ không khả dụng'
            ];
            echo $titles[$code] ?? 'Đã xảy ra lỗi';
            ?>
        </div>
        <div class="error-message">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <div class="error-actions">
            <a href="<?php echo BASE_PATH ?? '/'; ?>/dashboard" class="btn-home">Về trang chủ</a>
            <a href="javascript:history.back()" class="btn-back">Quay lại</a>
        </div>
    </div>
</body>
</html>
