import './bootstrap';

// ===== Smooth Page Transitions (Fade In / Fade Out) =====
(() => {
    let isNavigating = false;

    function shouldSkipLink(link, href, e) {
        if (!href) return true;
        if (['#', 'javascript:', 'mailto:', 'tel:'].some(s => href.startsWith(s))) return true;
        if (link.target === '_blank' || link.hasAttribute('download')) return true;
        if (link.dataset.noTransition !== undefined) return true;
        if (e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return true;
        try {
            const url = new URL(href, location.origin);
            if (url.origin !== location.origin) return true;
            if (url.pathname === location.pathname && url.search === location.search && url.hash) return true;
        } catch { return true; }
        return false;
    }

    // ── FADE IN: halaman baru muncul ──
    function fadeIn() {
        // Body dimulai opacity:0 (dari inline style di HTML)
        // Kita tambah class 'page-ready' yang akan transisi ke opacity:1
        requestAnimationFrame(() => {
            document.body.classList.add('page-ready');
        });
    }

    // ── FADE OUT: sebelum pindah halaman ──
    function fadeOut(callback) {
        if (isNavigating) return;
        isNavigating = true;

        document.body.classList.add('page-leaving');
        document.body.classList.remove('page-ready');

        // Tunggu transisi selesai, lalu navigasi
        document.body.addEventListener('transitionend', function handler(e) {
            if (e.target !== document.body || e.propertyName !== 'opacity') return;
            document.body.removeEventListener('transitionend', handler);
            callback();
        });

        // Safety fallback kalau transitionend tidak fire
        setTimeout(callback, 400);
    }

    function init() {
        fadeIn();

        // Intercept semua link internal
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (!link) return;
            const href = link.getAttribute('href');
            if (shouldSkipLink(link, href, e)) return;

            e.preventDefault();
            fadeOut(() => { location.href = href; });
        });

        // Form submit juga fade out
        document.addEventListener('submit', () => {
            if (isNavigating) return;
            isNavigating = true;
            document.body.classList.add('page-leaving');
            document.body.classList.remove('page-ready');
        });

        // Browser back/forward (bfcache)
        window.addEventListener('pageshow', (e) => {
            if (e.persisted) {
                isNavigating = false;
                document.body.classList.remove('page-leaving');
                document.body.classList.add('page-ready');
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
