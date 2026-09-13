<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <i class="fas fa-map-marked-alt me-2"></i>
            <span>TRAVELIA</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="destinations.php">Destinations</a></li>
                <li class="nav-item"><a class="nav-link" href="packages.php">Packages</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                
                <li class="nav-item ms-lg-3">
                    <button id="themeToggle" class="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </button>
                </li>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn btn-outline-primary rounded-pill px-4" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?php echo explode(' ', $_SESSION['user_name'])[0]; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="wishlist.php">Wishlist</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary-custom" href="login.php">Login / Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="scroll-progress"></div>
