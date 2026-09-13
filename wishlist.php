<?php 
session_start();
require_once('includes/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle Remove from Wishlist
if (isset($_GET['remove'])) {
    $wish_id = clean_input($_GET['remove'], $conn);
    $conn->query("DELETE FROM wishlist WHERE id = $wish_id AND user_id = $user_id");
    header("Location: wishlist.php");
    exit();
}

// Fetch wishlist items
$sql = "SELECT w.id as wish_id, d.* FROM wishlist w JOIN destinations d ON w.destination_id = d.id WHERE w.user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

    <?php include('includes/navbar.php'); ?>

    <div class="container py-5 mt-5">
        <h2 class="fw-bold mb-4">My Wishlist <i class="fas fa-heart text-danger ms-2"></i></h2>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="row g-4">
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card dest-card shadow-sm h-100">
                            <div class="dest-img-wrapper">
                                <img src="images/<?php echo $row['image_main']; ?>" class="dest-img" alt="<?php echo $row['title']; ?>" onerror="this.src='https://images.unsplash.com/photo-1506929111035-37c2763005cb?w=800&q=80'">
                                <div class="position-absolute top-0 end-0 p-3">
                                    <a href="wishlist.php?remove=<?php echo $row['wish_id']; ?>" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Remove from Wishlist"><i class="fas fa-times text-danger"></i></a>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h4 class="card-title fw-bold"><?php echo $row['title']; ?></h4>
                                <p class="text-muted small mb-3"><i class="fas fa-map-marker-alt text-primary me-1"></i> <?php echo $row['country']; ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <h5 class="mb-0 text-primary fw-bold">₹<?php echo $row['travel_cost']; ?></h5>
                                    <a href="destination-details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-4">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="far fa-heart text-muted mb-4" style="font-size: 80px;"></i>
                <h3>Your wishlist is empty!</h3>
                <p class="text-muted">Explore destinations and save your favorites here.</p>
                <a href="destinations.php" class="btn btn-primary-custom px-5 mt-3">Explore Now</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include('includes/footer.php'); ?>

</body>
</html>
