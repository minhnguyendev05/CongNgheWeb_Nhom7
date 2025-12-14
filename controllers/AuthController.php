<?php
// AuthController.php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';
require_once __DIR__ . '/../helpers/ValidationHelper.php';

class AuthController {

    public function login() {
        redirectIfLoggedIn();
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['username', 'password']);
            
            if (empty($errors)) {
                $username = ValidationHelper::sanitize($_POST['username']);
                $password = $_POST['password'];

                $user = User::authenticate($username, $password);
                if ($user) {
                    // Check if user account is active
                    if ($user['status'] !== 1) {
                        $errors[] = "Your account has been deactivated. Please contact support.";
                    } else {
                        $_SESSION['user'] = $user;
                        if ($user['role'] == 1) {
                            header('Location: ' . BASE_PATH . '/instructor/dashboard');
                        } elseif ($user['role'] == 2) {
                            header('Location: ' . BASE_PATH . '/admin/dashboard');
                        } else {
                            header('Location: ' . BASE_PATH . '/courses');
                        }
                        exit;
                    }
                } else {
                    $errors[] = "Invalid credentials";
                }
            }
            
            if (!empty($errors)) {
                $error = $errors[0];
                require 'views/auth/login.php';
            }
        } else {
            require 'views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_PATH . '/login');
        exit;
    }

    public function register() {
        redirectIfLoggedIn();
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['username', 'email', 'password', 'fullname']);
            
            // Validate field formats
            if (!ValidationHelper::validateUsername($_POST['username'] ?? '')) {
                $errors[] = "Username must be 3-50 alphanumeric characters";
            }
            if (!ValidationHelper::validateEmail($_POST['email'] ?? '')) {
                $errors[] = "Invalid email address";
            }
            if (!ValidationHelper::validatePassword($_POST['password'] ?? '')) {
                $errors[] = "Password must be at least 6 characters";
            }
            if (!ValidationHelper::validateFullname($_POST['fullname'] ?? '')) {
                $errors[] = "Full name must be 2-100 characters";
            }
            
            if (empty($errors)) {
                $username = ValidationHelper::sanitize($_POST['username']);
                $email = ValidationHelper::sanitize($_POST['email']);
                $password = $_POST['password'];
                $fullname = ValidationHelper::sanitize($_POST['fullname']);
                $role = $_POST['role'] ?? 0;

                $userId = User::register($username, $email, $password, $fullname, $role);
                if ($userId) {
                    header('Location: ' . BASE_PATH . '/login');
                    exit;
                } else {
                    $errors[] = "Username or email already exists.";
                }
            }
            
            if (!empty($errors)) {
                $error = $errors[0];
                require 'views/auth/register.php';
            }
        } else {
            require 'views/auth/register.php';
        }
    }

    public function profile() {
        requireLogin();
        $user = User::getUserById($_SESSION['user']['id']);
        require 'views/auth/profile.php';
    }

    public function updateProfile() {
        requireLogin();
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['fullname', 'email']);
            
            // Validate field formats
            if (!ValidationHelper::validateEmail($_POST['email'] ?? '')) {
                $errors[] = "Invalid email address";
            }
            if (!ValidationHelper::validateFullname($_POST['fullname'] ?? '')) {
                $errors[] = "Full name must be 2-100 characters";
            }
            
            if (empty($errors)) {
                $user = User::getUserById($_SESSION['user']['id']);
                $user->fullname = ValidationHelper::sanitize($_POST['fullname']);
                $user->email = ValidationHelper::sanitize($_POST['email']);
                
                // Handle avatar upload
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $avatarPath = $this->handleAvatarUpload($_FILES['avatar'], $user->id, $user);
                    if ($avatarPath) {
                        $user->avatar = $avatarPath;
                    }
                }
                
                $user->update();
                $_SESSION['user']['fullname'] = $user->fullname;
                $_SESSION['user']['email'] = $user->email;
                $_SESSION['user']['avatar'] = $user->avatar;
                header('Location: ' . BASE_PATH . '/profile?success=1');
                exit;
            } else {
                $error = $errors[0];
                $user = User::getUserById($_SESSION['user']['id']);
                require 'views/auth/profile.php';
            }
        } else {
            $user = User::getUserById($_SESSION['user']['id']);
            require 'views/auth/profile.php';
        }
    }

    private function handleAvatarUpload($file, $userId, $user) {
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        
        // Check file size
        if ($file['size'] > $maxFileSize) {
            return false;
        }
        
        // Check file type using finfo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mimeType, $allowedMimes)) {
            return false;
        }
        
        // Create upload directory (use __DIR__ for file system path)
        $uploadDir = __DIR__ . '/../assets/uploads/avatars';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Delete old avatar if exists
        if (isset($user->avatar) && !empty($user->avatar)) {
            $oldAvatarPath = __DIR__ . '/../' . $user->avatar;
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }
        
        // Generate unique filename
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'avatar_' . $userId . '_' . uniqid() . '.' . $ext;
        $filepath = $uploadDir . '/' . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return 'assets/uploads/avatars/' . $filename;
        }
        
        return false;
    }
    
    public function changePassword() {
        requireLogin();
        require 'views/auth/change_password.php';
    }

    public function updatePassword() {
        requireLogin();
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['current_password', 'new_password', 'confirm_password']);
            
            // Validate new password strength
            if (!empty($_POST['new_password']) && !ValidationHelper::validatePassword($_POST['new_password'])) {
                $errors[] = "New password must be at least 6 characters";
            }
            
            if (empty($errors)) {
                $currentPassword = $_POST['current_password'];
                $newPassword = $_POST['new_password'];
                $confirmPassword = $_POST['confirm_password'];

                if ($newPassword !== $confirmPassword) {
                    $errors[] = "Passwords do not match";
                } else {
                    $user = User::getUserById($_SESSION['user']['id']);
                    if (!password_verify($currentPassword, $user->password)) {
                        $errors[] = "Current password is incorrect";
                    } else {
                        $user->password = password_hash($newPassword, PASSWORD_BCRYPT);
                        $user->update();
                        header('Location: ' . BASE_PATH . '/profile?password_changed=1');
                        exit;
                    }
                }
            }
            
            if (!empty($errors)) {
                $error = $errors[0];
                require 'views/auth/change_password.php';
            }
        }
    }
}
