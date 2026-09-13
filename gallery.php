<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <section class="py-5 bg-light text-center">
        <div class="container py-4">
            <h1 class="display-4 fw-bold">Our Visual Journey</h1>
            <p class="lead text-muted">A collection of moments captured by our travelers around the globe.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-3">
            <?php 
            // Collection of different Unsplash IDs to provide variety
            $collections = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            for($i = 1; $i <= 102; $i++): 
                $col = $collections[array_rand($collections)];
                $height = ($i % 3 == 0) ? '400px' : '250px'; // Random masonry-like effect
            ?>
                <div class="col-md-3 col-sm-6 reveal">
                    <div class="gallery-item rounded-4 overflow-hidden position-relative shadow h-100">
                        <img src="https://picsum.photos/600/800?random=<?php echo $i; ?>" class="img-fluid w-100 h-100 object-fit-cover" alt="Travel Image <?php echo $i; ?>" style="min-height: <?php echo $height; ?>;">
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <style>
    .gallery-item img { transition: transform 0.5s ease; cursor: pointer; }
    .gallery-item:hover img { transform: scale(1.05); filter: brightness(0.8); }
    </style>

</body>
</html>
