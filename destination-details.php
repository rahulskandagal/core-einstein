<?php 
session_start();
require_once('includes/db_connect.php');

if (!isset($_GET['id'])) {
    header("Location: destinations.php");
    exit();
}

$dest_id = clean_input($_GET['id'], $conn);
$sql = "SELECT * FROM destinations WHERE id = $dest_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: destinations.php");
    exit();
}

$dest = $result->fetch_assoc();

// Handle Enquiry Submission
$success_msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_enquiry'])) {
    $name = clean_input($_POST['name'], $conn);
    $email = clean_input($_POST['email'], $conn);
    $phone = clean_input($_POST['phone'], $conn);
    $people = clean_input($_POST['people'], $conn);
    $date = clean_input($_POST['date'], $conn);
    $message = clean_input($_POST['message'], $conn);
    
    $stmt = $conn->prepare("INSERT INTO enquiries (name, email, phone, destination_id, destination_name, people_count, travel_date, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisiss", $name, $email, $phone, $dest_id, $dest['title'], $people, $date, $message);
    
    if ($stmt->execute()) {
        $success_msg = "Successfully sent! We will contact you soon.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $dest['title']; ?> | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <!-- Image Slider -->
    <div id="destCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 600px;">
                <img src="images/<?php echo $dest['image_main']; ?>" class="d-block w-100 h-100 object-fit-cover" alt="..." onerror="this.src='https://images.unsplash.com/photo-1542332213-9b5a5a3fad35?w=1600&q=80'">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-4">
                    <h1 class="display-3 fw-bold"><?php echo $dest['title']; ?></h1>
                    <p class="lead"><?php echo $dest['country']; ?></p>
                </div>
            </div>
            <!-- Additional slider images would go here -->
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <!-- Left Content: Details -->
            <div class="col-lg-8">
                <div class="reveal">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold mb-0">Overview</h2>
                        <span class="badge bg-primary rounded-pill px-3 py-2"><?php echo $dest['category']; ?></span>
                    </div>
                    <p class="lead text-muted"><?php echo $dest['long_desc']; ?></p>
                    
                    <div class="row mt-5 g-4">
                        <div class="col-md-6">
                            <div class="glass-card p-4 border-0 bg-light shadow-sm">
                                <h5 class="fw-bold text-primary mb-3"><i class="fas fa-calendar-alt me-2"></i>Best Time to Visit</h5>
                                <p class="mb-0"><?php echo $dest['best_time']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="glass-card p-4 border-0 bg-light shadow-sm">
                                <h5 class="fw-bold text-primary mb-3"><i class="fas fa-wallet me-2"></i>Estimated Cost</h5>
                                <p class="mb-0">Starts from ₹<?php echo $dest['travel_cost']; ?> per person</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="fw-bold mt-5 mb-4">Top Attractions</h3>
                    <div class="row g-3">
                        <?php 
                        $attractions = explode(',', $dest['attractions'] ?: 'Beaches,Mountains,City Tours,Cuisine');
                        foreach($attractions as $attr): 
                        ?>
                            <div class="col-md-4">
                                <div class="bg-white p-3 rounded-3 shadow-sm border-start border-primary border-4 text-center">
                                    <h6 class="mb-0"><?php echo trim($attr); ?></h6>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Map Section (Placeholder) -->
                    <h3 class="fw-bold mt-5 mb-3">Location</h3>
                    <div class="rounded-4 overflow-hidden" style="height: 350px;">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            style="border:0" 
                            src="https://maps.google.com/maps?q=<?php echo urlencode($dest['title'] . ', ' . $dest['country']); ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Right Content: Enquiry Form -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="sticky-top" style="top: 100px;">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden reveal">
                        <div class="card-header bg-primary text-white text-center py-4 border-0">
                            <h4 class="fw-bold mb-0">Book Your Trip</h4>
                            <p class="small mb-0 opacity-75">Send us an enquiry today!</p>
                        </div>
                        <div class="card-body p-4">
                            <?php if($success_msg): ?>
                                <div class="alert alert-success"><?php echo $success_msg; ?></div>
                            <?php endif; ?>

                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Full Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Email Address</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-label small fw-bold">Travelers</label>
                                        <input type="number" name="people" class="form-control" min="1" value="1" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold">Travel Date</label>
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Message (Optional)</label>
                                    <textarea name="message" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" name="submit_enquiry" class="btn btn-primary-custom w-100 py-3 mb-3">Send Enquiry</button>
                                
                                <div class="p-3 bg-light rounded-4 border text-center mt-2">
                                    <h6 class="fw-bold small mb-2"><i class="fas fa-qrcode me-2"></i>Instant Payment</h6>
                                    <img src="images/payment_qr.png" class="img-fluid rounded shadow-sm mb-2" width="120" onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Travelia_Booking'">
                                    <p class="mb-0 text-muted" style="font-size: 10px;">Scan to reserve your spot instantly!</p>
                                    <div class="mt-2 text-start" style="font-size: 11px;">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Bank:</span><span class="fw-bold">SBI</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>A/c:</span><span class="fw-bold">123456789012</span>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="text-center mt-4 border-top pt-4">
                                <p class="text-muted small">Need help? Chat with us!</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fab fa-whatsapp"></i></a>
                                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fas fa-phone"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AI Suggestion Mock (Extra Feature) -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="glass-card p-5 border-0 bg-white shadow reveal">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        <i class="fas fa-robot text-primary" style="font-size: 80px;"></i>
                    </div>
                    <div class="col-md-10">
                        <h4 class="fw-bold">AI Travel Smart Tip</h4>
                        <p class="mb-0">Based on your interest in <strong><?php echo $dest['title']; ?></strong>, our AI suggests visiting during the <strong>shoulder season</strong> for the best balance between crowd levels and pricing. Don't forget to try the local dish <strong>Maka-Zupa</strong>!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

</body>
</html>
