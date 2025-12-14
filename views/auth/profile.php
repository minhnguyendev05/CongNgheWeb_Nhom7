<?php
$title = 'Profile Settings';
require 'views/layouts/header.php';
?>

<div class="container-fluid content-padding">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white border-0 p-4">
                    <h3 class="mb-0">
                        <i class="fas fa-user-cog me-2"></i>Profile Settings
                    </h3>
                </div>
                <div class="card-body p-5">
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>Profile updated successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['password_changed'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>Password changed successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="fw-bold mb-4">Personal Information</h5>
                            <form method="POST" action="<?php echo BASE_PATH; ?>/profile" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control rounded-3" id="fullname" name="fullname" 
                                           value="<?php echo isset($user) && isset($user->fullname) ? htmlspecialchars($user->fullname) : ''; ?>"
                                           minlength="2" maxlength="100" required>
                                    <small class="form-text text-muted">2-100 characters</small>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control rounded-3" id="email" name="email" 
                                           value="<?php echo isset($user) && isset($user->email) ? htmlspecialchars($user->email) : ''; ?>" required>
                                    <small class="form-text text-muted">Valid email address required</small>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label fw-semibold">Username</label>
                                    <input type="text" class="form-control rounded-3" id="username" name="username" 
                                           value="<?php echo isset($user) && isset($user->username) ? htmlspecialchars($user->username) : ''; ?>" disabled>
                                    <small class="text-muted">Username cannot be changed</small>
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label fw-semibold">Account Type</label>
                                    <input type="text" class="form-control rounded-3" id="role" name="role" 
                                           value="<?php echo isset($user) && isset($user->role) ? ($user->role == 0 ? 'Student' : ($user->role == 1 ? 'Instructor' : 'Admin')) : 'N/A'; ?>" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="avatar" class="form-label fw-semibold">Avatar</label>
                                    <input type="file" class="form-control rounded-3" id="avatar" name="avatar" 
                                           accept="image/jpeg,image/png,image/gif,image/webp">
                                    <small class="text-muted">Accepted formats: JPG, PNG, GIF, WebP (Max 5MB)</small>
                                </div>

                                <div id="avatarPreview" class="mb-3" style="display: none;">
                                    <img id="previewImage" src="" alt="Avatar preview" class="rounded-3" style="max-width: 200px; max-height: 200px;">
                                </div>

                                <div class="d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary rounded-pill px-5">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </button>
                                    <a href="<?php echo BASE_PATH; ?>/change-password" class="btn btn-outline-secondary rounded-pill px-5">
                                        <i class="fas fa-key me-2"></i>Change Password
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-4">
                            <div class="card bg-light border-0 rounded-3 p-4">
                                <div class="text-center mb-3">
                                    <?php if (isset($user) && isset($user->avatar) && !empty($user->avatar)): ?>
                                        <img src="<?php echo BASE_PATH . '/' . htmlspecialchars($user->avatar); ?>" alt="User avatar" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                                    <?php else: ?>
                                        <i class="fas fa-user-circle fa-5x text-primary opacity-50"></i>
                                    <?php endif; ?>
                                </div>
                                <h6 class="text-center fw-bold">Account Summary</h6>
                                <hr>
                                <div class="small">
                                    <p class="mb-2">
                                        <strong>Email:</strong><br>
                                        <span class="text-muted"><?php echo isset($user) && isset($user->email) ? htmlspecialchars($user->email) : 'N/A'; ?></span>
                                    </p>
                                    <p class="mb-0">
                                        <strong>Role:</strong><br>
                                        <span class="badge bg-info">
                                            <?php echo isset($user) && isset($user->role) ? ($user->role == 0 ? 'Student' : ($user->role == 1 ? 'Instructor' : 'Admin')) : 'N/A'; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const preview = document.getElementById('avatarPreview');
            const previewImage = document.getElementById('previewImage');
            previewImage.src = event.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php require 'views/layouts/footer.php'; ?>
