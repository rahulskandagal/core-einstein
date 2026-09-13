<?php 
session_start();
require_once('includes/db_connect.php');

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = clean_input($_POST['email'], $conn);
    $password = $_POST['password']; // No cleaning for verification

    $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

    <?php include('includes/navbar.php'); ?>

    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg p-4 rounded-4 reveal">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Welcome Back!</h2>
                        <p class="text-muted">Login to explore your next destination</p>
                    </div>

                    <?php if($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form action="login.php" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-0" placeholder="yourname@gmail.com" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label small text-muted" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="small text-decoration-none">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 py-3 mb-4">Login Now</button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted small">Don't have an account? <a href="register.php" class="text-primary fw-bold text-decoration-none">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>
</html>
