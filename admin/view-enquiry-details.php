<?php 
require_once('includes/admin_auth.php');
require_once('../includes/db_connect.php');

if (!isset($_GET['id'])) {
    header("Location: view-enquiries.php");
    exit();
}

$id = clean_input($_GET['id'], $conn);

// Handle Cancellation (Archive)
if (isset($_POST['cancel_enquiry'])) {
    $conn->query("UPDATE enquiries SET status = 'Cancelled' WHERE id = $id");
    header("Location: view-enquiry-details.php?id=$id&msg=cancelled");
    exit();
}

// Mark as Contacted if requested
if (isset($_POST['mark_contacted'])) {
    $conn->query("UPDATE enquiries SET status = 'Contacted' WHERE id = $id");
}

$sql = "SELECT * FROM enquiries WHERE id = $id";
$result = $conn->query($sql);
$enq = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enquiry Details | Admin</title>
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
            <a href="../index.php" class="nav-admin-link"><i class="fas fa-exchange-alt me-2"></i> Switch to User Site</a>
            <a href="logout.php" class="nav-admin-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="mb-4">
            <a href="view-enquiries.php" class="text-decoration-none small text-muted"><i class="fas fa-arrow-left me-1"></i> Back to Enquiries</a>
            <h2 class="fw-bold mt-2">Enquiry Details #<?php echo $enq['id']; ?></h2>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold border-bottom pb-3 mb-4 text-primary"><i class="fas fa-tools me-2"></i>Admin Toolkit</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $enq['phone']); ?>?text=<?php echo urlencode("Hello " . $enq['name'] . ", this is Travelia. We received your interest in " . $enq['destination_name'] . ". Let's discuss your trip!"); ?>" target="_blank" class="btn btn-success w-100 py-3 shadow-sm">
                                <i class="fab fa-whatsapp me-2"></i> WhatsApp
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="mailto:<?php echo $enq['email']; ?>?subject=Travel Enquiry - <?php echo $enq['destination_name']; ?>" class="btn btn-primary w-100 py-3 shadow-sm">
                                <i class="fas fa-envelope me-2"></i> Send Email
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-4 p-4 bg-light rounded-4 border">
                        <h6 class="fw-bold mb-3"><i class="fas fa-qrcode me-2"></i>Payment Collection</h6>
                        <p class="small text-muted">Click the button below to generate a payment request or show the QR code.</p>
                        <button class="btn btn-dark w-100 py-2" data-bs-toggle="modal" data-bs-target="#paymentModal">
                            <i class="fas fa-file-invoice-dollar me-2"></i> View Payment Details
                        </button>
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <form action="" method="POST" onsubmit="return confirm('Do you want to cancel this trip plan? The customer data will remain in your records.');">
                            <?php if($enq['status'] == 'Pending'): ?>
                                <button type="submit" name="mark_contacted" class="btn btn-outline-success w-100 py-2 mb-2">Mark as Contacted</button>
                            <?php elseif($enq['status'] == 'Contacted'): ?>
                                <div class="alert alert-light border text-success py-2 text-center mb-2 small"><i class="fas fa-check-circle me-2"></i> Contacted</div>
                            <?php endif; ?>

                            <?php if($enq['status'] != 'Cancelled'): ?>
                                <button type="submit" name="cancel_enquiry" class="btn btn-outline-danger w-100 py-2 small">Cancel Trip Plan</button>
                            <?php else: ?>
                                <div class="alert alert-danger bg-danger bg-opacity-10 border-danger text-danger py-2 text-center mb-0 small"><i class="fas fa-times-circle me-2"></i> Trip Cancelled</div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold border-bottom pb-3 mb-4">Customer Message</h5>
                    <p class="lead" style="font-style: italic;">"<?php echo $enq['message'] ?: 'No message provided.'; ?>"</p>
                </div>
            </div>
            
            <!-- Modal for Payment QR -->
            <div class="modal fade" id="paymentModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 rounded-4 shadow-lg">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold">Payment Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center p-4">
                            <img src="../images/payment_qr.png" class="img-fluid rounded mb-4 shadow" width="250" onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=Travelia_Payment'">
                            <div class="p-3 bg-light rounded-3 text-start">
                                <p class="mb-1 small fw-bold">Bank Details:</p>
                                <p class="mb-1 text-muted">Bank: State Bank of India</p>
                                <p class="mb-1 text-muted">A/c: 123456789012</p>
                                <p class="mb-0 text-muted">IFSC: SBIN0001234</p>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold border-bottom pb-3 mb-4">Summary Info</h5>
                    <div class="mb-3">
                        <label class="small text-muted d-block">Full Name</label>
                        <span class="fw-bold"><?php echo $enq['name']; ?></span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block">Email</label>
                        <a href="mailto:<?php echo $enq['email']; ?>" class="text-decoration-none"><?php echo $enq['email']; ?></a>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block">Phone</label>
                        <span class="fw-bold"><?php echo $enq['phone']; ?></span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block">Interested In</label>
                        <span class="badge bg-primary px-3"><?php echo $enq['destination_name']; ?></span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block">Travel Date</label>
                        <span class="fw-bold"><?php echo date('d M, Y', strtotime($enq['travel_date'])); ?></span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block">Number of People</label>
                        <span class="fw-bold"><?php echo $enq['people_count']; ?> Person(s)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
