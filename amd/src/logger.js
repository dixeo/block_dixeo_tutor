define([], function() {
    'use strict';

    /**
     * Minimal namespace-based logger.
     * info() is suppressed in production — only error() and warn() are always active.
     * @param {string} namespace Log prefix shown in console output.
     * @returns {object} Logger instance.
     */
    function createLogger(namespace) {
        return {
            error: function(message, data) {
                // eslint-disable-next-line no-console
                console.error('[' + namespace + '] ' + message, data || '');
            },
            warn: function(message, data) {
                // eslint-disable-next-line no-console
                console.warn('[' + namespace + '] ' + message, data || '');
            },
            info: function(message, data) {
                if (window.M?.cfg?.developerdebug) {
                    // eslint-disable-next-line no-console
                    console.log('[' + namespace + '] ' + message, data || '');
                }
            },
            namespace: function(child) {
                return createLogger(namespace + ':' + child);
            }
        };
    }

    return createLogger('Dixeo');
});
