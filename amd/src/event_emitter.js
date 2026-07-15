define([], function() {
    'use strict';

    return class EventEmitter extends EventTarget {
        constructor() {
            super();
            // Private Map to track all registered listeners for complete cleanup.
            this._listeners = new Map();
        }

        /**
         * Registers an event listener for a given event type.
         * @param {string} type The event type to listen for.
         * @param {Function} listener The callback function to execute.
         */
        on(type, listener) {
            // Creates a wrapper function to extract the 'detail' property from the CustomEvent.
            const wrapper = e => listener(e.detail);
            // Stores a reference to the wrapper on the original listener for easy removal.
            listener._dixeoWrapper = wrapper;
            this.addEventListener(type, wrapper);

            // Track this listener for complete cleanup.
            if (!this._listeners.has(type)) {
                this._listeners.set(type, new Map());
            }
            this._listeners.get(type).set(listener, wrapper);
        }

        /**
         * Removes an event listener for a given event type.
         * @param {string} type The event type.
         * @param {Function} listener The original listener function that was registered.
         */
        off(type, listener) {
            // Retrieves the wrapper function stored during 'on', or uses the listener itself.
            const wrapper = listener._dixeoWrapper || listener;
            this.removeEventListener(type, wrapper);

            // Remove from tracking map.
            if (this._listeners.has(type)) {
                this._listeners.get(type).delete(listener);
                // Clean up empty type entries.
                if (this._listeners.get(type).size === 0) {
                    this._listeners.delete(type);
                }
            }
        }

        /**
         * Dispatches an event of a given type.
         * @param {string} type The event type to dispatch.
         * @param {*} [detail=null] The data to pass with the event.
         */
        emit(type, detail = null) {
            this.dispatchEvent(new CustomEvent(type, {detail}));
        }

        /**
         * Removes all event listeners that were registered with on().
         * This helps prevent memory leaks when destroying components.
         */
        removeAllListeners() {
            this._listeners.forEach((listenersMap, type) => {
                // eslint-disable-next-line no-unused-vars
                listenersMap.forEach((wrapper, originalListener) => {
                    this.removeEventListener(type, wrapper);
                });
            });

            this._listeners.clear();
        }
    };
});
