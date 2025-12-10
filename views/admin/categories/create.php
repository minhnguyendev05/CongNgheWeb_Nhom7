<?php
$title = 'Create Category';
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
                                <i class="fas fa-plus me-3"></i>Create Category
                            </h1>
                            <p class="lead mb-4 opacity-85">Add a new course category to organize content</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">New Category</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Course Organization</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Content Management</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-plus fa-6x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Form -->
    <div class="row justify-content-center mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-3 p-2 me-3">
                            <i class="fas fa-tags text-success fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">Category Details</h5>
                            <p class="text-muted mb-0">Fill in the information for the new category</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="index.php?action=createCategory">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="name" class="form-label fw-semibold">Category Name</label>
                                <input type="text" class="form-control rounded-pill" id="name" name="name" placeholder="Enter category name" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="description" class="form-label fw-semibold">Description</label>
                                <textarea class="form-control rounded-4" id="description" name="description" rows="4" placeholder="Describe the category purpose"></textarea>
                            </div>
                        </div>
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="index.php?action=manageCategories" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                <i class="fas fa-save me-2"></i>Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
