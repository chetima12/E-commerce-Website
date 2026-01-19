document.addEventListener("DOMContentLoaded", function() {
    const fadeEls = document.querySelectorAll('.container');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.2 });

    fadeEls.forEach(el => observer.observe(el));
});