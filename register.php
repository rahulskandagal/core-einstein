<?php 
session_start();
require_once('includes/db_connect.php');

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = clean_input($_POST['full_name'], $conn);
    $email = clean_input($_POST['email'], $conn);
    $phone = clean_input($_POST['phone'], $conn);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $full_name, $email, $phone, $hashed_password);

            if ($stmt->execute()) {
                $success = "Registration successful! You can now <a href='login.php'>login</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

    <?php include('includes/navbar.php'); ?>

    <div class="container py-5 mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg p-4 rounded-4 reveal">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Join Travelia</h2>
                        <p class="text-muted">Start your journey by creating an account</p>
                    </div>

                    <?php if($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <?php if($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>

                    <form action="register.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Full Name</label>
                                <input type="text" name="full_name" class="form-control bg-light border-0" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Phone Number</label>
                                <input type="tel" name="phone" class="form-control bg-light border-0" placeholder="+91 00000 00000">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Email Address</label>
                            <input type="email" name="email" class="form-control bg-light border-0" placeholder="yourname@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Password</label>
                            <input type="password" name="password" class="form-control bg-light border-0" placeholder="••••••••" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control bg-light border-0" placeholder="••••••••" required>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label small text-muted" for="terms">I agree to the Terms and Conditions</label>
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 py-3 mb-4">Create Account</button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted small">Already have an account? <a href="login.php" class="text-primary fw-bold text-decoration-none">Login instead</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>
</html>
