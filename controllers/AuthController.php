<?php
// AuthController.php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';

class AuthController {

    public function login() {
        redirectIfLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = User::authenticate($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                if ($user['role'] == 1) {
                    header('Location: index.php?action=instructorDashboard');
                } elseif ($user['role'] == 2) {
                    header('Location: index.php?action=adminDashboard');
                } else {
                    header('Location: index.php?action=listCourses');
                }
                exit;
            } else {
                $error = "Invalid credentials";
                require 'views/auth/login.php';
            }
        } else {
            require 'views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }

    public function register() {
        redirectIfLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $role = $_POST['role'] ?? 0;

            $userId = User::register($username, $email, $password, $fullname, $role);
            if ($userId) {
                header('Location: index.php?action=login');
                exit;
            } else {
                $error = "Username or email already exists.";
                require 'views/auth/register.php';
            }
        } else {
            require 'views/auth/register.php';
        }
    }
}
