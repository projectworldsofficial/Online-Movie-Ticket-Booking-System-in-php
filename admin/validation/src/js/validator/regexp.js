(function($) {
    $.fn.bootstrapValidator.validators.regexp = {
        /**
         * Check if the element value matches given regular expression
         *
         * @param {BootstrapValidator} validator The validator plugin instance
         * @param {jQuery} $field Field element
         * @param {Object} options Consists of the following key:
         * - regexp: The regular expression you need to check
         * @returns {boolean}
         */
        validate: function(validator, $field, options) {
            var value = $field.val();
            return options.regexp.test(value);
        }
    };
}(window.jQuery));
