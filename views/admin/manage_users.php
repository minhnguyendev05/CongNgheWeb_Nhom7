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
                                <i class="fas fa-users-cog me-3"></i>User Management
                            </h1>
                            <p class="lead mb-4 opacity-85">Manage user accounts, roles, and platform access</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill"><?php echo count($users ?? []); ?> Total Users</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Role Management</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Access Control</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-users-cog fa-6x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form method="GET" action="index.php" class="row g-3 align-items-end">
                        <input type="hidden" name="action" value="manageUsers">
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-semibold">Search Users</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" id="search" name="search"
                                       placeholder="Search by name or email..."
                                       value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select class="form-select form-select-lg" id="role" name="role">
                                <option value="">All Roles</option>
                                <option value="1" <?php echo (isset($_GET['role']) && $_GET['role'] == '1') ? 'selected' : ''; ?>>Instructor</option>
                                <option value="2" <?php echo (isset($_GET['role']) && $_GET['role'] == '2') ? 'selected' : ''; ?>>Student</option>
                                <option value="3" <?php echo (isset($_GET['role']) && $_GET['role'] == '3') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select form-select-lg" id="status" name="status">
                                <option value="">All Status</option>
                                <option value="active" <?php echo (isset($_GET['status']) && $_GET['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo (isset($_GET['status']) && $_GET['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="row" data-aos="fade-up" data-aos-delay="400">
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
                                <p class="text-muted mb-0">Manage user accounts and permissions</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-success btn-lg rounded-pill" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="fas fa-plus me-2"></i>Add User
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 fw-semibold ps-4">User</th>
                                    <th class="border-0 fw-semibold">Role</th>
                                    <th class="border-0 fw-semibold">Status</th>
                                    <th class="border-0 fw-semibold">Joined</th>
                                    <th class="border-0 fw-semibold text-center pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold"><?php echo htmlspecialchars($user['fullname']); ?></div>
                                                        <small class="text-muted"><?php echo htmlspecialchars($user['email']); ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge <?php
                                                    echo $user['role'] == 1 ? 'bg-warning' :
                                                         ($user['role'] == 2 ? 'bg-info' : 'bg-danger');
                                                ?> rounded-pill px-3 py-2">
                                                    <?php
                                                    echo $user['role'] == 1 ? 'Instructor' :
                                                         ($user['role'] == 2 ? 'Student' : 'Admin');
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge <?php echo ($user['status'] ?? 'active') == 'active' ? 'bg-success' : 'bg-secondary'; ?> rounded-pill px-3 py-2">
                                                    <?php echo ucfirst($user['status'] ?? 'active'); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted"><?php echo date('M d, Y', strtotime($user['created_at'] ?? 'now')); ?></small>
                                            </td>
                                            <td class="text-center pe-4">
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-outline-primary btn-sm rounded-pill me-1" title="Edit User">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-outline-info btn-sm rounded-pill me-1" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-outline-warning btn-sm rounded-pill" title="Toggle Status">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="mb-3">
                                                <i class="fas fa-users fa-4x text-muted opacity-50"></i>
                                            </div>
                                            <h6 class="text-muted">No users found</h6>
                                            <small class="text-muted">Try adjusting your search criteria</small>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>Add New User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="index.php?action=createUser" id="addUserForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="fullname" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control rounded-pill" id="fullname" name="fullname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control rounded-pill" id="username" name="username" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control rounded-pill" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select class="form-select rounded-pill" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="1">Instructor</option>
                                <option value="0">Student</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control rounded-pill" id="password" name="password" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addUserForm" class="btn btn-primary rounded-pill px-4">Create User</button>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
