(function($) {
    $.fn.bootstrapValidator.validators.remote = {
        /**
         * Request a remote server to check the input value
         *
         * @param {BootstrapValidator} validator Plugin instance
         * @param {jQuery} $field Field element
         * @param {Object} options Can consist of the following keys:
         * - url
         * - data [optional]: By default, it will take the value
         *  {
         *      <fieldName>: <fieldValue>
         *  }
         * - message: The invalid message
         * @returns {string}
         */
        validate: function(validator, $field, options) {
            var value = $field.val(), name = $field.attr('name'), data = options.data;
            if (data == null) {
                data = {};
            }
            data[name] = value;
            var xhr = $.ajax({
                type: 'POST',
                url: options.url,
                dataType: 'json',
                data: data
            }).success(function(response) {
                var isValid =  response.valid === true || response.valid === 'true';
                validator.completeRequest($field, 'remote', isValid);
            });
            validator.startRequest($field, 'remote', xhr);

            return 'pending';
        }
    };
}(window.jQuery));
