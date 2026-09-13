<?php 
require_once('includes/admin_auth.php');
require_once('../includes/db_connect.php');

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = clean_input($_POST['title'], $conn);
    $category = clean_input($_POST['category'], $conn);
    $country = clean_input($_POST['country'], $conn);
    $short_desc = clean_input($_POST['short_desc'], $conn);
    $long_desc = clean_input($_POST['long_desc'], $conn);
    $travel_cost = clean_input($_POST['travel_cost'], $conn);
    $best_time = clean_input($_POST['best_time'], $conn);
    $is_popular = isset($_POST['is_popular']) ? 1 : 0;
    
    // File upload (Basic)
    $image_main = "default.jpg";
    if (isset($_FILES['image_main']) && $_FILES['image_main']['error'] == 0) {
        $image_main = time() . "_" . $_FILES['image_main']['name'];
        move_uploaded_file($_FILES['image_main']['tmp_name'], "../images/" . $image_main);
    }

    $stmt = $conn->prepare("INSERT INTO destinations (title, category, country, short_desc, long_desc, travel_cost, best_time, is_popular, image_main) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdsis", $title, $category, $country, $short_desc, $long_desc, $travel_cost, $best_time, $is_popular, $image_main);
    
    if ($stmt->execute()) {
        header("Location: manage-destinations.php?msg=added");
        exit();
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Destination | Admin</title>
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
            <a href="manage-destinations.php" class="nav-admin-link active"><i class="fas fa-map-marked-alt me-2"></i> Destinations</a>
            <a href="view-enquiries.php" class="nav-admin-link"><i class="fas fa-envelope-open-text me-2"></i> Enquiries</a>
            <a href="manage-users.php" class="nav-admin-link"><i class="fas fa-users me-2"></i> Users</a>
            <hr>
            <a href="logout.php" class="nav-admin-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="mb-4">
            <a href="manage-destinations.php" class="text-decoration-none small text-muted"><i class="fas fa-arrow-left me-1"></i> Back to List</a>
            <h2 class="fw-bold mt-2">Add New Destination</h2>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Destination Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Magical Maldives" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Category</label>
                                <select name="category" class="form-select" required>
                                    <option value="Beach">Beach</option>
                                    <option value="Mountain">Mountain</option>
                                    <option value="City">City</option>
                                    <option value="Historical">Historical</option>
                                    <option value="Nature">Nature</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Country</label>
                                <input type="text" name="country" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Short Description</label>
                            <input type="text" name="short_desc" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Detailed Description</label>
                            <textarea name="long_desc" class="form-control" rows="6" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Main Image</label>
                            <input type="file" name="image_main" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Travel Cost (₹)</label>
                            <input type="number" name="travel_cost" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Best Time to Visit</label>
                            <input type="text" name="best_time" class="form-control" placeholder="e.g. June to August">
                        </div>
                        <div class="form-check form-switch mb-4 mt-4">
                            <input class="form-check-input" type="checkbox" name="is_popular" id="popularSwitch">
                            <label class="form-check-label fw-bold" for="popularSwitch">Mark as Popular</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-3 mt-4">Save Destination</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
