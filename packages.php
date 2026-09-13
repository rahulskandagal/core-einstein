<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Packages | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(135deg, #1abc9c, #3e8ede) !important;">
        <div class="container py-4">
            <h1 class="display-4 fw-bold">Exclusive Travel Packages</h1>
            <p class="lead">All-inclusive stays, flights, and tours curated by experts.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Package 1 -->
            <div class="col-lg-4 reveal">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1540202404391-9e7ec786d7cc?w=600&q=80" class="card-img-top" alt="Honeymoon" style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 start-0 p-3">
                            <span class="badge bg-danger rounded-pill">Best Seller</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="fw-bold mb-0">Honeymoon Special</h4>
                            <span class="text-primary fw-bold">₹29,999</span>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-clock me-1"></i> 7 Days / 6 Nights</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Luxury Villa Accommodation</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Private Beach Dinner</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Spa & Wellness Package</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Airport Transfers</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary-custom w-100">Enquire Now</a>
                    </div>
                </div>
            </div>

            <!-- Package 2 -->
            <div class="col-lg-4 reveal">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1533587851505-d119e13fa0d7?w=600&q=80" class="card-img-top" alt="Adventure" style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 start-0 p-3">
                            <span class="badge bg-warning text-dark rounded-pill">Adventure</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="fw-bold mb-0">Extreme Adventure</h4>
                            <span class="text-primary fw-bold">₹14,999</span>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-clock me-1"></i> 5 Days / 4 Nights</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Mountain Trekking Guided</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Bungee Jumping Ticket</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Camping Gear Included</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Professional Photography</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary-custom w-100">Enquire Now</a>
                    </div>
                </div>
            </div>

            <!-- Package 3 -->
            <div class="col-lg-4 reveal">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=600&q=80" class="card-img-top" alt="Culture" style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 start-0 p-3">
                            <span class="badge bg-info rounded-pill">Cultural</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="fw-bold mb-0">Heritage Tour</h4>
                            <span class="text-primary fw-bold">₹19,999</span>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-clock me-1"></i> 10 Days / 9 Nights</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Historical Site Entrance Fees</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Local Cuisine Masterclasses</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Luxury Heritage Hotels</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Multi-lingual Guides</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary-custom w-100">Enquire Now</a>
                    </div>
                </div>
            </div>
            <!-- New Packages -->
            <div class="col-lg-4 col-md-6 reveal mt-4">
                <div class="card package-card border-0 shadow-lg h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="fw-bold mb-0">Budget Backpacker</h4>
                            <span class="text-primary fw-bold">₹9,999</span>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-clock me-1"></i> 4 Days / 3 Nights</p>
                        <ul class="list-unstyled mb-4">
                            <li><i class="fas fa-check text-success me-2"></i> Hostel Accommodation</li>
                            <li><i class="fas fa-check text-success me-2"></i> Local Transport</li>
                            <li><i class="fas fa-check text-success me-2"></i> Group Activities</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary-custom w-100 rounded-pill">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal mt-4">
                <div class="card package-card border-0 shadow-lg h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="fw-bold mb-0">Family Escape</h4>
                            <span class="text-primary fw-bold">₹44,999</span>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-clock me-1"></i> 6 Days / 5 Nights</p>
                        <ul class="list-unstyled mb-4">
                            <li><i class="fas fa-check text-success me-2"></i> 4-Star Family Resort</li>
                            <li><i class="fas fa-check text-success me-2"></i> Breakfast & Dinner</li>
                            <li><i class="fas fa-check text-success me-2"></i> Kids Special Zones</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary-custom w-100 rounded-pill">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal mt-4">
                <div class="card package-card border-0 shadow-lg h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="fw-bold mb-0">Royal Luxury</h4>
                            <span class="text-primary fw-bold">₹1,24,999</span>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-clock me-1"></i> 5 Days / 4 Nights</p>
                        <ul class="list-unstyled mb-4">
                            <li><i class="fas fa-check text-success me-2"></i> Private Suite in Palace</li>
                            <li><i class="fas fa-check text-success me-2"></i> Private Chauffeur</li>
                            <li><i class="fas fa-check text-success me-2"></i> All-Inclusive Dining</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary-custom w-100 rounded-pill">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal mt-4">
                <div class="card package-card border-0 shadow-lg h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="fw-bold mb-0">Western Ghats Trek</h4>
                            <span class="text-primary fw-bold">₹12,499</span>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-clock me-1"></i> 3 Days / 2 Nights</p>
                        <ul class="list-unstyled mb-4">
                            <li><i class="fas fa-check text-success me-2"></i> Camping & Tents</li>
                            <li><i class="fas fa-check text-success me-2"></i> Professional Guide</li>
                            <li><i class="fas fa-check text-success me-2"></i> Bonfire & Music</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary-custom w-100 rounded-pill">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal mt-4">
                <div class="card package-card border-0 shadow-lg h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="fw-bold mb-0">Spiritual Shimoga</h4>
                            <span class="text-primary fw-bold">₹18,999</span>
                        </div>
                        <p class="text-muted small mb-4"><i class="fas fa-clock me-1"></i> 4 Days / 3 Nights</p>
                        <ul class="list-unstyled mb-4">
                            <li><i class="fas fa-check text-success me-2"></i> Temple Tour Guide</li>
                            <li><i class="fas fa-check text-success me-2"></i> Pure Veg Meals</li>
                            <li><i class="fas fa-check text-success me-2"></i> Meditation Sessions</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary-custom w-100 rounded-pill">Enquire Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Weather API Mockup -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="glass-card p-4 border-0 bg-white shadow-sm reveal">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="fw-bold"><i class="fas fa-cloud-sun text-warning me-2"></i>Real-time Global Weather</h4>
                        <p class="mb-0 text-muted">Checking weather conditions for your destinations before you fly.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="d-flex justify-content-end gap-3 align-items-center">
                            <div class="text-end">
                                <h5 class="mb-0 fw-bold">28°C</h5>
                                <p class="small text-muted mb-0">Sunny, Bali</p>
                            </div>
                            <i class="fas fa-sun text-warning fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

</body>
</html>
