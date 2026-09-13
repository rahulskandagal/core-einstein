/**
 * Tourism Destination Management System - Interaction Script
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Dark Mode Toggle
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        body.setAttribute('data-theme', savedTheme);
        updateToggleButton(savedTheme);
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateToggleButton(newTheme);
        });
    }

    function updateToggleButton(theme) {
        const icon = themeToggle.querySelector('i');
        if (theme === 'dark') {
            icon.classList.replace('fa-moon', 'fa-sun');
        } else {
            icon.classList.replace('fa-sun', 'fa-moon');
        }
    }

    // 2. Scroll Progress Bar
    window.addEventListener('scroll', () => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        const progress = document.querySelector('.scroll-progress');
        if (progress) progress.style.width = scrolled + "%";
    });

    // 3. Scroll Reveal Animations
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => {
        observer.observe(el);
    });

    // 4. Back to Top Button
    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });

    if (backToTop) {
        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // 5. Chatbot Simulation
    const chatBtn = document.getElementById('chatbotBtn');
    const chatBox = document.getElementById('chatbotBox');
    
    if (chatBtn) {
        chatBtn.addEventListener('click', () => {
            chatBox.classList.toggle('active');
        });
    }

    // 6. Wishlist AJAX
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const destId = this.getAttribute('data-id');
            const icon = this.querySelector('i');
            
            fetch('add_to_wishlist.php?id=' + destId)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        icon.classList.replace('far', 'fas');
                        alert(data.message);
                    } else if (data.status === 'exists') {
                        alert('Already in wishlist!');
                        icon.classList.replace('far', 'fas');
                    } else {
                        alert('Please login first!');
                    }
                });
        });
    });
});
