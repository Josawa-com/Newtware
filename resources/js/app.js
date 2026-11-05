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
     * Size of the area the browser snapshots for a View Transition.
     *
     * This is not reliably `innerHeight` on a phone: the address bar collapsing
     * changes the visual viewport, and some browsers snapshot the taller layout
     * viewport instead. Taking the largest candidate keeps the circle big enough
     * for whichever one the browser actually used.
     *
     * @returns {{width: number, height: number}}
     */
    const snapshotSize = () => {
        const viewport = window.visualViewport;

        return {
            width: Math.max(
                window.innerWidth || 0,
                document.documentElement.clientWidth || 0,
                viewport ? viewport.width : 0,
            ),
            height: Math.max(
                window.innerHeight || 0,
                document.documentElement.clientHeight || 0,
                viewport ? viewport.height : 0,
            ),
        };
    };

    /**
     * Point the CSS circle mask at the toggle and size it so the reveal always
     * runs fully off-screen.
     *
     * The radius used to be exactly the distance to the farthest corner, which
     * left the bottom-left corner uncovered whenever the real viewport was even
     * a few pixels taller than the measurement: the circle stopped, the old
     * palette stayed visible in that corner, and the page then snapped to the
     * new theme. The headroom below removes that seam.
     */
    const aimRevealAtToggle = () => {
        const box = themeToggle.getBoundingClientRect();
        const { width, height } = snapshotSize();

        // Clamp into the viewport: a sticky header reports stale coordinates on
        // the first frame after a scroll.
        const x = Math.min(Math.max(box.left + box.width / 2, 0), width);
        const y = Math.min(Math.max(box.top + box.height / 2, 0), height);

        const farthestCorner = Math.hypot(
            Math.max(x, width - x),
            Math.max(y, height - y),
        );

        // 15% headroom over the farthest corner, never smaller than the viewport
        // diagonal, plus a small floor. Any of those alone can be a few pixels
        // short on a phone, and a short radius is exactly what leaves the last
        // strip of the old palette sitting in the bottom corner.
        const radius = Math.ceil(
            Math.max(farthestCorner * 1.15, Math.hypot(width, height)) + 24,
        );

        document.documentElement.style.setProperty('--theme-x', `${x}px`);
        document.documentElement.style.setProperty('--theme-y', `${y}px`);
        document.documentElement.style.setProperty('--theme-radius', `${radius}px`);
    };

    syncThemeState();

    let runningTransitions = 0;

    themeToggle.addEventListener('click', () => {
        const dark = !isDark();

        if (prefersReducedMotion() || typeof document.startViewTransition !== 'function') {
            applyTheme(dark);

            return;
        }

        aimRevealAtToggle();

        let themeApplied = false;

        // Several taps in a row overlap their transitions, so the "mute element
        // transitions" flag is reference counted instead of simply toggled.
        runningTransitions += 1;
        document.documentElement.classList.add('theme-switching');

        const releaseSwitchingFlag = () => {
            runningTransitions = Math.max(0, runningTransitions - 1);

            if (runningTransitions === 0) {
                document.documentElement.classList.remove('theme-switching');
            }
        };

        const transition = document.startViewTransition(() => {
            themeApplied = true;
            applyTheme(dark);
        });

        // `ready` rejects whenever the browser skips the animation (background
        // tab, interrupted transition). Attaching a handler keeps that from
        // surfacing as an unhandled rejection in the console.
        transition.ready.catch(() => {});

        // If the browser never runs the update callback at all, the tap must
        // still change the theme instead of doing nothing.
        const themeFallback = window.setTimeout(() => {
            if (!themeApplied) {
                applyTheme(dark);
            }
        }, 400);

        // `finished` rejects when a newer transition interrupts this one, and on
        // some mobile browsers it never settles at all when the page is not being
        // painted. Either way the flag must not stay on, otherwise every element
        // transition on the site stays muted until the next reload.
        // The reveal runs for 1100ms, so the flag has to outlive it; releasing it
        // early would re-enable per-element transitions while the circle is still
        // growing, which is what made the switch look steppy.
        const failsafe = window.setTimeout(releaseSwitchingFlag, 1900);

        transition.finished
            .catch(() => {})
            .finally(() => {
                window.clearTimeout(failsafe);
                window.clearTimeout(themeFallback);
                releaseSwitchingFlag();
            });
    });
}

