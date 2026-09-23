document.documentElement.classList.add('js');

const animatedElements = document.querySelectorAll(
    '.image-slot--intro, .facilities-intro__copy, .facility-card',
);

if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
        (entries, currentObserver) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                currentObserver.unobserve(entry.target);
            });
        },
        { threshold: 0.12 },
    );

    animatedElements.forEach((element) => observer.observe(element));
} else {
    animatedElements.forEach((element) => element.classList.add('is-visible'));
}
