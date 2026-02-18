define([], function() {
    'use strict';

    /**
     * Base error class for tutor-specific errors
     */
    class TutorError extends Error {
        constructor(message, code, details = {}) {
            super(message);
            this.name = this.constructor.name;
            this.code = code;
            this.details = details;
            this.timestamp = new Date().toISOString();
        }

        toJSON() {
            return {
                name: this.name,
                message: this.message,
                code: this.code,
                details: this.details,
                timestamp: this.timestamp,
                stack: this.stack
            };
        }
    }

    /**
     * Network-related errors
     */
    class NetworkError extends TutorError {
        constructor(message, details = {}) {
            super(message, 'NETWORK_ERROR', details);
        }
    }

    /**
     * API response errors
     */
    class APIError extends TutorError {
        constructor(message, statusCode, details = {}) {
            super(message, 'API_ERROR', { ...details, statusCode });
            this.statusCode = statusCode;
        }
    }

    /**
     * Validation errors
     */
    class ValidationError extends TutorError {
        constructor(message, field, details = {}) {
            super(message, 'VALIDATION_ERROR', { ...details, field });
            this.field = field;
        }
    }

    /**
     * Timeout errors
     */
    class TimeoutError extends TutorError {
        constructor(message, timeout, details = {}) {
            super(message, 'TIMEOUT_ERROR', { ...details, timeout });
            this.timeout = timeout;
        }
    }

    return {
        TutorError,
        NetworkError,
        APIError,
        ValidationError,
        TimeoutError
    };
});
