/**
 * Scroll-reveal: one-shot IntersectionObserver for .ui-reveal elements.
 * Respects prefers-reduced-motion (elements stay visible via CSS).
 */
function initScrollReveal() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        document.querySelectorAll('.ui-reveal').forEach((el) => {
            el.classList.add('is-visible');
        });

        return;
    }

    const elements = document.querySelectorAll('.ui-reveal');

    if (elements.length === 0) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target);
            });
        },
        {
            rootMargin: '0px 0px -8% 0px',
            threshold: 0.12,
        },
    );

    elements.forEach((el) => observer.observe(el));
}

document.addEventListener('DOMContentLoaded', initScrollReveal);
