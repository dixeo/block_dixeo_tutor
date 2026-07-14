define([], function() {
    'use strict';

    /**
     * Minimal namespace-based logger.
     * All levels are gated behind M.cfg.developerdebug.
     * @param {string} namespace Log prefix shown in console output.
     * @returns {object} Logger instance.
     */
    function createLogger(namespace) {
        const canLog = function() {
            return Boolean(window.M?.cfg?.developerdebug);
        };

        return {
            error: function(message, data) {
                if (canLog()) {
                    // eslint-disable-next-line no-console
                    console.error('[' + namespace + '] ' + message, data || '');
                }
            },
            warn: function(message, data) {
                if (canLog()) {
                    // eslint-disable-next-line no-console
                    console.warn('[' + namespace + '] ' + message, data || '');
                }
            },
            info: function(message, data) {
                if (canLog()) {
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