/* Switch language in the background, then patch the rendered page in place. */
const localeForm = document.querySelector('[data-locale-form]');

if (localeForm) {
    localeForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const submit = localeForm.querySelector('[data-locale-submit]');
        const formData = new FormData(localeForm);

        if (submit) {
            submit.disabled = true;
        }

        fetch(localeForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: 'same-origin',
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('The language could not be changed.');
                }

                return fetch(window.location.href, {
                    headers: { Accept: 'text/html', 'X-Requested-With': 'XMLHttpRequest' },
                    credentials: 'same-origin',
                });
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('The translated page could not be loaded.');
                }

                return response.text();
            })
            .then((html) => {
                const parsed = new DOMParser().parseFromString(html, 'text/html');
                const isDarkTheme = document.documentElement.classList.contains('dark');

                const patchNode = (current, incoming) => {
                    if (current.nodeType !== incoming.nodeType || current.nodeName !== incoming.nodeName) {
                        current.replaceWith(incoming.cloneNode(true));

                        return;
                    }

                    if (current.nodeType === Node.TEXT_NODE || current.nodeType === Node.COMMENT_NODE) {
                        if (current.nodeValue !== incoming.nodeValue) {
                            current.nodeValue = incoming.nodeValue;
                        }

                        return;
                    }

                    if (current.nodeName === 'SCRIPT') {
                        return;
                    }

                    [...current.attributes].forEach(({ name }) => {
                        if (!incoming.hasAttribute(name)) {
                            current.removeAttribute(name);
                        }
                    });

                    [...incoming.attributes].forEach(({ name, value }) => {
                        if (current.getAttribute(name) !== value) {
                            current.setAttribute(name, value);
                        }
                    });

                    const currentChildren = [...current.childNodes];
                    const incomingChildren = [...incoming.childNodes];

                    incomingChildren.forEach((child, index) => {
                        if (currentChildren[index]) {
                            patchNode(currentChildren[index], child);
                        } else {
                            current.append(child.cloneNode(true));
                        }
                    });

                    currentChildren.slice(incomingChildren.length).forEach((child) => child.remove());
                };

                patchNode(document.documentElement, parsed.documentElement);
                document.documentElement.classList.toggle('dark', isDarkTheme);
                document.title = parsed.title;
                document.querySelector('[data-theme-toggle]')?.setAttribute('aria-pressed', String(isDarkTheme));
                setIndicatorPosition(activeNavigationItem());
            })
            .catch((error) => {
                console.error(error);
                window.location.reload();
            })
            .finally(() => {
                const currentSubmit = document.querySelector('[data-locale-submit]');

                if (currentSubmit) {
                    currentSubmit.disabled = false;
                }
            });
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

/*
 * Testimonial card fan.
 *
 * The section is pinned for a while so the animation can own the scroll:
 *
 *   phase 1  the five photos rise from below and stop half-visible
 *   phase 2  each card is pulled up, left to right, and straightened
 *   phase 3  a glow blooms behind the finished fan
 *
 * Progress is a single 0..1 value derived from how far the section has been
 * scrolled through. All the phase maths lives here; the CSS only reads the
 * custom properties this writes.
 */
const testiStage = document.querySelector('[data-testi-stage]');

