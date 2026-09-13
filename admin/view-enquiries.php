<?php 
require_once('includes/admin_auth.php');
require_once('../includes/db_connect.php');

// Fetch all enquiries
$sql = "SELECT * FROM enquiries ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Enquiries | Admin</title>
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
        <h4 class="fw-bold text-primary mb-4">Travelia Admin</h4>
        <nav>
            <a href="index.php" class="nav-admin-link"><i class="fas fa-th-large me-2"></i> Dashboard</a>
            <a href="manage-destinations.php" class="nav-admin-link"><i class="fas fa-map-marked-alt me-2"></i> Destinations</a>
            <a href="view-enquiries.php" class="nav-admin-link active"><i class="fas fa-envelope-open-text me-2"></i> Enquiries</a>
            <a href="manage-users.php" class="nav-admin-link"><i class="fas fa-users me-2"></i> Users</a>
            <hr>
            <a href="logout.php" class="nav-admin-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <h2 class="fw-bold mb-4">Customer Enquiries</h2>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">No.</th>
                            <th>Customer Info</th>
                            <th>Destination</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): 
                            $i = 1;
                            while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4"><?php echo $i++; ?></td>
                                    <td>
                                        <div class="fw-bold"><?php echo $row['name']; ?></div>
                                        <div class="small text-muted"><?php echo $row['email']; ?></div>
                                        <div class="small text-muted"><?php echo $row['phone']; ?></div>
                                    </td>
                                    <td><?php echo $row['destination_name']; ?></td>
                                    <td><?php echo date('d M, Y', strtotime($row['travel_date'])); ?></td>
                                    <td><span class="badge bg-<?php echo ($row['status'] == 'Pending') ? 'warning' : 'success'; ?> px-3"><?php echo $row['status']; ?></span></td>
                                    <td class="small text-muted"><?php echo substr($row['message'], 0, 30); ?>...</td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-outline-primary">Contacted</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center py-4">No enquiries found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
