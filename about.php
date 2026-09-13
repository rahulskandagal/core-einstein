<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Travelia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <!-- About Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container py-5 text-center reveal">
            <h1 class="display-3 fw-bold">Connecting You To <br><span class="text-primary">Beautiful Memories</span></h1>
            <p class="lead mt-4 mx-auto" style="max-width: 800px;">Travelia is more than just a booking portal. It's a community of dreamers and explorers dedicated to uncovering the world's most breathtaking secrets.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row align-items-center g-5 mb-5 reveal">
            <div class="col-lg-6">
                <!-- 3D Style Travel Illustration -->
                <div class="floating-img-container">
                    <img src="https://img.freepik.com/free-vector/travel-concept-with-landmarks_23-2149153250.jpg" class="img-fluid rounded-5 shadow-2xl" alt="Travel World">
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill fw-bold">THE TRAVELIA STORY</span>
                <h1 class="display-4 fw-bold mb-4">Escape the Ordinary, <br><span class="text-primary italic">Live the Extraordinary</span></h1>
                <p class="text-muted lead">Why settle for a vacation when you can have a life-altering adventure? At Travelia, we don't just book tickets; we curate soul-stirring journeys that you'll talk about for decades.</p>
                
                <div class="row mt-5 g-4">
                    <div class="col-md-6">
                        <div class="feat-card border-0 p-3 rounded-4 bg-white shadow-sm">
                            <i class="fas fa-magic text-primary fa-lg mb-3"></i>
                            <h6 class="fw-bold">Hidden Gems</h6>
                            <p class="small text-muted mb-0">Access locations that aren't on Google Maps.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feat-card border-0 p-3 rounded-4 bg-white shadow-sm">
                            <i class="fas fa-hand-holding-heart text-primary fa-lg mb-3"></i>
                            <h6 class="fw-bold">Ultra-Personalized</h6>
                            <p class="small text-muted mb-0">Every itinerary is crafted specifically for YOU.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Persuasive "Why Us" Section -->
        <section class="py-5 my-5 bg-primary rounded-5 text-white shadow-lg reveal">
            <div class="row text-center mb-5 p-4">
                <div class="col-12">
                    <h2 class="fw-bold display-5">Why 10,000+ Explorers Trust Us?</h2>
                    <p class="opacity-75">We handle the details, you handle the discovery.</p>
                </div>
            </div>
            <div class="row px-5 pb-5 g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 rounded-4 border border-white border-opacity-25 h-100 hover-lift">
                        <div class="icon-circle bg-white text-primary mx-auto mb-4">
                            <i class="fas fa-shield-check fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">100% Secure</h4>
                        <p class="small opacity-75">Verified partners and encrypted payments for peace of mind.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 rounded-4 border border-white border-opacity-25 h-100 hover-lift active">
                        <div class="icon-circle bg-white text-primary mx-auto mb-4">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Unbeatable Value</h4>
                        <p class="small opacity-75">Luxury travel at local prices. We cut the middlemen.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 rounded-4 border border-white border-opacity-25 h-100 hover-lift">
                        <div class="icon-circle bg-white text-primary mx-auto mb-4">
                            <i class="fas fa-headset fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Elite Support</h4>
                        <p class="small opacity-75">Your personal concierge is just a WhatsApp away.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dynamic Team Section -->
        <section class="mt-5 pt-5 reveal">
            <div class="text-center mb-5">
                <h2 class="fw-bold">The Creative Minds</h2>
                <p class="text-muted">Travel experts who live for the trail</p>
            </div>
            <div class="row g-5 text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="team-card p-4 rounded-5 shadow-sm border">
                        <img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg" class="rounded-circle mb-4 border border-4 border-primary p-1" width="140">
                        <h5 class="fw-bold mb-1">Rahul Kandagal</h5>
                        <p class="text-primary small fw-bold">Chief Explorer</p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                           <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                           <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card p-4 rounded-5 shadow-sm border">
                        <img src="https://img.freepik.com/free-vector/young-woman-avatar-character_24877-50674.jpg" class="rounded-circle mb-4 border border-4 border-light p-1" width="140">
                        <h5 class="fw-bold mb-1">Sarah K.</h5>
                        <p class="text-primary small fw-bold">Lead Designer</p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                           <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card p-4 rounded-5 shadow-sm border">
                        <img src="https://img.freepik.com/free-vector/boy-character-avatar-isolated_24877-60115.jpg" class="rounded-circle mb-4 border border-4 border-light p-1" width="140">
                        <h5 class="fw-bold mb-1">Alex Riva</h5>
                        <p class="text-primary small fw-bold">Tour Architect</p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                           <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card p-4 rounded-5 shadow-sm border">
                        <img src="https://img.freepik.com/free-vector/woman-avatar-character_24877-50679.jpg" class="rounded-circle mb-4 border border-4 border-light p-1" width="140">
                        <h5 class="fw-bold mb-1">Elena M.</h5>
                        <p class="text-primary small fw-bold">Expedition Guide</p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                           <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final Call to Action -->
        <section class="py-5 mt-5 text-center reveal">
            <div class="glass-card p-5 border-0 shadow-2xl rounded-5 bg-white overflow-hidden position-relative">
                <div class="cta-blob"></div>
                <h2 class="display-5 fw-bold mb-4 position-relative">Ready for your next life-changing trip?</h2>
                <p class="lead mb-5 position-relative">Stop dreaming. Start exploring. Book your free consultation today.</p>
                <div class="d-flex justify-content-center gap-4 position-relative">
                    <a href="destinations.php" class="btn btn-primary-custom px-5 py-3 rounded-pill fw-bold shadow">Check Destinations</a>
                    <a href="contact.php" class="btn btn-outline-primary px-5 py-3 rounded-pill fw-bold">Talk to Expert</a>
                </div>
            </div>
        </section>
    </div>

    <!-- FAQ Accordion -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Frequently Asked Questions</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="accordion accordion-flush bg-white rounded-4 shadow-sm p-3" id="faqAccordion">
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    How do I book a destination?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Simply browse our destinations, click "View Details", and fill out the enquiry form. Our travel experts will get back to you within 24 hours.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Can I customize my travel package?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Yes! We specialize in tailor-made experiences. Just mention your requirements in the message section of the enquiry form.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Is my payment secure?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    We use industry-standard encryption for all transactions and handle bookings directly with verified payment gateways.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

    <style>
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }
    </style>

</body>
</html>
