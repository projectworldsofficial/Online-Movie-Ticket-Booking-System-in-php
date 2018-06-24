(function($) {
    $.fn.bootstrapValidator.validators.different = {
        /**
         * Return true if the input value is different with given field's value
         *
         * @param {BootstrapValidator} validator The validator plugin instance
         * @param {jQuery} $field Field element
         * @param {Object} options Consists of the following key:
         * - field: The name of field that will be used to compare with current one
         * @returns {boolean}
         */
        validate: function(validator, $field, options) {
            var value        = $field.val(),
                $compareWith = validator.getFieldElement(options.field);
            if ($compareWith && value != $compareWith.val()) {
                validator.removeError($compareWith);
                return true;
            } else {
                return false;
            }
        }
    };
}(window.jQuery));
