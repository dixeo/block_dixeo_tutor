define([
    'block_dixeo_tutor/chat_controller',
    'block_dixeo_tutor/chat_state',
    'block_dixeo_tutor/chat_ui',
    'block_dixeo_tutor/chat_api'
], function(ChatController, ChatState, ChatUI, ChatAPI) {
    'use strict';

    return {
        /**
         * Initializes the entire tutor application.
         * @param {number} courseid The ID of the current course.
         * @param {number} userid The ID of the current user.
         */
        init: function(courseid, userid) {
            const state = new ChatState(courseid, userid);
            const ui = new ChatUI();
            const api = new ChatAPI();
            const controller = new ChatController(state, ui, api);
            controller.initialize();

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
