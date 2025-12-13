<?php
// helpers/AuthHelper.php

function requireLogin() {
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=login');
        exit;
    }
}

function requireRole($role) {
    requireLogin();
    if ($_SESSION['user']['role'] != $role) {
        header('Location: index.php?action=login');
        exit;
    }
}

function redirectIfLoggedIn() {
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] == 1) {
            header('Location: index.php?action=instructorDashboard');
        } elseif ($_SESSION['user']['role'] == 2) {
            header('Location: index.php?action=adminDashboard');
        } else {
            header('Location: index.php?action=listCourses');
        }
        exit;
    }
}
?>
