define(['block_dixeo_tutor/constants', 'core/str'], function(constants, str) {
    'use strict';

    /**
     * Accessibility utilities for the tutor
     */
    return {
        /**
         * Create or get live region for announcements
         * @param {string} id Live region ID
         * @param {string} politeness 'polite' or 'assertive'
         * @returns {Element} Live region element
         */
        getLiveRegion(id = 'dixeo-tutor-live-region', politeness = 'polite') {
            let region = document.getElementById(id);

            if (!region) {
                region = document.createElement('div');
                region.id = id;
                region.className = 'sr-only';
                region.setAttribute('aria-live', politeness);
                region.setAttribute('aria-atomic', 'true');
                region.setAttribute('role', 'status');
                document.body.appendChild(region);
            }

            return region;
        },

        /**
         * Announce message to screen readers
         * @param {string} message Message to announce
         * @param {string} politeness 'polite' or 'assertive'
         */
        announce(message, politeness = 'polite') {
            const region = this.getLiveRegion('dixeo-tutor-live-region', politeness);

            // Clear and set message with delay for reliability
            region.textContent = '';
            setTimeout(() => {
                region.textContent = message;
            }, constants.a11y.LIVE_REGION_DELAY);
        },

        /**
         * Set up keyboard navigation for a container
         * @param {Element} container Container element
         * @param {string} itemSelector Selector for navigable items
         */
        setupKeyboardNavigation(container, itemSelector) {
            if (!container) { return; }

            let currentIndex = -1;

            container.addEventListener('keydown', (e) => {
                const items = Array.from(container.querySelectorAll(itemSelector));
                if (items.length === 0) { return; }

                switch (e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        currentIndex = Math.min(currentIndex + 1, items.length - 1);
                        break;

                    case 'ArrowUp':
                        e.preventDefault();
                        currentIndex = Math.max(currentIndex - 1, 0);
                        break;

                    case 'Home':
                        e.preventDefault();
                        currentIndex = 0;
                        break;

                    case 'End':
                        e.preventDefault();
                        currentIndex = items.length - 1;
                        break;

                    case 'Enter':
                    case ' ':
                        if (currentIndex >= 0 && currentIndex < items.length) {
                            e.preventDefault();
                            items[currentIndex].click();
                        }
                        break;

                    default:
                        return;
                }

                if (currentIndex >= 0 && currentIndex < items.length) {
                    items[currentIndex].focus();
                }
            });
        },

        /**
         * Create skip link for keyboard navigation
         * @param {string} targetId ID of target element
         * @param {string} text Link text
         * @returns {Element} Skip link element
         */
        createSkipLink(targetId, text) {
            const link = document.createElement('a');
            link.href = `#${targetId}`;
            link.className = 'skip-link sr-only-focusable';
            link.textContent = text;

            link.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.getElementById(targetId);
                if (target) {
                    target.focus();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });

            return link;
        },

        /**
         * Set up ARIA labels for tutor components
         * @param {object} components Object with component references
         */
        setupARIA(components) {
            if (components.messagesContainer) {
                components.messagesContainer.setAttribute('role', 'log');
                components.messagesContainer.setAttribute('aria-live', 'polite');
                components.messagesContainer.setAttribute('tabindex', '0');
                str.get_string('aria_chat_messages', 'block_dixeo_tutor').then(s => {
                    components.messagesContainer.setAttribute('aria-label', s);
                }).catch(() => {
                    components.messagesContainer.setAttribute('aria-label', 'Chat messages');
                });
            }

            if (components.inputField) {
                components.inputField.setAttribute('aria-required', 'true');
                components.inputField.setAttribute('aria-invalid', 'false');
                str.get_string('aria_type_message', 'block_dixeo_tutor').then(s => {
                    components.inputField.setAttribute('aria-label', s);
                }).catch(() => {
                    components.inputField.setAttribute('aria-label', 'Type your message');
                });
            }

            if (components.sendButton) {
                str.get_string('aria_send_message', 'block_dixeo_tutor').then(s => {
                    components.sendButton.setAttribute('aria-label', s);
                }).catch(() => {
                    components.sendButton.setAttribute('aria-label', 'Send message');
                });
            }
        }
    };
});
