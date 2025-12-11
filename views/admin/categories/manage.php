<?php
$title = 'Manage Categories';
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
                                <i class="fas fa-tags me-3"></i>Manage Categories
                            </h1>
                            <p class="lead mb-4 opacity-85">Organize and manage course categories</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill"><?php echo count($categories ?? []); ?> Categories</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Course Organization</span>
                                <span class="badge bg-dark bg-opacity-50 fs-6 px-3 py-2 rounded-pill">Category Management</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-tags fa-6x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-tags text-info fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Categories List</h5>
                                <p class="text-muted mb-0">Manage course categories and organization</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="index.php?action=createCategory" class="btn btn-success rounded-pill">
                                <i class="fas fa-plus me-2"></i>Create Category
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 ps-4 py-3">ID</th>
                                    <th class="border-0 py-3">Name</th>
                                    <th class="border-0 py-3">Description</th>
                                    <th class="border-0 pe-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td class="ps-4 py-3"><?php echo $category['id']; ?></td>
                                    <td class="py-3 fw-semibold"><?php echo htmlspecialchars($category['name']); ?></td>
                                    <td class="py-3 text-muted"><?php echo htmlspecialchars($category['description']); ?></td>
                                    <td class="pe-4 py-3">
                                        <div class="d-flex gap-2">
                                            <a href="index.php?action=editCategory&id=<?php echo $category['id']; ?>" class="btn btn-outline-warning btn-sm rounded-pill">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <a href="index.php?action=deleteCategory&id=<?php echo $category['id']; ?>" class="btn btn-outline-danger btn-sm rounded-pill" onclick="return confirm('Are you sure?')">
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
