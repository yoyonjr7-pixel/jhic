document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    if (body) {
        body.classList.add('is-ready');
    }

    const button = document.querySelector('.cta-btn');
    if (button) {
        button.addEventListener('click', () => {
            button.classList.add('is-pressed');
            window.setTimeout(() => button.classList.remove('is-pressed'), 180);
        });
    }
});
