<?php 
session_start();
require_once('../includes/db_connect.php');

if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST['username'], $conn);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_user'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="admin-login-body">
    <div class="login-overlay"></div>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; position: relative; z-index: 2;">
        <div class="row justify-content-center w-100">
            <div class="col-md-5 col-lg-4">
                <div class="login-card p-5 animate-up">
                    <div class="text-center mb-4">
                        <div class="logo-circle mb-3 mx-auto overflow-hidden shadow-lg border-white">
                            <img src="../images/admin_logo.png" class="img-fluid w-100 h-100 object-fit-cover" alt="Travelia Logo">
                        </div>
                        <h2 class="fw-bold text-white mb-0">TRAVELIA</h2>
                        <p class="text-white-50 small letter-spacing-2">ADMIN PORTAL</p>
                    </div>

                    <?php if($error): ?>
                        <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-white small py-2"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-white-50 small fw-bold">Username</label>
                            <div class="input-group login-input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Admin ID" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-white-50 small fw-bold">Password</label>
                            <div class="input-group login-input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 py-3 fw-bold shadow">Login to Dashboard</button>
                    </form>

                    <div class="text-center mt-4 pt-3 border-top border-white border-opacity-10">
                        <a href="../index.php" class="text-white-50 text-decoration-none small hover-link"><i class="fas fa-arrow-left me-1"></i> Return to Site</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .admin-login-body {
            background: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
            font-family: 'Outfit', sans-serif;
        }
        .login-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(30, 41, 59, 0.4));
        }
        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
        }
        .logo-circle {
            width: 85px; height: 85px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            border: 3px solid rgba(255, 255, 255, 1);
            background: white;
        }
        .letter-spacing-2 { letter-spacing: 3px; }
        .login-input-group {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .login-input-group .input-group-text {
            background: transparent; border: none; color: rgba(255,255,255,0.4);
        }
        .login-input-group .form-control {
            background: transparent; border: none; color: white; padding: 12px;
        }
        .login-input-group .form-control::placeholder { color: rgba(255,255,255,0.3); }
        .login-input-group .form-control:focus { box-shadow: none; }
        .btn-primary-custom {
            background: linear-gradient(to right, #3e8ede, #1abc9c);
            border: none; color: white; border-radius: 12px;
            transition: 0.3s;
        }
        .btn-primary-custom:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(62, 142, 222, 0.3); }
        .animate-up { animation: up 0.8s ease-out; }
        @keyframes up { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        .hover-link:hover { color: white !important; }
    </style>
</body>
</html>
