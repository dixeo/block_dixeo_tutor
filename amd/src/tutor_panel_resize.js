define([
    'core/str',
], function(str) {
    'use strict';

    const DEFAULT_VIEWPORT_MARGIN_PX = 48;
    const DEFAULT_MIN_WIDTH_PX = 320;
    const DEFAULT_MEDIA_QUERY = '(min-width: 992px)';
    const HANDLE_CLASS = 'dixeo-tutor-resize-handle';
    const DRAGGING_CLASS = 'dixeo-tutor-resize--dragging';

    /**
     * @param {number} value
     * @param {number} min
     * @param {number} max
     * @return {number}
     */
    const clamp = function(value, min, max) {
        return Math.min(Math.max(value, min), max);
    };

    /**
     * Horizontal resize from the left edge of a right-aligned panel.
     *
     * @param {Object} options
     * @param {HTMLElement} options.panel
     * @param {number} options.defaultWidth
     * @param {number} [options.minWidth]
     * @param {number} [options.initialWidth] Session width to restore (e.g. after drawer close/reopen).
     * @param {number} [options.viewportMarginPx]
     * @param {HTMLElement|null} [options.cssVarTarget]
     * @param {string|null} [options.cssVarName]
     * @param {string|null} [options.panelCssVarName]
     * @param {string} [options.enabledMediaQuery]
     * @return {{destroy: function, reset: function}}
     */
    const createPanelResize = function(options) {
        const panel = options.panel;
        const defaultWidth = options.defaultWidth;
        const minWidth = options.minWidth || DEFAULT_MIN_WIDTH_PX;
        const initialWidth = options.initialWidth ?? defaultWidth;
        const viewportMarginPx = options.viewportMarginPx || DEFAULT_VIEWPORT_MARGIN_PX;
        const cssVarTarget = options.cssVarTarget || null;
        const cssVarName = options.cssVarName || null;
        const panelCssVarName = options.panelCssVarName || null;
        const enabledMediaQuery = options.enabledMediaQuery || DEFAULT_MEDIA_QUERY;

        let currentWidth = initialWidth;
        let dragging = false;
        let mediaQuery = null;
        let ariaLabel = 'Resize panel';

        const handle = document.createElement('div');
        handle.className = HANDLE_CLASS;
        handle.setAttribute('role', 'separator');
        handle.setAttribute('aria-orientation', 'vertical');
        handle.setAttribute('tabindex', '0');
        handle.setAttribute('aria-label', ariaLabel);

        /**
         * @return {number}
         */
        const getMaxWidth = function() {
            return Math.max(minWidth, window.innerWidth - viewportMarginPx);
        };

        /**
         * @param {number} width
         * @return {number}
         */
        const clampWidth = function(width) {
            return clamp(width, minWidth, getMaxWidth());
        };

        /**
         * @param {number} width
         * @return {void}
         */
        const applyWidth = function(width) {
            currentWidth = clampWidth(width);
            const widthPx = currentWidth + 'px';

            if (panelCssVarName) {
                panel.style.setProperty(panelCssVarName, widthPx);
            } else {
                panel.style.width = widthPx;
                panel.style.maxWidth = widthPx;
            }

            if (cssVarTarget && cssVarName) {
                cssVarTarget.style.setProperty(cssVarName, widthPx);
            }

            handle.setAttribute('aria-valuemin', String(minWidth));
            handle.setAttribute('aria-valuemax', String(getMaxWidth()));
            handle.setAttribute('aria-valuenow', String(currentWidth));
        };

        /**
         * @return {boolean}
         */
        const isEnabled = function() {
            return !!mediaQuery && mediaQuery.matches;
        };

        /**
         * @return {void}
         */
        const syncEnabledState = function() {
            if (isEnabled()) {
                handle.hidden = false;
                applyWidth(currentWidth);
            } else {
                handle.hidden = true;
            }
        };

        /**
         * @param {number} clientX
         * @return {number}
         */
        const widthFromPointer = function(clientX) {
            const rect = panel.getBoundingClientRect();
            return rect.right - clientX;
        };

        /**
         * @param {PointerEvent} e
         */
        const onPointerMove = function(e) {
            if (!dragging) {
                return;
            }
            applyWidth(widthFromPointer(e.clientX));
        };

        /**
         * @param {PointerEvent} e
         */
        const onPointerUp = function(e) {
            if (!dragging) {
                return;
            }
            dragging = false;
            document.body.classList.remove(DRAGGING_CLASS);
            if (handle.hasPointerCapture(e.pointerId)) {
                handle.releasePointerCapture(e.pointerId);
            }
        };

        /**
         * @param {PointerEvent} e
         */
        const onHandlePointerDown = function(e) {
            if (!isEnabled() || e.button !== 0) {
                return;
            }
            e.preventDefault();
            dragging = true;
            document.body.classList.add(DRAGGING_CLASS);
            handle.setPointerCapture(e.pointerId);
            applyWidth(widthFromPointer(e.clientX));
        };

        /**
         * @param {KeyboardEvent} e
         */
        const onHandleKeyDown = function(e) {
            if (!isEnabled()) {
                return;
            }
            let delta = 0;
            if (e.key === 'ArrowLeft') {
                delta = 16;
            } else if (e.key === 'ArrowRight') {
                delta = -16;
            } else {
                return;
            }
            e.preventDefault();
            applyWidth(currentWidth + delta);
        };

        const onWindowResize = function() {
            if (!isEnabled()) {
                return;
            }
            applyWidth(currentWidth);
        };

        const onMediaChange = function() {
            syncEnabledState();
        };

        panel.insertBefore(handle, panel.firstChild);

        handle.addEventListener('pointerdown', onHandlePointerDown);
        handle.addEventListener('keydown', onHandleKeyDown);
        window.addEventListener('pointermove', onPointerMove);
        window.addEventListener('pointerup', onPointerUp);
        window.addEventListener('pointercancel', onPointerUp);
        window.addEventListener('resize', onWindowResize);

        mediaQuery = window.matchMedia(enabledMediaQuery);
        if (typeof mediaQuery.addEventListener === 'function') {
            mediaQuery.addEventListener('change', onMediaChange);
        } else {
            mediaQuery.addListener(onMediaChange);
        }

        str.get_string('resize_panel', 'block_dixeo_tutor').then(function(label) {
            ariaLabel = label;
            handle.setAttribute('aria-label', label);
            return null;
        }).catch(function() {
            // Keep default English fallback.
        });

        applyWidth(initialWidth);
        syncEnabledState();

        return {
            getWidth: function() {
                return currentWidth;
            },
            reset: function() {
                if (panelCssVarName) {
                    panel.style.removeProperty(panelCssVarName);
                }
                panel.style.removeProperty('width');
                panel.style.removeProperty('max-width');
                if (cssVarTarget && cssVarName) {
                    cssVarTarget.style.removeProperty(cssVarName);
                }
                currentWidth = defaultWidth;
                if (isEnabled()) {
                    applyWidth(defaultWidth);
                }
            },
            destroy: function() {
                dragging = false;
                document.body.classList.remove(DRAGGING_CLASS);
                handle.removeEventListener('pointerdown', onHandlePointerDown);
                handle.removeEventListener('keydown', onHandleKeyDown);
                window.removeEventListener('pointermove', onPointerMove);
                window.removeEventListener('pointerup', onPointerUp);
                window.removeEventListener('pointercancel', onPointerUp);
                window.removeEventListener('resize', onWindowResize);
                if (mediaQuery) {
                    if (typeof mediaQuery.removeEventListener === 'function') {
                        mediaQuery.removeEventListener('change', onMediaChange);
                    } else {
                        mediaQuery.removeListener(onMediaChange);
                    }
                }
                if (handle.parentNode) {
                    handle.parentNode.removeChild(handle);
                }
                if (panelCssVarName) {
                    panel.style.removeProperty(panelCssVarName);
                }
                panel.style.removeProperty('width');
                panel.style.removeProperty('max-width');
                if (cssVarTarget && cssVarName) {
                    cssVarTarget.style.removeProperty(cssVarName);
                }
            },
        };
    };

    return {
        createPanelResize: createPanelResize,
    };
});
