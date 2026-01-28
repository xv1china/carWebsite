// Scroll to Top Button
(function() {
    'use strict';
    
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    if (scrollToTopBtn) {
        // Show/hide button on scroll
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });
        
        // Smooth scroll to top
        scrollToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // Contact form on homepage
    const homeContactForm = document.getElementById('homeContactForm');
    if (homeContactForm) {
        homeContactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (!this.checkValidity()) {
                this.classList.add('was-validated');
                return;
            }
            
            // Here you would normally send the form data to a server
            const alertDiv = document.getElementById('homeFormAlert');
            if (alertDiv) {
                alertDiv.className = 'alert alert-success';
                alertDiv.textContent = 'თქვენი შეტყობინება წარმატებით გაიგზავნა! ჩვენ დაგიკავშირდებით მალე.';
                alertDiv.classList.remove('d-none');
                this.reset();
                this.classList.remove('was-validated');
                
                // Scroll to alert
                alertDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }, false);
    }
    
    // Add loading state to images
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        img.style.transition = 'opacity 0.3s';
        if (img.complete) {
            img.style.opacity = '1';
        } else {
            img.style.opacity = '0';
        }
    });
    
    // Scroll animations using Intersection Observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Unobserve after animation to improve performance
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe elements with animation classes
    document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right, .scale-in').forEach(el => {
        observer.observe(el);
    });
    
    // Auto-add fade-in class to common elements if not already present
    const autoAnimateSelectors = [
        '.card',
        '.service-card',
        '.blog-card',
        '.gallery-item',
        '.testimonial-card',
        'section > .container > h2',
        'section > .container > .row > .col'
    ];
    
    autoAnimateSelectors.forEach(selector => {
        document.querySelectorAll(selector).forEach((el, index) => {
            // Only add if element doesn't already have an animation class
            if (!el.classList.contains('fade-in') && 
                !el.classList.contains('fade-in-left') && 
                !el.classList.contains('fade-in-right') && 
                !el.classList.contains('scale-in')) {
                el.classList.add('fade-in');
                // Add staggered delay for cards in rows
                if (index % 4 < 4) {
                    el.classList.add(`fade-in-delay-${(index % 4) + 1}`);
                }
                observer.observe(el);
            }
        });
    });
})();

function seeMore1()
{
    let span = document.getElementById("see-more-span-1");
    let button = document.getElementById("seeMore1");
    if(span.classList.contains("d-none"))
    {
        span.classList.remove("d-none")
        button.innerText = "ნაკლები"
    }
    else{
        span.classList.add("d-none")
        button.innerText = "მეტი"

    }
}
function seeMore2()
{
    let span = document.getElementById("see-more-span-2");
    let button = document.getElementById("seeMore2");
    if(span.classList.contains("d-none"))
    {
        span.classList.remove("d-none")
        button.innerText = "ნაკლები"
    }
    else{
        span.classList.add("d-none")
        button.innerText = "მეტი"

    }
}