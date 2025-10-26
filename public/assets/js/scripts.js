// Back to top button functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get the button
    const backToTopButton = document.querySelector('.btn-light.rounded-circle');
    
    // When the user scrolls down 300px from the top of the document, show the button
    window.onscroll = function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            backToTopButton.style.display = "block";
        } else {
            backToTopButton.style.display = "none";
        }
    };
    
    // When the user clicks on the button, scroll to the top of the document
    backToTopButton.addEventListener('click', function(e) {
        e.preventDefault();
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
    
    // Initialize any Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
