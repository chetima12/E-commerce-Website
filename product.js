 document.addEventListener("DOMContentLoaded", function() {
            const cards = document.querySelectorAll('.col');
            cards.forEach((card, i) => {
                setTimeout(() => {
                    card.classList.add('visible');
                }, 200 + i * 150);
            });
        });