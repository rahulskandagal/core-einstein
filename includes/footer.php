<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-center text-md-left">
        <div class="row text-center text-md-left">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Travelia</h5>
                <p>Your ultimate companion for exploring the world's most beautiful destinations. We provide curated travel experiences that last a lifetime.</p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Quick Links</h5>
                <p><a href="index.php" class="text-white text-decoration-none">Home</a></p>
                <p><a href="about.php" class="text-white text-decoration-none">About Us</a></p>
                <p><a href="destinations.php" class="text-white text-decoration-none">Destinations</a></p>
                <p><a href="packages.php" class="text-white text-decoration-none">Packages</a></p>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Useful links</h5>
                <p><a href="register.php" class="text-white text-decoration-none">Your Account</a></p>
                <p><a href="contact.php" class="text-white text-decoration-none">Contact Support</a></p>
                <p><a href="faq.php" class="text-white text-decoration-none">FAQ</a></p>
                <p><a href="terms.php" class="text-white text-decoration-none">Terms & Conditions</a></p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Contact</h5>
                <p><i class="fas fa-home mr-3"></i> K R Puram Main Road, Shimoga 577201</p>
                <p><i class="fas fa-envelope mr-3"></i> rahulskandagalpc@gmail.com</p>
                <p><i class="fas fa-phone mr-3"></i> +91 98765 43210</p>
            </div>
        </div>

        <hr class="mb-4">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p>Copyright ©2026 All rights reserved by:
                    <a href="#" class="text-decoration-none">
                        <strong class="text-primary">Travelia Dest Management</strong>
                    </a>
                </p>
            </div>

            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<a href="#" id="backToTop" class="back-to-top">
    <i class="fas fa-chevron-up"></i>
</a>

<!-- Chatbot Popup -->
<div id="chatbotBox" class="chatbot-box">
    <div class="chat-header">
        <span>Travel Assistant</span>
        <button class="btn-close btn-close-white" id="closeChat"></button>
    </div>
    <div class="chat-body" id="chatMessages">
        <div class="msg bot">Hello! How can I help you plan your dream vacation today?</div>
    </div>
    <div class="chat-footer">
        <input type="text" placeholder="Type a message...">
        <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>
<button id="chatbotBtn" class="chatbot-btn">
    <i class="fas fa-comments"></i>
</button>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
<style>
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: var(--transition-smooth);
    z-index: 1000;
}
.back-to-top.show {
    opacity: 1;
    visibility: visible;
}
.chatbot-btn {
    position: fixed;
    bottom: 30px;
    left: 30px;
    width: 60px;
    height: 60px;
    background: var(--secondary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    border: none;
    z-index: 1000;
}
.chatbot-box {
    position: fixed;
    bottom: 100px;
    left: 30px;
    width: 300px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    display: none;
    flex-direction: column;
    z-index: 1000;
    overflow: hidden;
}
.chatbot-box.active { display: flex; }
.chat-header { background: var(--secondary-color); color: white; padding: 15px; display: flex; justify-content: space-between; }
.chat-body { height: 300px; padding: 15px; overflow-y: auto; background: #f8f9fa; }
.chat-footer { padding: 10px; display: flex; gap: 5px; }
.msg { margin-bottom: 10px; padding: 8px 12px; border-radius: 15px; font-size: 14px; }
.msg.bot { background: #e9ecef; color: #333; align-self: flex-start; }
</style>
