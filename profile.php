<?php 
session_start();
require_once('includes/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = clean_input($_POST['full_name'], $conn);
    $phone = clean_input($_POST['phone'], $conn);
    
    $stmt = $conn->prepare("UPDATE users SET full_name=?, phone=? WHERE id=?");
    $stmt->bind_param("ssi", $full_name, $phone, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['user_name'] = $full_name;
        $msg = "Profile updated successfully!";
        header("Refresh:1");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

    <?php include('includes/navbar.php'); ?>

    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden reveal">
                    <div class="row g-0">
                        <div class="col-md-4 bg-primary text-white text-center p-5 d-flex flex-column align-items-center justify-content-center">
                            <div class="mb-4">
                                <img src="images/<?php echo $user['profile_pic']; ?>" class="rounded-circle shadow" width="120" height="120" style="object-fit:cover;" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3135/3135715.png'">
                            </div>
                            <h4 class="fw-bold"><?php echo $user['full_name']; ?></h4>
                            <p class="small opacity-75">Member since <?php echo date('M Y', strtotime($user['created_at'])); ?></p>
                        </div>
                        <div class="col-md-8 p-5 bg-white">
                            <h3 class="fw-bold mb-4">Profile Settings</h3>
                            
                            <?php if($msg): ?>
                                <div class="alert alert-success"><?php echo $msg; ?></div>
                            <?php endif; ?>

                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" value="<?php echo $user['full_name']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Email Address (Cannot be changed)</label>
                                    <input type="email" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control" value="<?php echo $user['phone']; ?>">
                                </div>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary-custom px-4">Save Changes</button>
                                    <a href="logout.php" class="btn btn-outline-danger px-4">Logout</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>
</html>
