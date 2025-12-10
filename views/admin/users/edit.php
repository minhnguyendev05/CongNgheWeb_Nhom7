<?php
$title = 'Edit User';
require 'views/layouts/header.php';
?>

<div class="container-fluid mt-4">
    <!-- Header Section -->
    <div class="row mb-5" data-aos="fade-down">
        <div class="col-12">
            <div class="card bg-gradient-warning text-white border-0 rounded-4 shadow-lg">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-5 fw-bold mb-3">
                                <i class="fas fa-edit me-3"></i>Edit User
                            </h1>
                            <p class="lead mb-4 opacity-85">Update user information and role</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Edit User</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">User Management</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-edit fa-6x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Form -->
    <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-edit text-warning fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Edit User</h5>
                            <p class="text-muted mb-0">Update user information and role</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="index.php?action=editUser&id=<?php echo $user['id']; ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control rounded-pill" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control rounded-pill" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fullname" class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control rounded-pill" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label fw-semibold">Role</label>
                                <select class="form-select rounded-pill" id="role" name="role" required>
                                    <option value="0" <?php echo $user['role'] == 0 ? 'selected' : ''; ?>>Student</option>
                                    <option value="1" <?php echo $user['role'] == 1 ? 'selected' : ''; ?>>Instructor</option>
                                    <option value="2" <?php echo $user['role'] == 2 ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex gap-3 justify-content-end mt-4">
                            <a href="index.php?action=manageUsers" class="btn btn-outline-secondary rounded-pill">Cancel</a>
                            <button type="submit" class="btn btn-warning rounded-pill px-4">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>