if (testiStage) {
    const cards = [...testiStage.querySelectorAll('[data-testi-card]')];
    const glow = testiStage.querySelector('[data-testi-glow]');
    const fan = testiStage.querySelector('[data-testi-fan]');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (cards.length > 0 && !reducedMotion) {
        // Roughly 0.85 screens of scroll per card, plus room for the intro and
        // the closing glow. Enough to feel deliberate, not so much that the
        // page feels stuck.
        const steps = cards.length;
        const sectionHeight = () => window.innerHeight * (1 + steps * 0.85 + 0.6);

        const setSectionHeight = () => {
            testiStage.style.minHeight = `${Math.round(sectionHeight())}px`;
        };

        setSectionHeight();
        testiStage.setAttribute('data-ready', '');

        const rise = 0.14;          // share of the timeline used to lift the fan
        const cardSpan = 0.68 / steps; // each card's slice of the pull-up phase
        const glowStart = rise + 0.68;

        let frame = 0;

        const paint = () => {
            frame = 0;

            const rect = testiStage.getBoundingClientRect();
            const travel = testiStage.offsetHeight - window.innerHeight;

            if (travel <= 0) {
                return;
            }

            // 0 when the section's top hits the viewport top, 1 when it has been
            // scrolled all the way through.
            const progress = Math.min(1, Math.max(0, -rect.top / travel));

            // Phase 1: the fan rises. Eased so it settles rather than stops dead.
            const enter = Math.min(1, progress / rise);
            testiStage.style.setProperty('--enter', enter.toFixed(4));

            // Phase 2: cards pull up one by one.
            cards.forEach((card, index) => {
                const start = rise + cardSpan * index;
                const local = Math.min(1, Math.max(0, (progress - start) / cardSpan));
                // Each card spends 78% of its slice travelling and the rest held
                // upright, which is when its caption is readable.
                const lift = Math.min(1, local / 0.78);

                card.style.setProperty('--enter', Math.min(1, enter).toFixed(4));
                card.style.setProperty('--lift', lift.toFixed(4));

                if (lift > 0.82) {
                    card.setAttribute('data-lifted', '');
                } else {
                    card.removeAttribute('data-lifted');
                }
            });

            // Phase 3: the glow blooms once the last card is standing.
            const glowProgress = Math.min(1, Math.max(0, (progress - glowStart) / (1 - glowStart)));
            testiStage.style.setProperty('--glow', glowProgress.toFixed(4));

            if (glow) {
                glow.style.opacity = (glowProgress * 0.9).toFixed(3);
            }

            if (glowProgress >= 1) {
                testiStage.setAttribute('data-complete', '');
            } else {
                testiStage.removeAttribute('data-complete');
            }
        };

        const schedule = () => {
            if (frame !== 0) {
                return;
            }

            frame = window.requestAnimationFrame(paint);
        };

        window.addEventListener('scroll', schedule, { passive: true });
        window.addEventListener('resize', () => {
            setSectionHeight();
            schedule();
        });

        paint();
    } else if (cards.length > 0) {
        // Reduced motion: show the finished fan, no pinning.
        testiStage.removeAttribute('data-ready');
        cards.forEach((card) => card.setAttribute('data-lifted', ''));
    }
}

/*
 * Star picker: clicking the nth star submits n stars.
 *
 * The radios already do this natively; this only adds a live preview on hover so
 * the number of stars is obvious before committing.
 */
const starGroup = document.querySelector('[data-star-group]');

if (starGroup) {
    const inputs = [...starGroup.querySelectorAll('[data-star-input]')];

    const paint = (value) => {
        inputs.forEach((input, index) => {
            const icon = input.parentElement?.querySelector('span svg');
            if (!icon) {
                return;
            }

            icon.classList.toggle('text-netware-amber', index < value);
            icon.classList.toggle('text-slate-300', index >= value);
            icon.classList.toggle('dark:text-slate-700', index >= value);
        });
    };

    inputs.forEach((input, index) => {
        input.addEventListener('change', () => paint(index + 1));
        input.addEventListener('mouseenter', () => paint(index + 1));
    });

    starGroup.addEventListener('mouseleave', () => {
        const checked = inputs.findIndex((input) => input.checked);
        paint(checked >= 0 ? checked + 1 : 0);
    });

    const checked = inputs.findIndex((input) => input.checked);
    paint(checked >= 0 ? checked + 1 : 0);
}

/* Prevent double submits and show a busy label. */
const ratingForm = document.querySelector('[data-rating-form]');

if (ratingForm) {
    ratingForm.addEventListener('submit', () => {
        const submit = ratingForm.querySelector('[data-submit]');

        if (submit) {
            submit.disabled = true;
            submit.classList.add('opacity-60');
        }
    });
}
