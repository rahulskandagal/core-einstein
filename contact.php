<?php 
session_start();
require_once('includes/db_connect.php');

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // In a real app, you might save contact messages to a dedicated table
    $msg = "Thank you for reaching out! We will get back to you soon.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(135deg, #3e8ede, #1abc9c) !important;">
        <div class="container py-4">
            <h1 class="display-4 fw-bold">Contact Us</h1>
            <p class="lead">We'd love to hear from you. Reach out for any queries.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 reveal">
                <div class="glass-card p-4 border-0 shadow mb-4">
                    <h5 class="fw-bold text-primary mb-3"><i class="fas fa-map-marker-alt me-2"></i>Office</h5>
                    <p class="text-muted">K R Puram Main Road,<br>Shimoga 577201</p>
                </div>
                <div class="glass-card p-4 border-0 shadow mb-4">
                    <h5 class="fw-bold text-primary mb-3"><i class="fas fa-phone-alt me-2"></i>Call Us</h5>
                    <p class="text-muted">+91 98765 43210<br>+91 22 2345 6789</p>
                </div>
                <div class="glass-card p-4 border-0 shadow">
                    <h5 class="fw-bold text-primary mb-3"><i class="fas fa-envelope me-2"></i>Email</h5>
                    <p class="text-muted">rahulskandagalpc@gmail.com</p>
                </div>
            </div>

            <div class="col-lg-8 reveal">
                <div class="card border-0 shadow p-5 rounded-4">
                    <h2 class="fw-bold mb-4">Send a Message</h2>
                    <?php if($msg): ?>
                        <div class="alert alert-success"><?php echo $msg; ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Your Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Subject</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Message</label>
                            <textarea class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-custom px-5 py-3">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Map -->
    <div class="container-fluid p-0 pt-5">
        <div style="height: 400px; width:100%;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62053.44498835261!2d75.5398246!3d13.9312151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbbac5bc9a27d6d%3A0xc36ca70823c96570!2sShimoga%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1689265011743!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>
</html>
