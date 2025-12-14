<?php
// helpers/AuthHelper.php

function requireLogin() {
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit;
    }
}

function requireRole($role) {
    requireLogin();
    if ($_SESSION['user']['role'] != $role) {
        header('Location: /login');
        exit;
    }
}

function redirectIfLoggedIn() {
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] == 1) {
            header('Location: ' . BASE_PATH . '/instructor/dashboard');
        } elseif ($_SESSION['user']['role'] == 2) {
            header('Location: ' . BASE_PATH . '/admin/dashboard');
        } else {
            header('Location: ' . BASE_PATH . '/courses');
        }
        exit;
    }
}
?>
