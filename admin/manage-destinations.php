<?php 
require_once('includes/admin_auth.php');
require_once('../includes/db_connect.php');

// Handle Deletion
if (isset($_GET['delete'])) {
    $id = clean_input($_GET['delete'], $conn);
    $conn->query("DELETE FROM destinations WHERE id = $id");
    header("Location: manage-destinations.php?msg=deleted");
    exit();
}

// Fetch all destinations
$sql = "SELECT * FROM destinations ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Destinations | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar { width: 250px; height: 100vh; position: fixed; background: #0f172a; color: white; padding: 20px; }
        .main-content { margin-left: 250px; padding: 30px; min-height: 100vh; background: #f1f5f9; }
        .nav-admin-link { color: #94a3b8; text-decoration: none; padding: 12px 15px; display: block; border-radius: 8px; margin-bottom: 5px; transition: 0.3s; }
        .nav-admin-link:hover, .nav-admin-link.active { background: #1e293b; color: white; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="fw-bold text-primary mb-4 text-center">Travelia Admin</h4>
        <nav>
            <a href="index.php" class="nav-admin-link"><i class="fas fa-th-large me-2"></i> Dashboard</a>
            <a href="manage-destinations.php" class="nav-admin-link active"><i class="fas fa-map-marked-alt me-2"></i> Destinations</a>
            <a href="view-enquiries.php" class="nav-admin-link"><i class="fas fa-envelope-open-text me-2"></i> Enquiries</a>
            <a href="manage-users.php" class="nav-admin-link"><i class="fas fa-users me-2"></i> Users</a>
            <hr class="border-secondary opacity-25">
            <a href="#" class="nav-admin-link"><i class="fas fa-images me-2"></i> Manage Gallery</a>
            <a href="#" class="nav-admin-link"><i class="fas fa-cog me-2"></i> Site Settings</a>
            <hr class="border-secondary opacity-25">
            <a href="logout.php" class="nav-admin-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Manage Destinations</h2>
            <a href="add-destination.php" class="btn btn-primary px-4 py-2"><i class="fas fa-plus me-2"></i> Add New</a>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Destination <?php echo $_GET['msg']; ?> successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Country</th>
                            <th>Cost (₹)</th>
                            <th>Popular?</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4">
                                        <img src="../images/<?php echo $row['image_main']; ?>" class="rounded-3" width="60" height="40" style="object-fit:cover;" onerror="this.src='https://via.placeholder.com/60x40'">
                                    </td>
                                    <td><div class="fw-bold"><?php echo $row['title']; ?></div></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['country']; ?></td>
                                    <td>₹<?php echo $row['travel_cost']; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $row['is_popular'] ? 'success' : 'secondary'; ?>">
                                            <?php echo $row['is_popular'] ? 'Yes' : 'No'; ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="edit-destination.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-info me-1"><i class="fas fa-edit"></i></a>
                                        <a href="manage-destinations.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center py-4">No destinations found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
