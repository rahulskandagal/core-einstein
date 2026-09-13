<?php 
session_start();
require_once('includes/db_connect.php');

// Fetch popular destinations
$result = false;
if (!$db_error) {
    $sql = "SELECT * FROM destinations WHERE is_popular = 1 LIMIT 3";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelia | Modern Tourism Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 hero-content animate-up">
                    <h5 class="text-uppercase text-primary fw-bold mb-3">Explore the World</h5>
                    <h1 class="hero-title">Adventure Awaits <br>Around Every Corner</h1>
                    <p class="hero-subtitle">Discover hidden gems, iconic landmarks, and breathtaking landscapes with Travelia. Your journey start here.</p>
                    
                    <!-- Quick Search Bar -->
                    <div class="glass-card p-4 mt-4" style="max-width: 600px;">
                        <form action="destinations.php" method="GET" class="row g-2">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-0"><i class="fas fa-search text-white"></i></span>
                                    <input type="text" name="search" class="form-control bg-transparent border-0 text-white" placeholder="Where do you want to go?" style="box-shadow: none;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary-custom w-100">Explore Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5" style="background: rgba(26, 188, 156, 0.05);">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3 reveal">
                    <h2 class="fw-bold text-primary">500+</h2>
                    <p class="text-muted">Destinations</p>
                </div>
                <div class="col-md-3 reveal">
                    <h2 class="fw-bold text-primary">10k+</h2>
                    <p class="text-muted">Happy Travelers</p>
                </div>
                <div class="col-md-3 reveal">
                    <h2 class="fw-bold text-primary">4.9/5</h2>
                    <p class="text-muted">Average Rating</p>
                </div>
                <div class="col-md-3 reveal">
                    <h2 class="fw-bold text-primary">24/7</h2>
                    <p class="text-muted">Support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Destinations -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <h2 class="display-5 fw-bold">Popular Destinations</h2>
                <div class="mx-auto" style="width: 80px; height: 3px; background: var(--primary-color);"></div>
                <p class="text-muted mt-3">Curated locations handpicked just for you.</p>
            </div>

            <div class="row g-4">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 reveal">
                            <div class="card dest-card shadow-sm">
                                <div class="dest-img-wrapper">
                                    <img src="images/<?php echo $row['image_main']; ?>" class="dest-img" alt="<?php echo $row['title']; ?>" onerror="this.src='https://loremflickr.com/600/400/travel,<?php echo strtolower($row['category']); ?>,<?php echo strtolower($row['country']); ?>?random=<?php echo $row['id']; ?>'">
                                    <div class="dest-overlay">
                                        <span class="badge-glass"><?php echo $row['category']; ?></span>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="card-title mb-0"><?php echo $row['title']; ?></h4>
                                        <span class="text-warning"><i class="fas fa-star me-1"></i><?php echo $row['rating']; ?></span>
                                    </div>
                                    <p class="text-muted"><i class="fas fa-map-marker-alt text-primary me-1"></i> <?php echo $row['country']; ?></p>
                                    <p class="card-text text-muted line-clamp-2"><?php echo $row['short_desc']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <h5 class="mb-0 text-primary fw-bold">₹<?php echo $row['travel_cost']; ?></h5>
                                        <a href="destination-details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-4">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No popular destinations found.</p>
                <?php endif; ?>
            </div>

            <div class="text-center mt-5">
                <a href="destinations.php" class="btn btn-primary-custom px-5">View All Destinations</a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container py-4">
            <div class="row align-items-center text-center text-lg-start">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-2">Subscribe to our Newsletter</h2>
                    <p class="text-muted mb-0">Get the latest travel tips, deals and inspiration right in your inbox.</p>
                </div>
                <div class="col-lg-5">
                    <form class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email" required>
                        <button class="btn btn-primary-custom" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>

</body>
</html>
