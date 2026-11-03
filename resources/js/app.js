const NAVIGATION_INDICATOR_KEY = 'netware:navigation-indicator';

const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const header = document.querySelector('[data-header]');

if (header) {
    const syncHeader = () => header.classList.toggle('is-scrolled', window.scrollY > 8);

    syncHeader();
    window.addEventListener('scroll', syncHeader, { passive: true });
}

const navigation = document.querySelector('[data-nav]');
const navigationItems = [...(navigation?.querySelectorAll('[data-nav-item]') ?? [])];
const navigationIndicator = navigation?.querySelector('[data-nav-indicator]');
const activeNavigationItem = () => navigationItems.find((item) => item.hasAttribute('aria-current'));

/**
 * Measure relative to the navigation box instead of offsetLeft, because the
 * items and the indicator do not necessarily share the same offset parent.
 */
const measureNavigationItem = (item) => {
    if (!navigation || !item) {
        return null;
    }

    const navBox = navigation.getBoundingClientRect();
    const itemBox = item.getBoundingClientRect();

    return {
        left: itemBox.left - navBox.left,
        width: itemBox.width,
    };
};

const setIndicatorPosition = (item) => {
    const position = measureNavigationItem(item);

    if (!navigationIndicator || !position) {
        return;
    }

    navigationIndicator.style.left = `${position.left}px`;
    navigationIndicator.style.width = `${position.width}px`;
    navigationIndicator.style.opacity = '1';
};

const previousIndicatorPosition = () => {
    try {
        return JSON.parse(sessionStorage.getItem(NAVIGATION_INDICATOR_KEY) ?? 'null');
    } catch {
        return null;
    }
};

/**
 * Store the position of the selected menu before leaving the page, so the next
 * page can slide the indicator from its previous menu towards the new one.
 */
const rememberIndicatorPosition = () => {
    const position = measureNavigationItem(activeNavigationItem());

    if (!position) {
        return;
    }

    sessionStorage.setItem(
        NAVIGATION_INDICATOR_KEY,
        JSON.stringify({
            path: window.location.pathname,
            left: position.left,
            width: position.width,
        }),
    );
};

if (navigationIndicator && navigationItems.length > 0) {
    const storedPosition = previousIndicatorPosition();
    const startPosition =
        storedPosition && storedPosition.path !== window.location.pathname ? storedPosition : null;

    sessionStorage.removeItem(NAVIGATION_INDICATOR_KEY);

    const syncToActiveItem = () => setIndicatorPosition(activeNavigationItem());

    if (startPosition && !prefersReducedMotion()) {
        navigationIndicator.style.transition = 'none';
        navigationIndicator.style.left = `${startPosition.left}px`;
        navigationIndicator.style.width = `${startPosition.width}px`;
        navigationIndicator.style.opacity = '1';

        // Paint the old position with transitions off, then turn them back on and
        // move, so the browser has two distinct states to animate between.
        void navigationIndicator.offsetWidth;
        navigationIndicator.style.transition = '';
        void navigationIndicator.offsetWidth;

        syncToActiveItem();
    } else {
        syncToActiveItem();
    }

    document.fonts?.ready.then(syncToActiveItem);
    window.addEventListener('load', syncToActiveItem);
    window.addEventListener('pagehide', rememberIndicatorPosition);
    window.addEventListener('resize', syncToActiveItem);
    window.addEventListener('pageshow', (event) => event.persisted && syncToActiveItem());

    // Styles can still land after the first paint (dev server style injection),
    // which changes item widths, so re-measure whenever the nav resizes.
    if ('ResizeObserver' in window) {
        new ResizeObserver(syncToActiveItem).observe(navigation);
    }
}

/* Floating mobile dock: the highlight slides only after a page is opened. */
const DOCK_INDICATOR_KEY = 'netware:dock-indicator';

const dock = document.querySelector('[data-dock]');
const dockItems = [...(dock?.querySelectorAll('[data-dock-item]') ?? [])];
const dockIndicator = dock?.querySelector('[data-dock-indicator]');

if (dock && dockIndicator && dockItems.length > 0) {
    const activeDockItem = () => dockItems.find((item) => item.hasAttribute('aria-current'));

    const measureDockItem = (item) => {
        if (!item) {
            return null;
        }

        const trackBox = dockIndicator.parentElement.getBoundingClientRect();
        const itemBox = item.getBoundingClientRect();

        return { left: itemBox.left - trackBox.left, width: itemBox.width };
    };

    const positionDockIndicator = (item) => {
        const position = measureDockItem(item);

        if (!position) {
            return;
        }

        dockIndicator.style.left = `${position.left}px`;
        dockIndicator.style.width = `${position.width}px`;
        dockIndicator.style.opacity = '1';
    };

    const syncDockIndicator = () => positionDockIndicator(activeDockItem());

    const rememberDockPosition = () => {
        const position = measureDockItem(activeDockItem());

        if (!position) {
            return;
        }

        sessionStorage.setItem(
            DOCK_INDICATOR_KEY,
            JSON.stringify({
                path: window.location.pathname,
                left: position.left,
                width: position.width,
            }),
        );
    };

    const storedDockPosition = (() => {
        try {
            return JSON.parse(sessionStorage.getItem(DOCK_INDICATOR_KEY) ?? 'null');
        } catch {
            return null;
        }
    })();

    sessionStorage.removeItem(DOCK_INDICATOR_KEY);

    const dockStartPosition =
        storedDockPosition && storedDockPosition.path !== window.location.pathname
            ? storedDockPosition
            : null;

    if (dockStartPosition && !prefersReducedMotion()) {
        // Draw the previous page's highlight first, then glide to the new menu.
        dockIndicator.style.transition = 'none';
        dockIndicator.style.left = `${dockStartPosition.left}px`;
        dockIndicator.style.width = `${dockStartPosition.width}px`;
        dockIndicator.style.opacity = '1';

        void dockIndicator.offsetWidth;
        dockIndicator.style.transition = '';
        void dockIndicator.offsetWidth;

        syncDockIndicator();
    } else {
        syncDockIndicator();
    }

    document.fonts?.ready.then(syncDockIndicator);
    window.addEventListener('load', syncDockIndicator);
    window.addEventListener('resize', syncDockIndicator);
    window.addEventListener('pagehide', rememberDockPosition);
    window.addEventListener('pageshow', (event) => event.persisted && syncDockIndicator());

    if ('ResizeObserver' in window) {
        new ResizeObserver(syncDockIndicator).observe(dockIndicator.parentElement);
    }
}

