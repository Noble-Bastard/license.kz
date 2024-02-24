(function(root, factory) {
    'use strict';

    if (typeof define === 'function' && define.amd) {
        // AMD support.
        define([], factory);
    } else if (typeof exports === 'object') {
        // NodeJS support.
        module.exports = factory();
    } else {
        // Browser global support.
        root.Errors = factory();
    }

}(this, function() {
    'use strict';

    // Constructor //

    var Errors = function() {
        if(this == null)
            return;
        this.errors = {};
    };

    Errors.prototype.install = function (Vue, options) {

    };

    // Methods //

    /**
     * Determine if an errors exists for the given field.
     *
     * @param {string} field
     */
    Errors.prototype.has = function(field) {
        return this.errors.hasOwnProperty(field);
    };


    /**
     * Determine if we have any errors.
     */
    Errors.prototype.any = function() {
        return Object.keys(this.errors).length > 0;
    };


    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    Errors.prototype.get = function(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    };


    /**
     * Record the new errors.
     *
     * @param {object} errors
     */
    Errors.prototype.record = function(errors) {
        this.errors = errors;
    };


    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    Errors.prototype.clear = function(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    };


    return Errors;
}));
