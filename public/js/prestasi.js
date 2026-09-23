document.documentElement.classList.add('js');

const bars = document.querySelectorAll('.chart-bar b');

if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, currentObserver) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            currentObserver.unobserve(entry.target);
        });
    }, { threshold: 0.25 });

    bars.forEach((bar) => observer.observe(bar));
} else {
    bars.forEach((bar) => bar.classList.add('is-visible'));
}
