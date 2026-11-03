const NAVIGATION_INDICATOR_KEY = 'netware:navigation-indicator';

const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const navigationToggle = document.querySelector('[data-nav-toggle]');
const mobileNavigation = document.getElementById('mobile-navigation');

navigationToggle?.addEventListener('click', () => {
    const isExpanded = navigationToggle.getAttribute('aria-expanded') === 'true';

    navigationToggle.setAttribute('aria-expanded', String(!isExpanded));
    mobileNavigation?.classList.toggle('hidden', isExpanded);
});

const navigation = document.querySelector('[data-nav]');
const navigationItems = [...(navigation?.querySelectorAll('[data-nav-item]') ?? [])];
const navigationIndicator = navigation?.querySelector('[data-nav-indicator]');
const activeNavigationItem = () => navigationItems.find((item) => item.hasAttribute('aria-current'));

const setIndicatorPosition = (item) => {
    if (!navigationIndicator || !item) {
        return;
    }

    navigationIndicator.style.left = `${item.offsetLeft}px`;
    navigationIndicator.style.width = `${item.offsetWidth}px`;
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
    const activeItem = activeNavigationItem();

    if (!activeItem) {
        return;
    }

    sessionStorage.setItem(
        NAVIGATION_INDICATOR_KEY,
        JSON.stringify({
            path: window.location.pathname,
            left: activeItem.offsetLeft,
            width: activeItem.offsetWidth,
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
    window.addEventListener('pagehide', rememberIndicatorPosition);
    window.addEventListener('resize', syncToActiveItem);
    window.addEventListener('pageshow', (event) => event.persisted && syncToActiveItem());
}