/* Theme switch: the new palette is revealed by a circle growing out of the toggle. */
const themeToggle = document.querySelector('[data-theme-toggle]');

if (themeToggle) {
    const isDark = () => document.documentElement.classList.contains('dark');
    const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const syncThemeState = () => themeToggle.setAttribute('aria-pressed', String(isDark()));

    const storeTheme = (dark) => {
        try {
            localStorage.setItem('netware:theme', dark ? 'dark' : 'light');
        } catch (error) {
            // Storage can be blocked; the current session still switches visually.
        }
    };

    const applyTheme = (dark) => {
        document.documentElement.classList.toggle('dark', dark);
        syncThemeState();
        storeTheme(dark);
    };

    /**
     * Point the CSS circle mask at the toggle and give it a radius that always
     * reaches the farthest corner, so the reveal never stops mid-screen.
     */
    const aimRevealAtToggle = () => {
        const box = themeToggle.getBoundingClientRect();
        const x = box.left + box.width / 2;
        const y = box.top + box.height / 2;
        const radius = Math.hypot(
            Math.max(x, window.innerWidth - x),
            Math.max(y, window.innerHeight - y),
        );

        document.documentElement.style.setProperty('--theme-x', `${x}px`);
        document.documentElement.style.setProperty('--theme-y', `${y}px`);
        document.documentElement.style.setProperty('--theme-radius', `${Math.ceil(radius)}px`);
    };

    syncThemeState();

    themeToggle.addEventListener('click', () => {
        const dark = !isDark();

        if (prefersReducedMotion() || typeof document.startViewTransition !== 'function') {
            applyTheme(dark);

            return;
        }

        aimRevealAtToggle();

        document.documentElement.classList.add('theme-switching');

        const transition = document.startViewTransition(() => applyTheme(dark));

        // Swallow the promise rejection that happens when a new transition
        // interrupts a running one by clicking quickly.
        transition.finished
            .catch(() => {})
            .finally(() => document.documentElement.classList.remove('theme-switching'));
    });
}

/* Language switch: a colour band sweeps down, then the new page keeps scrolling it away. */
const localeForm = document.querySelector('[data-locale-form]');

if (localeForm) {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Coming back from a switch: the band is already covering the viewport
    // (set inline in <head>), so it only has to slide away.
    if (sessionStorage.getItem('netware:locale-switching') === '1') {
        sessionStorage.removeItem('netware:locale-switching');

        const restoreScroll = Number(sessionStorage.getItem('netware:locale-scroll') ?? '0');
        sessionStorage.removeItem('netware:locale-scroll');

        if (restoreScroll > 0) {
            window.scrollTo({ top: restoreScroll, behavior: 'instant' });
        }

        if (!reduceMotion) {
            window.setTimeout(() => {
                delete document.documentElement.dataset.localePhase;
            }, 380);
        } else {
            delete document.documentElement.dataset.localePhase;
        }
    }

    localeForm.addEventListener('submit', (event) => {
        sessionStorage.setItem('netware:locale-switching', '1');
        sessionStorage.setItem('netware:locale-scroll', String(window.scrollY));

        if (reduceMotion) {
            return;
        }

        event.preventDefault();

        document.documentElement.dataset.localePhase = 'out';

        // Submit once the band has covered the viewport.
        window.setTimeout(() => localeForm.submit(), 280);
    });
}

/* Reveal sections as they enter the viewport. */
const revealTargets = [...document.querySelectorAll('[data-reveal]')];

if (revealTargets.length > 0 && !('IntersectionObserver' in window)) {
    revealTargets.forEach((target) => target.classList.add('is-visible'));
} else if (revealTargets.length > 0) {
    const reveal = (target) => target.classList.add('is-visible');
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                reveal(entry.target);
                observer.unobserve(entry.target);
            });
        },
        { rootMargin: '0px 0px -12% 0px', threshold: 0.08 },
    );

    revealTargets.forEach((target) => observer.observe(target));

    // Safety net: anything still hidden shortly after load becomes visible, so a
    // stalled observer can never leave the page blank.
    window.setTimeout(() => revealTargets.forEach((target) => reveal(target)), 1200);
}
