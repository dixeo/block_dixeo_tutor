define([
    'block_dixeo_tutor/constants',
    'block_dixeo_tutor/storage_service'
], function(constants, StorageService) {
    'use strict';

    return class ChatState {
        constructor(courseid, userid) {
            this.courseid = courseid;
            this.userid = userid;
            this.pending = false;
            this.lastRenderedId = null;
            this.storage = StorageService.namespace(`${userid}_${courseid}`);
        }

        getCourseId() {
            return this.courseid;
        }

        isPending() {
            return this.pending;
        }

        setPending(pending) {
            this.pending = pending;
        }

        getLastRenderedId() {
            return this.lastRenderedId;
        }

        setLastRenderedId(id) {
            this.lastRenderedId = id;
        }

        getDraft() {
            return this.storage.get('draft', '');
        }

        setDraft(message) {
            this.storage.set('draft', message, {
                expiry: Date.now() + constants.polling.STATE_EXPIRY_MS
            });
        }

        clearDraft() {
            this.storage.remove('draft');
        }

        savePollState(state) {
            this.storage.set('polling', state, {
                expiry: Date.now() + constants.polling.STATE_EXPIRY_MS
            });
        }

        getPollState() {
            return this.storage.get('polling', null);
        }

        clearPollState() {
            this.storage.remove('polling');
        }

        /**
         * Get the full localStorage key for the polling state (for cross-tab event matching).
         * @returns {string} The full prefixed key.
         */
        getPollingStorageKey() {
            return this.storage.getFullKey('polling');
        }

        clearAll() {
            this.storage.clear();
        }

        destroy() {
            this.clearAll();
            this.storage = null;
        }
    };
});
