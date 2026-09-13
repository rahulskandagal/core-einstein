<?php 
session_start();
require_once('includes/db_connect.php');

$search = isset($_GET['search']) ? clean_input($_GET['search'], $conn) : '';
$category = isset($_GET['category']) ? clean_input($_GET['category'], $conn) : '';

$sql = "SELECT * FROM destinations WHERE 1=1";
if (!empty($search)) {
    $sql .= " AND (title LIKE '%$search%' OR country LIKE '%$search%' OR short_desc LIKE '%$search%')";
}
if (!empty($category) && $category != 'All') {
    $sql .= " AND category = '$category'";
}

$result = $conn->query($sql);

// Fetch unique categories for filter
$cat_sql = "SELECT DISTINCT category FROM destinations";
$cat_result = $conn->query($cat_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <!-- Page Header -->
    <section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(135deg, #3e8ede, #1abc9c) !important;">
        <div class="container py-4">
            <h1 class="display-4 fw-bold">Explore Destinations</h1>
            <p class="lead">Find your next adventure from our handpicked collections.</p>
        </div>
    </section>

    <!-- Filter & Search -->
    <div class="container mt-n5">
        <div class="bg-white rounded-4 shadow-sm p-4 reveal" style="margin-top: -30px; position: relative; z-index: 5;">
            <form action="destinations.php" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-bold">Search</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Where to?" value="<?php echo $search; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Category</label>
                    <select name="category" class="form-select">
                        <option value="All">All Categories</option>
                        <?php while($cat = $cat_result->fetch_assoc()): ?>
                            <option value="<?php echo $cat['category']; ?>" <?php echo $category == $cat['category'] ? 'selected' : ''; ?>>
                                <?php echo $cat['category']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary-custom w-100">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 reveal">
                            <div class="card dest-card h-100">
                                <div class="dest-img-wrapper">
                                    <img src="images/<?php echo $row['image_main']; ?>" class="dest-img" alt="<?php echo $row['title']; ?>" onerror="this.src='https://loremflickr.com/600/400/travel,<?php echo strtolower($row['category']); ?>,<?php echo strtolower($row['country']); ?>?random=<?php echo $row['id']; ?>'">
                                    <div class="dest-overlay">
                                        <span class="badge-glass"><?php echo $row['category']; ?></span>
                                    </div>
                                    <?php if(isset($_SESSION['user_id'])): ?>
                                    <div class="position-absolute top-0 end-0 p-3">
                                        <button class="btn btn-light btn-sm rounded-circle shadow-sm wishlist-btn" data-id="<?php echo $row['id']; ?>">
                                            <i class="far fa-heart text-danger"></i>
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="card-title mb-0"><?php echo $row['title']; ?></h4>
                                        <span class="text-warning"><i class="fas fa-star me-1"></i><?php echo $row['rating']; ?></span>
                                    </div>
                                    <p class="text-muted"><i class="fas fa-map-marker-alt text-primary me-1"></i> <?php echo $row['country']; ?></p>
                                    <p class="card-text text-muted"><?php echo $row['short_desc']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <h5 class="mb-0 text-primary fw-bold">₹<?php echo $row['travel_cost']; ?></h5>
                                        <a href="destination-details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-4">See More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/no-search-result-found-5636306-4693740.png" alt="No results" style="max-width: 300px;">
                        <h3 class="mt-4">No destinations found matching your criteria.</h3>
                        <p class="text-muted">Try searching with different keywords or categories.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

</body>
</html>
