<?php
$title = 'Manage Users';
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
                                <i class="fas fa-users me-3"></i>Manage Users
                            </h1>
                            <p class="lead mb-4 opacity-85">Manage user accounts and permissions</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill"><?php echo count($users ?? []); ?> Users</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">User Management</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Access Control</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-users fa-6x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-users text-info fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Users List</h5>
                                <p class="text-muted mb-0">Manage user accounts and roles</p>
                            </div>
                        </div>
                        <a href="index.php?action=createUser" class="btn btn-success rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i>Create User
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 ps-4 py-3">ID</th>
                                    <th class="border-0 py-3">Username</th>
                                    <th class="border-0 py-3">Email</th>
                                    <th class="border-0 py-3">Full Name</th>
                                    <th class="border-0 py-3">Role</th>
                                    <th class="border-0 py-3">Status</th>
                                    <th class="border-0 pe-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="ps-4 py-3"><?php echo $user['id']; ?></td>
                                    <td class="py-3 fw-semibold"><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td class="py-3 text-muted"><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td class="py-3"><?php echo htmlspecialchars($user['fullname']); ?></td>
                                    <td class="py-3">
                                        <span class="badge bg-<?php echo $user['role'] == 0 ? 'primary' : ($user['role'] == 1 ? 'success' : 'warning'); ?> rounded-pill">
                                            <?php echo $user['role'] == 0 ? 'Student' : ($user['role'] == 1 ? 'Instructor' : 'Admin'); ?>
                                        </span>
                                    <td class="py-3">
                                        <span class="badge bg-<?php echo isset($user['status']) && $user['status'] == 1 ? 'success' : 'secondary'; ?> rounded-pill">
                                            <?php echo isset($user['status']) && $user['status'] == 1 ? 'Active' : 'Inactive'; ?>
                                        </span>
                                    </td>
                                    <td class="pe-4 py-3">
                                        <div class="d-flex gap-2">
                                            <a href="index.php?action=editUser&id=<?php echo $user['id']; ?>" class="btn btn-outline-warning btn-sm rounded-pill">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <a href="index.php?action=toggleUserStatus&id=<?php echo $user['id']; ?>" class="btn btn-outline-info btn-sm rounded-pill" onclick="return confirm('Are you sure you want to toggle this user\'s status?')">
                                                <i class="fas fa-toggle-on me-1"></i>Toggle
                                            </a>
                                            <a href="index.php?action=deleteUser&id=<?php echo $user['id']; ?>" class="btn btn-outline-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>

