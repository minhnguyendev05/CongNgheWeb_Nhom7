<?php
// AdminController.php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';

class AdminController {

    public function dashboard() {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $totalCourses = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
        $totalCategories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->fullname = $_POST['fullname'];
            $user->role = $_POST['role'];
            $user->save();
            header('Location: index.php?action=manageUsers');
            exit;
        } else {
            require 'views/admin/users/create.php';
        }
    }

    public function editUser($id) {
        requireRole(2);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->id = $id;
            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            $user->fullname = $_POST['fullname'];
            $user->role = $_POST['role'];
            $user->update();
            header('Location: index.php?action=manageUsers');
            exit;
        } else {
            $user = User::getUserById($id);
            require 'views/admin/users/edit.php';
        }
    }

    public function deleteUser($id) {
        requireRole(2);
        User::delete($id);
        header('Location: index.php?action=manageUsers');
        exit;
    }

    public function toggleUserStatus($id) {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT status FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $currentStatus = $stmt->fetchColumn();
        $newStatus = $currentStatus == 'active' ? 'inactive' : 'active';
        $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $id]);
        header('Location: index.php?action=manageUsers');
        exit;
    }

    public function manageCategories() {
        requireRole(2);
        $categories = Category::getAllCategories();
        require 'views/admin/categories/manage.php';
    }

    public function createCategory() {
        requireRole(2);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new Category();
            $category->name = $_POST['name'];
            $category->description = $_POST['description'];
            $category->save();
            header('Location: index.php?action=manageCategories');
            exit;
        } else {
            require 'views/admin/categories/create.php';
        }
    }

    public function editCategory($id) {
        requireRole(2);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new Category();
            $category->id = $id;
            $category->name = $_POST['name'];
            $category->description = $_POST['description'];
            $category->update();
            header('Location: index.php?action=manageCategories');
            exit;
        } else {
            $category = Category::getCategoryById($id);
            require 'views/admin/categories/edit.php';
        }
    }

    public function deleteCategory($id) {
        requireRole(2);
        Category::delete($id);
        header('Location: index.php?action=manageCategories');
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
        $stmt = $pdo->query("SELECT * FROM courses WHERE status = 'pending'");
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require 'views/admin/courses/approve.php';
    }

    public function approveCourse($id) {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE courses SET status = 'approved' WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: index.php?action=approveCourses');
        exit;
    }

    public function rejectCourse($id) {
        requireRole(2);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE courses SET status = 'rejected' WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: index.php?action=approveCourses');
        exit;
    }
}
