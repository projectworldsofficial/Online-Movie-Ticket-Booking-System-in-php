(function($) {
    $.fn.bootstrapValidator.validators.digits = {
        /**
         * Return true if the input value contains digits only
         *
         * @param {BootstrapValidator} validator Validate plugin instance
         * @param {jQuery} $field Field element
         * @param {Object} options
         * @returns {boolean}
         */
        validate: function(validator, $field, options) {
            return /^\d+$/.test($field.val());
        }
    }
}(window.jQuery));
