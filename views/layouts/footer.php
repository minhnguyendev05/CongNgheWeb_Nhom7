<?php
// footer.php - Professional modern footer
?>
<style>
    /* Modern Footer Styles */
    .footer-modern {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        padding: 10px;
    }

    .footer-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #667eea 100%);
        animation: gradientShift 3s ease-in-out infinite;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .footer-content {
        padding: 5rem 0 3rem;
        position: relative;
        z-index: 2;
    }

    .footer-brand {
        margin-bottom: 2rem;
    }

    .footer-brand .brand-logo {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
        display: inline-block;
    }

    .footer-brand .brand-description {
        color: #b8c5d6;
        font-size: 1rem;
        line-height: 1.6;
        max-width: 300px;
    }

    .footer-links h5 {
        color: #ffffff;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .footer-links h5::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 1px;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        color: #b8c5d6;
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .footer-links a:hover {
        color: #ffffff;
        transform: translateX(5px);
    }

    .footer-links a i {
        margin-right: 0.5rem;
        width: 1em;
        text-align: center;
    }

    .footer-contact .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: #b8c5d6;
    }

    .footer-contact .contact-item i {
        margin-right: 0.75rem;
        color: #667eea;
        font-size: 1.1rem;
        width: 1.2em;
        text-align: center;
    }

    .footer-social {
        margin-top: 2rem;
    }

    .footer-social h5 {
        margin-bottom: 1.5rem;
    }

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        color: #ffffff;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .social-link:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .footer-newsletter {
        background: rgba(255,255,255,0.05);
        border-radius: 15px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .footer-newsletter h5 {
        color: #ffffff;
        margin-bottom: 1rem;
    }

    .footer-newsletter p {
        color: #b8c5d6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .newsletter-form .input-group {
        background: rgba(255,255,255,0.1);
        border-radius: 50px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .newsletter-form .form-control {
        background: transparent;
        border: none;
        color: #ffffff;
        padding: 0.75rem 1rem;
    }

    .newsletter-form .form-control::placeholder {
        color: rgba(255,255,255,0.6);
    }

    .newsletter-form .form-control:focus {
        background: transparent;
        color: #ffffff;
        box-shadow: none;
    }

    .newsletter-form .btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 0 50px 50px 0;
        padding: 0.75rem 1.5rem;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .newsletter-form .btn:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        transform: scale(1.05);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding: 2rem 0;
        margin-top: 4rem;
    }

    .footer-bottom-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .copyright {
        color: #b8c5d6;
        font-size: 0.9rem;
        margin: 0;
    }

    .footer-bottom-links {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .footer-bottom-links a {
        color: #b8c5d6;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .footer-bottom-links a:hover {
        color: #ffffff;
    }

    /* Decorative Elements */
    .footer-decoration {
        position: absolute;
        top: 20%;
        right: 5%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .footer-decoration-2 {
        position: absolute;
        bottom: 20%;
        left: 5%;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(118, 75, 162, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .footer-content {
            padding: 3.5rem 1.5rem 2.5rem !important;
        }

        .footer-brand {
            margin-bottom: 2rem !important;
        }

        .footer-links {
            margin-bottom: 2.5rem !important;
        }

        .footer-contact {
            margin-bottom: 2rem !important;
        }

        .footer-newsletter {
            margin-top: 2rem !important;
        }

        .footer-bottom-content {
            padding: 1.25rem 1.5rem 0 !important;
        }
    }

    @media (max-width: 768px) {
        .footer-content {
            padding: 2.5rem 1rem 1.5rem !important;
        }

        .footer-brand {
            margin-bottom: 1.5rem !important;
            text-align: center !important;
        }

        .footer-brand .brand-logo {
            font-size: 2.2rem !important;
        }

        .footer-brand .brand-description {
            max-width: 100% !important;
            margin: 0 auto !important;
        }

        .footer-links {
            margin-bottom: 2rem !important;
            text-align: center !important;
        }

        .footer-links h5 {
            font-size: 1.1rem !important;
            margin-bottom: 1rem !important;
        }

        .footer-links ul {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 0.5rem !important;
        }

        .footer-links li {
            margin-bottom: 0.5rem !important;
        }

        .footer-newsletter {
            padding: 1.5rem 1rem !important;
            margin: 1.5rem 0 !important;
            text-align: center !important;
        }

        .footer-newsletter h5 {
            font-size: 1.1rem !important;
        }

        .newsletter-form .input-group {
            max-width: 100% !important;
            margin: 0 auto !important;
        }

        .footer-bottom-content {
            flex-direction: column !important;
            text-align: center !important;
            gap: 1rem !important;
            padding: 1rem 1rem 0 !important;
        }

        .footer-bottom-links {
            justify-content: center !important;
            flex-wrap: wrap !important;
            gap: 1rem !important;
        }

        .social-links {
            justify-content: center !important;
            gap: 0.75rem !important;
        }

        .footer-decoration,
        .footer-decoration-2 {
            display: none !important;
        }
    }

    @media (max-width: 576px) {
        .footer-content {
            padding: 2rem 0.75rem 1rem !important;
        }

        .footer-brand .brand-logo {
            font-size: 1.8rem !important;
        }

        .footer-brand .brand-description {
            font-size: 0.9rem !important;
        }

        .footer-links h5 {
            font-size: 1rem !important;
        }

        .footer-links a {
            font-size: 0.9rem !important;
        }

        .footer-newsletter {
            padding: 1.25rem 0.75rem !important;
        }

        .newsletter-form .form-control {
            font-size: 0.9rem !important;
            padding: 0.625rem 0.75rem !important;
        }

        .newsletter-form .btn {
            font-size: 0.9rem !important;
            padding: 0.625rem 1rem !important;
        }

        .social-links {
            gap: 0.5rem !important;
        }

        .social-link {
            width: 36px !important;
            height: 36px !important;
        }

        .social-link i {
            font-size: 0.9rem !important;
        }

        .footer-bottom-links {
            gap: 0.75rem !important;
        }

        .footer-bottom-links a {
            font-size: 0.85rem !important;
        }

        .footer-copyright {
            font-size: 0.8rem !important;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        .footer-links a,
        .social-link,
        .newsletter-form .btn {
            transition: none;
        }

        .footer-decoration,
        .footer-decoration-2 {
            animation: none;
        }

        .footer-modern::before {
            animation: none;
        }
    }

    /* Focus states */
    .footer-links a:focus,
    .social-link:focus,
    .newsletter-form .btn:focus {
        outline: 2px solid #667eea;
        outline-offset: 2px;
    }
</style>

<!-- Modern Footer -->
<footer class="footer-modern">
    <!-- Decorative Elements -->
    <div class="footer-decoration"></div>
    <div class="footer-decoration-2"></div>

    <div class="container footer-content">
        <div class="row g-5">
            <!-- Brand Section -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand">
                    <div class="brand-logo">CourseHub</div>
                    <p class="brand-description">
                        Empowering learners worldwide with quality education. Join thousands of students and instructors in our innovative learning platform.
                    </p>
                </div>

                <!-- Social Links -->
                <div class="footer-social">
                    <h5 class="text-white">Follow Us</h5>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-links">
                    <h5>Platform</h5>
                    <ul>
                        <li><a href="index.php?action=listCourses"><i class="fas fa-book"></i>Browse Courses</a></li>
                        <li><a href="index.php?action=register"><i class="fas fa-user-plus"></i>Join as Student</a></li>
                        <li><a href="index.php?action=register"><i class="fas fa-chalkboard-teacher"></i>Become Instructor</a></li>
                        <li><a href="#pricing"><i class="fas fa-crown"></i>Pricing</a></li>
                    </ul>
                </div>
            </div>

            <!-- Support Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-links">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#help"><i class="fas fa-question-circle"></i>Help Center</a></li>
                        <li><a href="#contact"><i class="fas fa-envelope"></i>Contact Us</a></li>
                        <li><a href="#faq"><i class="fas fa-comments"></i>FAQ</a></li>
                        <li><a href="#feedback"><i class="fas fa-star"></i>Feedback</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-contact">
                    <h5 class="text-white">Get in Touch</h5>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Learning Street, Education City, EC 12345</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>support@coursehub.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span>Mon-Fri: 9AM-6PM EST</span>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="footer-newsletter mt-4">
                    <h5>Stay Updated</h5>
                    <p>Subscribe to our newsletter for the latest courses and platform updates.</p>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                            <button class="btn" type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> CourseHub. All rights reserved.
                    <span class="d-none d-md-inline">• Made with <i class="fas fa-heart text-danger"></i> for learners worldwide</span>
                </p>
                <div class="footer-bottom-links">
                    <a href="#privacy">Privacy Policy</a>
                    <a href="#terms">Terms of Service</a>
                    <a href="#cookies">Cookie Policy</a>
                    <a href="#accessibility">Accessibility</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="btn btn-primary rounded-circle shadow d-flex justify-content-center align-items-center" style="position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px; z-index: 1030; display: none; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap 5.3 Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation Library -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<!-- Custom Scripts -->
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Back to Top Button
    const backToTopBtn = document.getElementById('backToTop');

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.style.display = 'block';
        } else {
            backToTopBtn.style.display = 'none';
        }
    });

    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Sidebar Toggle Functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar-modern');
    const sidebar_header = document.querySelector('#refCourse');

    if (sidebarToggle && sidebar) {
        // Load saved state
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            sidebarToggle.innerHTML = '<i class="fas fa-chevron-right"></i>';
            sidebar_header.style.visibility = 'hidden';
        }

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            const collapsed = sidebar.classList.contains('collapsed');

            // Update icon
            sidebarToggle.innerHTML = collapsed ?
                '<i class="fas fa-chevron-right"></i>' :
                '<i class="fas fa-bars"></i>';

            sidebar_header.style.visibility = collapsed ? 'hidden' : 'visible';

            // Save state
            localStorage.setItem('sidebarCollapsed', collapsed);
        });
    }

    // Newsletter Form Handling
    document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;

        // Simple validation
        if (!email || !email.includes('@')) {
            alert('Please enter a valid email address.');
            return;
        }

        // Here you would typically send the email to your backend
        alert('Thank you for subscribing! We\'ll keep you updated with the latest courses.');
        this.reset();
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading animation to forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                submitBtn.disabled = true;
            }
        });
    });

    // Enhanced mobile menu behavior
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const navbarToggler = document.querySelector('.navbar-toggler');

    if (navbarCollapse && navbarToggler) {
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    const collapse = new bootstrap.Collapse(navbarCollapse, {
                        hide: true
                    });
                }
            });
        });
    }

    // Add ripple effect to buttons
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255,255,255,0.3)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.left = (e.offsetX - 10) + 'px';
            ripple.style.top = (e.offsetY - 10) + 'px';
            ripple.style.width = '20px';
            ripple.style.height = '20px';

            //this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>

        </div> <!-- End main-content -->
    </div> <!-- End main-layout-wrapper -->

</body>
</html>
