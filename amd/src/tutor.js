define([
    'block_dixeo_tutor/chat_controller',
    'block_dixeo_tutor/chat_state',
    'block_dixeo_tutor/chat_ui',
    'block_dixeo_tutor/chat_api'
], function(ChatController, ChatState, ChatUI, ChatAPI) {
    'use strict';

    /**
     * Move the tutor block out of the drawer into a popup container and add floating toggle button.
     * @param {string} openTooltip Tooltip when tutor is closed.
     * @param {string} hideTooltip Tooltip when tutor is open.
     */
    function initPopup(openTooltip, hideTooltip) {
        const tutorEl = document.getElementById('dixeo-tutor');
        if (!tutorEl) {
            return;
        }
        const blockWrapper = tutorEl.closest('section[data-block="dixeo_tutor"]');
        if (!blockWrapper) {
            return;
        }

        const popupContainer = document.createElement('div');
        popupContainer.id = 'dixeo-tutor-popup-container';
        popupContainer.className = 'dixeo-tutor-popup-container';
        popupContainer.setAttribute('aria-hidden', 'true');
        blockWrapper.parentNode.removeChild(blockWrapper);
        popupContainer.appendChild(blockWrapper);
        document.body.appendChild(popupContainer);

        const openIconHtml = '<i class="fa fa-comment" aria-hidden="true"></i>';
        const closeIconHtml = '<i class="fa fa-times" aria-hidden="true"></i>';

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'dixeo-tutor-popup-btn';
        btn.setAttribute('aria-label', openTooltip);
        btn.title = openTooltip;
        btn.innerHTML = openIconHtml;
        const pageFooter = document.getElementById('page-footer');
        (pageFooter || document.body).appendChild(btn);

        /**
         * Toggle popup visibility and update button icon/tooltip.
         * @param {boolean} open True to show popup, false to hide.
         */
        function setButtonState(open) {
            const visible = open;
            popupContainer.classList.toggle('dixeo-tutor-popup-visible', visible);
            popupContainer.setAttribute('aria-hidden', String(!visible));
            btn.title = visible ? hideTooltip : openTooltip;
            btn.setAttribute('aria-label', visible ? hideTooltip : openTooltip);
            btn.innerHTML = visible ? closeIconHtml : openIconHtml;
        }

        btn.addEventListener('click', function() {
            const visible = popupContainer.classList.contains('dixeo-tutor-popup-visible');
            setButtonState(!visible);
        });

        // Close when clicking the backdrop (container), not when clicking the tutor panel.
        popupContainer.addEventListener('click', function(e) {
            if (e.target === popupContainer) {
                setButtonState(false);
            }
        });

        setButtonState(false);
    }

    return {
        /**
         * Initializes the entire tutor application.
         * @param {number} courseid The ID of the current course.
         * @param {number} userid The ID of the current user.
         * @param {string} [displaymode] 'drawer' or 'popup'. Default 'popup'.
         * @param {string} [openTooltip] Tooltip for opening the tutor (popup mode).
         * @param {string} [hideTooltip] Tooltip for hiding the tutor (popup mode).
         */
        init: function(courseid, userid, displaymode, openTooltip, hideTooltip) {
            const state = new ChatState(courseid, userid);
            const ui = new ChatUI();
            const api = new ChatAPI();
            const controller = new ChatController(state, ui, api);
            controller.initialize();

            if (displaymode === 'popup' && openTooltip && hideTooltip) {
                initPopup(openTooltip, hideTooltip);
            }

            // Detect block removal from the DOM (Moodle Boost AJAX navigation replaces page
            // content without a full reload, leaking polling timers and event listeners).
            const container = document.getElementById('dixeo-tutor');
            if (container) {
                const observer = new MutationObserver(function() {
                    if (!document.body.contains(container)) {
                        controller.destroy();
                        observer.disconnect();
                    }
                });
                observer.observe(document.body, {childList: true, subtree: true});
            }

            // Full page unload — save state and clean up synchronously.
            window.addEventListener('pagehide', function() {
                controller.destroy();
            });
        }
    };
});
