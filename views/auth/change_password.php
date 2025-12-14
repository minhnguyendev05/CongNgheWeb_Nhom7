<?php
$title = 'Change Password';
require 'views/layouts/header.php';
?>

<div class="container-fluid content-padding mt-4">
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white border-0 p-4">
                    <h3 class="mb-0">
                        <i class="fas fa-key me-2"></i>Change Password
                    </h3>
                </div>
                <div class="card-body p-5">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo BASE_PATH; ?>/change-password">
                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-semibold">Current Password</label>
                            <input type="password" class="form-control rounded-3" id="current_password" 
                                   name="current_password" required placeholder="Enter your current password">
                            <small class="text-muted">We need your current password to confirm your identity</small>
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="form-label fw-semibold">New Password</label>
                            <input type="password" class="form-control rounded-3" id="new_password" 
                                   name="new_password" minlength="6" required placeholder="Enter your new password">
                            <small class="text-muted">Password must be at least 6 characters long</small>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control rounded-3" id="confirm_password" 
                                   name="confirm_password" minlength="6" required placeholder="Confirm your new password">
                        </div>

                        <div class="d-flex gap-2 mt-5">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 flex-grow-1">
                                <i class="fas fa-check me-2"></i>Update Password
                            </button>
                            <a href="<?php echo BASE_PATH; ?>/profile" class="btn btn-outline-secondary rounded-pill px-5">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                        </div>
                    </form>

                    <hr class="my-5">

                    <div class="alert alert-info rounded-3 border-0">
                        <h6 class="fw-bold mb-2">
                            <i class="fas fa-info-circle me-2"></i>Password Requirements
                        </h6>
                        <ul class="mb-0 small">
                            <li>At least 6 characters long</li>
                            <!-- <li>Contains uppercase and lowercase letters</li>
                            <li>Contains numbers or special characters</li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
