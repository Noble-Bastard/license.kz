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
        root.Form = factory();
    }

}(this, function() {
    'use strict';

    // Constructor //
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    let Form = function (data) {
        if(this == null)
            return;

        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
        this.isSendData = false;
    };

    Form.prototype.install = function (Vue, options) {

    };


    // Methods //

    /**
     * Fetch all relevant data for the form.
     */
    Form.prototype.data = function () {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    };

    /**
     * Fetch all relevant data for the form.
     */
    Form.prototype.formData = function () {
        let data = new FormData();
        for (let property in this.originalData) {
            if (this[property] != null && typeof this[property] != 'undefined') {
                data.append(property, this[property]);
            }
        }
        return data;
    };


    /**
     * Reset the form fields.
     */
    Form.prototype.reset = function () {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    };


    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    Form.prototype.post = function (url) {
        return this.submit('post', url);
    };

    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    Form.prototype.postMultipart = function (url) {
        return this.submitMultipart('post', url);
    };


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    Form.prototype.put = function (url) {
        return this.submit('put', url);
    };


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    Form.prototype.patch = function (url) {
        return this.submit('patch', url);
    };


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    Form.prototype.delete = function (url) {
        return this.submit('delete', url);
    };


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    Form.prototype.submit = function (requestType, url) {
        this.isSendData = true;
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data.errors);

                    reject(error.response.data);
                });
        });
    };


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    Form.prototype.submitMultipart = function (requestType, url) {
        this.isSendData = true;


        return new Promise((resolve, reject) => {
            axios[requestType](url, this.formData(), {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                this.onSuccess(response.data);

                resolve(response.data);
            })
            .catch(error => {
                this.onFail(error.response.data.errors);

                reject(error.response.data);
            });
        });
    };


    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    Form.prototype.onSuccess = function (data) {
        this.isSendData = false;
        this.reset();
    };

    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     */
    Form.prototype.onFail = function (errors) {
        this.isSendData = false;
        this.errors.record(errors);
    };

    Form.prototype.errorsOrSend = function () {
        return this.errors.any() || this.isSendData;
    };


    Form.prototype.resetErrors = function() {
        let $errorList = this.errors.errors;
        this.errors = new Errors();
        this.errors.errors = $errorList;
    };

    return Form;
}));