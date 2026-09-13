<?php 
require_once('includes/admin_auth.php');
require_once('../includes/db_connect.php');

// Get counts
$dest_count = $conn->query("SELECT id FROM destinations")->num_rows;
$user_count = $conn->query("SELECT id FROM users")->num_rows;
$enquiry_count = $conn->query("SELECT id FROM enquiries")->num_rows;
$enquiry_pending = $conn->query("SELECT id FROM enquiries WHERE status = 'Pending'")->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
            <a href="index.php" class="nav-admin-link active"><i class="fas fa-th-large me-2"></i> Dashboard</a>
            <a href="manage-destinations.php" class="nav-admin-link"><i class="fas fa-map-marked-alt me-2"></i> Destinations</a>
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
        <header class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold">Dashboard Overview</h2>
            <div>
                <span class="text-muted">Welcome, <strong><?php echo $_SESSION['admin_user']; ?></strong></span>
            </div>
        </header>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4 rounded-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small">Total Destinations</h6>
                            <h2 class="fw-bold mb-0"><?php echo $dest_count; ?></h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3"><i class="fas fa-globe text-primary fs-4"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4 rounded-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small">Registered Users</h6>
                            <h2 class="fw-bold mb-0"><?php echo $user_count; ?></h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-3"><i class="fas fa-users text-success fs-4"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4 rounded-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small">Pending Enquiries</h6>
                            <h2 class="fw-bold mb-0"><?php echo $enquiry_pending; ?></h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-3"><i class="fas fa-clock text-warning fs-4"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-4 rounded-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted small">Total Enquiries</h6>
                            <h2 class="fw-bold mb-0"><?php echo $enquiry_count; ?></h2>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded-3"><i class="fas fa-file-alt text-info fs-4"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Enquiries Table -->
        <div class="card border-0 shadow-sm mt-5 rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Recent Enquiries</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">No.</th>
                            <th>Customer Name</th>
                            <th>Destination</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $recent_sql = "SELECT * FROM enquiries ORDER BY created_at DESC LIMIT 5";
                        $recent_res = $conn->query($recent_sql);
                        if ($recent_res->num_rows > 0):
                            $i = 1;
                            while($row = $recent_res->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="ps-4"><?php echo $i++; ?></td>
                                <td>
                                    <div class="fw-bold"><?php echo $row['name']; ?></div>
                                    <div class="small text-muted"><?php echo $row['email']; ?></div>
                                </td>
                                <td><?php echo $row['destination_name']; ?></td>
                                <td><?php echo date('d M, Y', strtotime($row['travel_date'])); ?></td>
                                <td><span class="badge bg-<?php echo ($row['status'] == 'Pending') ? 'warning' : 'success'; ?> px-3"><?php echo $row['status']; ?></span></td>
                                <td class="text-end pe-4">
                                    <a href="view-enquiry-details.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                        <?php endwhile; else: ?>
                            <tr><td colspan="6" class="text-center py-4">No recent enquiries.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
