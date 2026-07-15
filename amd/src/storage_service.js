define(['block_dixeo_tutor/memory_storage_adapter'], function(MemoryStorageAdapter) {
    'use strict';

    /**
     * Lightweight localStorage wrapper with namespace and expiry support.
     * Falls back to an in-memory store when localStorage is unavailable.
     *
     * Used only for non-sensitive technical state (e.g. poll checkpoints).
     * Message draft bodies must not be written here.
     */
    class StorageService {
        constructor(prefix) {
            this.prefix = prefix || 'dixeo_tutor_';
            this.storage = this._getStorage();
            this._clearLegacyDrafts();
        }

        /**
         * Remove draft keys left by older builds that persisted message text,
         * and drop interim sessionStorage poll keys from the sessionStorage-only build.
         * Leaves localStorage poll checkpoints intact for cross-tab sync.
         * @private
         */
        _clearLegacyDrafts() {
            const clearDraftKeys = (store) => {
                try {
                    for (let i = store.length - 1; i >= 0; i--) {
                        const key = store.key(i);
                        if (key && key.startsWith('dixeo_tutor_') && key.endsWith('_draft')) {
                            store.removeItem(key);
                        }
                    }
                } catch (e) {
                    // Ignore unavailable storage.
                }
            };
            clearDraftKeys(localStorage);
            try {
                clearDraftKeys(sessionStorage);
                // Interim build stored poll checkpoints in sessionStorage; remove those leftovers.
                for (let i = sessionStorage.length - 1; i >= 0; i--) {
                    const key = sessionStorage.key(i);
                    if (key && key.startsWith('dixeo_tutor_') && key.endsWith('_polling')) {
                        sessionStorage.removeItem(key);
                    }
                }
            } catch (e) {
                // Ignore.
            }
        }

        /**
         * Test localStorage availability and fall back to in-memory storage.
         * @private
         * @returns {Storage|object} Storage backend.
         */
        _getStorage() {
            try {
                const key = '__dixeo_tutor_test__';
                localStorage.setItem(key, 'x');
                localStorage.removeItem(key);
                return localStorage;
            } catch (e) {
                return MemoryStorageAdapter.create();
            }
        }

        /**
         * @param {string} key Base key.
         * @returns {string} Prefixed key.
         * @private
         */
        _getKey(key) {
            return this.prefix + key;
        }

        /**
         * Returns the full prefixed key for cross-tab localStorage event matching.
         * @param {string} key Base key.
         * @returns {string} Prefixed key.
         */
        getFullKey(key) {
            return this._getKey(key);
        }

        /**
         * Retrieves a value from storage. Returns defaultValue if missing or expired.
         * @param {string} key Storage key.
         * @param {*} defaultValue Fallback value.
         * @returns {*} Stored value or defaultValue.
         */
        get(key, defaultValue) {
            try {
                const stored = this.storage.getItem(this._getKey(key));
                if (!stored) {
                    return arguments.length > 1 ? defaultValue : null;
                }
                const data = JSON.parse(stored);
                if (data.expiry && Date.now() > data.expiry) {
                    this.remove(key);
                    return arguments.length > 1 ? defaultValue : null;
                }
                return data.value;
            } catch (e) {
                return arguments.length > 1 ? defaultValue : null;
            }
        }

        /**
         * Stores a value.
         * @param {string} key Storage key.
         * @param {*} value Value to store.
         * @param {object} [options] Options object.
         * @param {number} [options.expiry] Absolute expiry timestamp in milliseconds.
         */
        set(key, value, options) {
            const data = {
                value: value,
                timestamp: Date.now(),
                expiry: (options && options.expiry) || null
            };
            this.storage.setItem(this._getKey(key), JSON.stringify(data));
        }

        /**
         * Removes a single key.
         * @param {string} key Storage key.
         */
        remove(key) {
            this.storage.removeItem(this._getKey(key));
        }

        /**
         * Removes all keys belonging to this namespace prefix.
         */
        clear() {
            for (let i = this.storage.length - 1; i >= 0; i--) {
                const k = this.storage.key(i);
                if (k && k.startsWith(this.prefix)) {
                    this.storage.removeItem(k);
                }
            }
        }

        /**
         * Creates a child StorageService scoped to a sub-namespace.
         * @param {string} ns Namespace segment appended to the current prefix.
         * @returns {StorageService} Child instance.
         */
        namespace(ns) {
            return new StorageService(this.prefix + ns + '_');
        }
    }

    // AMD modules are singletons — no custom getInstance() needed.
    return new StorageService();
});
