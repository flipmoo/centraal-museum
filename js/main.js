document.addEventListener('DOMContentLoaded', function() {
    // Back to top button functionality
    const backToTopButton = document.querySelector('.back-to-top');
    
    if (backToTopButton) {
        // Initially hide the button
        backToTopButton.style.display = 'none';
        
        // Show/hide the button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.style.display = 'flex';
            } else {
                backToTopButton.style.display = 'none';
            }
        });
        
        // Scroll to top when clicked
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Mobile menu toggle (if needed in the future)
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
        });
    }
    
    // Ticket counter functionality
    const ticketCounters = document.querySelectorAll('.ticket-counter');
    
    ticketCounters.forEach(function(counter) {
        const decrementButton = counter.querySelector('.decrement');
        const incrementButton = counter.querySelector('.increment');
        const input = counter.querySelector('input');
        
        if (decrementButton && incrementButton && input) {
            decrementButton.addEventListener('click', function() {
                if (parseInt(input.value) > 0) {
                    input.value = parseInt(input.value) - 1;
                }
            });
            
            incrementButton.addEventListener('click', function() {
                input.value = parseInt(input.value) + 1;
            });
        }
    });
}); 