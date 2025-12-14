<?php
// AdminController.php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';
require_once __DIR__ . '/../helpers/ValidationHelper.php';

class AdminController {

    public function dashboard() {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $totalCourses = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
        $totalCategories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
        $totalEnrollments = $pdo->query("SELECT COUNT(*) FROM enrollments")->fetchColumn();
        $pendingCourses = $pdo->query("SELECT COUNT(*) FROM courses WHERE status = 'pending'")->fetchColumn();
        require 'views/admin/dashboard.php';
    }

    public function manageUsers() {
        requireRole(2);
        $users = User::getAllUsers();
        require 'views/admin/users/manage.php';
    }

    public function createUser() {
        requireRole(2);
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['username', 'email', 'password', 'fullname', 'role']);
            
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
            // Validate role is one of the valid roles
            if (!in_array($_POST['role'] ?? '', [0, 1, 2])) {
                $errors[] = "Invalid role selected";
            }
            
            if (empty($errors)) {
                $user = new User();
                $user->username = ValidationHelper::sanitize($_POST['username']);
                $user->email = ValidationHelper::sanitize($_POST['email']);
                $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $user->fullname = ValidationHelper::sanitize($_POST['fullname']);
                $user->role = $_POST['role'];
                $user->save();
                header('Location: ' . BASE_PATH . '/admin/users');
                exit;
            } else {
                $error = $errors[0];
                require 'views/admin/users/create.php';
            }
        } else {
            require 'views/admin/users/create.php';
        }
    }

    public function editUser($id) {
        requireRole(2);
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['username', 'email', 'fullname', 'role', 'status']);
            
            // Validate field formats
            if (!ValidationHelper::validateUsername($_POST['username'] ?? '')) {
                $errors[] = "Username must be 3-50 alphanumeric characters";
            }
            if (!ValidationHelper::validateEmail($_POST['email'] ?? '')) {
                $errors[] = "Invalid email address";
            }
            if (!ValidationHelper::validateFullname($_POST['fullname'] ?? '')) {
                $errors[] = "Full name must be 2-100 characters";
            }
            // Validate role
            if (!in_array($_POST['role'] ?? '', [0, 1, 2])) {
                $errors[] = "Invalid role selected";
            }
            // Validate status
            if (!in_array($_POST['status'] ?? '', ['active', 'inactive'])) {
                $errors[] = "Invalid status selected";
            }
            
            if (empty($errors)) {
                $user = new User();
                $user->id = $id;
                $user->username = ValidationHelper::sanitize($_POST['username']);
                $user->email = ValidationHelper::sanitize($_POST['email']);
                $user->fullname = ValidationHelper::sanitize($_POST['fullname']);
                $user->role = $_POST['role'];
                $user->status = $_POST['status'];
                $user->update();
                header('Location: ' . BASE_PATH . '/admin/users');
                exit;
            } else {
                $error = $errors[0];
                $user = User::getUserById($id);
                require 'views/admin/users/edit.php';
            }
        } else {
            $user = User::getUserById($id);
            require 'views/admin/users/edit.php';
        }
    }

    public function deleteUser($id) {
        requireRole(2);
        User::delete($id);
        header('Location: ' . BASE_PATH . '/admin/users');
        exit;
    }

    public function toggleUserStatus($id) {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT status FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $currentStatus = $stmt->fetchColumn();
        $newStatus = $currentStatus == 1 ? 0 : 1;  // Status: 1 = active, 0 = inactive
        $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $id]);
        header('Location: ' . BASE_PATH . '/admin/users');
        exit;
    }

    public function manageCategories() {
        requireRole(2);
        $categories = Category::getAllCategories();
        require 'views/admin/categories/manage.php';
    }

    public function createCategory() {
        requireRole(2);
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['name']);
            
            // Validate field formats
            if (!empty($_POST['name']) && (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 100)) {
                $errors[] = "Category name must be 2-100 characters";
            }
            if (!empty($_POST['description']) && strlen($_POST['description']) > 500) {
                $errors[] = "Description must be less than 500 characters";
            }
            
            if (empty($errors)) {
                $category = new Category();
                $category->name = ValidationHelper::sanitize($_POST['name']);
                $category->description = !empty($_POST['description']) ? ValidationHelper::sanitize($_POST['description']) : null;
                $category->save();
                header('Location: ' . BASE_PATH . '/admin/categories');
                exit;
            } else {
                $error = $errors[0];
                require 'views/admin/categories/create.php';
            }
        } else {
            require 'views/admin/categories/create.php';
        }
    }

    public function editCategory($id) {
        requireRole(2);
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            $errors = ValidationHelper::validateRequired($_POST, ['name']);
            
            // Validate field formats
            if (!empty($_POST['name']) && (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 100)) {
                $errors[] = "Category name must be 2-100 characters";
            }
            if (!empty($_POST['description']) && strlen($_POST['description']) > 500) {
                $errors[] = "Description must be less than 500 characters";
            }
            
            if (empty($errors)) {
                $category = new Category();
                $category->id = $id;
                $category->name = ValidationHelper::sanitize($_POST['name']);
                $category->description = !empty($_POST['description']) ? ValidationHelper::sanitize($_POST['description']) : null;
                $category->update();
                header('Location: ' . BASE_PATH . '/admin/categories');
                exit;
            } else {
                $error = $errors[0];
                $category = Category::getCategoryById($id);
                require 'views/admin/categories/edit.php';
            }
        } else {
            $category = Category::getCategoryById($id);
            require 'views/admin/categories/edit.php';
        }
    }

    public function deleteCategory($id) {
        requireRole(2);
        Category::delete($id);
        header('Location: ' . BASE_PATH . '/admin/categories');
        exit;
    }

    public function viewStatistics() {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $stats = [
            'total_users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'total_courses' => $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn(),
            'total_enrollments' => $pdo->query("SELECT COUNT(*) FROM enrollments")->fetchColumn(),
            'pending_courses' => $pdo->query("SELECT COUNT(*) FROM courses WHERE status = 'pending'")->fetchColumn(),
        ];
        require 'views/admin/reports/statistics.php';
    }

    public function approveCourses() {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query("
            SELECT c.*, u.fullname as instructor_name 
            FROM courses c 
            LEFT JOIN users u ON c.instructor_id = u.id 
            WHERE c.status = 'pending'
        ");
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require 'views/admin/courses/approve.php';
    }

    public function approveCourse($id) {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE courses SET status = 'approved' WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: ' . BASE_PATH . '/admin/courses/approve');
        exit;
    }

    public function rejectCourse($id) {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE courses SET status = 'rejected' WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: ' . BASE_PATH . '/admin/courses/approve');
        exit;
    }
}
