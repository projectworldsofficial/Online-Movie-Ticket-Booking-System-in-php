/**
 * BootstrapValidator (https://github.com/nghuuphuoc/bootstrapvalidator)
 *
 * A jQuery plugin to validate form fields. Use with Bootstrap 3
 *
 * @author      Nguyen Huu Phuoc <phuoc@huuphuoc.me>
 * @copyright   (c) 2013 Nguyen Huu Phuoc
 * @license     MIT
 */

(function($) {
    var BootstrapValidator = function(form, options) {
        this.$form   = $(form);
        this.options = $.extend({}, BootstrapValidator.DEFAULT_OPTIONS, options);

        if ('disabled' == this.options.live) {
            // Don't disable the submit buttons if the live validating is disabled
            this.options.submitButtons = null;
        }

        this.invalidFields      = {};
        this.xhrRequests        = {};
        this.numPendingRequests = null;
        this.formSubmited       = false;

        this._init();
    };

    // The default options
    BootstrapValidator.DEFAULT_OPTIONS = {
        // The form CSS class
        elementClass: 'bootstrap-validator-form',

        // Default invalid message
        message: 'This value is not valid',

        // The submit buttons selector
        // These buttons will be disabled when the form input are invalid
        submitButtons: 'button[type="submit"]',

        // The custom submit handler
        // It will prevent the form from the default submitting
        //
        //  submitHandler: function(validator, form) {
        //      - validator is the BootstrapValidator instance
        //      - form is the jQuery object present the current form
        //  }
        submitHandler: null,

        // Live validating. Can be one of 3 values:
        // - enabled: The plugin validates fields as soon as they are changed
        // - disabled: Disable the live validating. The error messages are only shown after the form is submitted
        // - submitted: The live validating is enabled after the form is submitted
        live: 'enabled',

        // Map the field name with validator rules
        fields: null
    };

    BootstrapValidator.prototype = {
        constructor: BootstrapValidator,

        /**
         * Init form
         */
        _init: function() {
            if (this.options.fields == null) {
                return;
            }

            var that = this;
            this.$form
                // Disable client side validation in HTML 5
                .attr('novalidate', 'novalidate')
                .addClass(this.options.elementClass)
                .on('submit', function(e) {
                    that.formSubmited = true;
                    if (that.options.fields) {
                        for (var field in that.options.fields) {
                            if (that.numPendingRequests > 0 || that.numPendingRequests == null) {
                                // Check if the field is valid
                                var $field = that.getFieldElement(field);
                                if ($field.data('bootstrapValidator.isValid') !== true) {
                                    that.validateField(field);
                                }
                            }
                        }
                        if (!that.isValid()) {
                            that.$form.find(that.options.submitButtons).attr('disabled', 'disabled');
                            if ('submitted' == that.options.live) {
                                that.options.live = 'enabled';
                                that._setLiveValidating();
                            }

                            e.preventDefault();
                        } else {
                            if (that.options.submitHandler && 'function' == typeof that.options.submitHandler) {
                                that.options.submitHandler.call(that, that, that.$form);
                                return false;
                            }
                        }
                    }
                });

            for (var field in this.options.fields) {
                this._initField(field);
            }

            this._setLiveValidating();
        },

        /**
         * Enable live validating
         */
        _setLiveValidating: function() {
            if ('enabled' == this.options.live) {
                var that = this;
                // Since this should be called once, I have to disable the live validating mode
                this.options.live = 'disabled';

                for (var field in this.options.fields) {
                    (function(field) {
                        var $field = that.getFieldElement(field);
                        if ($field) {
                            var type  = $field.attr('type'),
                                event = ('checkbox' == type || 'radio' == type || 'SELECT' == $field.get(0).tagName) ? 'change' : 'keyup';
                            $field.on(event, function() {
                                that.formSubmited = false;
                                that.validateField(field);
                            });
                        }
                    })(field);
                }
            }
        },

        /**
         * Init field
         *
         * @param {String} field The field name
         */
        _initField: function(field) {
            if (this.options.fields[field] == null || this.options.fields[field].validators == null) {
                return;
            }

            var $field = this.getFieldElement(field);
            if (null == $field) {
                return;
            }

            // Create a help block element for showing the error
            var that      = this,
                $parent   = $field.parents('.form-group'),
                helpBlock = $parent.find('.help-block');

            if (helpBlock.length == 0) {
                var $small = $('<small/>').addClass('help-block').css('display', 'none').appendTo($parent);
                $field.data('bootstrapValidator.error', $small);

                // Calculate the number of columns of the label/field element
                // Then set offset to the help block element
                var label, cssClasses, offset, size;
                if (label = $parent.find('label').get(0)) {
                    cssClasses = $(label).attr('class').split(' ');
                    for (var i = 0; i < cssClasses.length; i++) {
                        if (/^col-(xs|sm|md|lg)-\d+$/.test(cssClasses[i])) {
                            offset = cssClasses[i].substr(7);
                            size   = cssClasses[i].substr(4, 2);
                            break;
                        }
                    }
                } else {
                    cssClasses = $parent.children().eq(0).attr('class').split(' ');
                    for (var i = 0; i < cssClasses.length; i++) {
                        if (/^col-(xs|sm|md|lg)-offset-\d+$/.test(cssClasses[i])) {
                            offset = cssClasses[i].substr(14);
                            size   = cssClasses[i].substr(4, 2);
                            break;
                        }
                    }
                }
                if (size && offset) {
                    $small.addClass(['col-', size, '-offset-', offset].join(''))
                          .addClass(['col-', size, '-', 12 - offset].join(''));
                }
            } else {
                $field.data('bootstrapValidator.error', helpBlock.eq(0));
            }
        },

        /**
         * Get field element
         *
         * @param {String} field The field name
         * @returns {jQuery}
         */
        getFieldElement: function(field) {
            var fields = this.$form.find('[name="' + field + '"]');
            return (fields.length == 0) ? null : $(fields[0]);
        },

        /**
         * Validate given field
         *
         * @param {String} field The field name
         */
        validateField: function(field) {
            var $field = this.getFieldElement(field);
            if (null == $field) {
                // Return if cannot find the field with given name
                return;
            }
            var that       = this,
                validators = that.options.fields[field].validators;
            for (var validatorName in validators) {
                if (!$.fn.bootstrapValidator.validators[validatorName]) {
                    continue;
                }
                var isValid = $.fn.bootstrapValidator.validators[validatorName].validate(that, $field, validators[validatorName]);
                if (isValid === false) {
                    that.showError($field, validatorName);
                    break;
                } else if (isValid === true) {
                    that.removeError($field);
                }
            }
        },

        /**
         * Show field error
         *
         * @param {jQuery} $field The field element
         * @param {String} validatorName
         */
        showError: function($field, validatorName) {
            var field     = $field.attr('name'),
                validator = this.options.fields[field].validators[validatorName],
                message   = validator.message || this.options.message,
                $parent   = $field.parents('.form-group');

            this.invalidFields[field] = true;

            // Add has-error class to parent element
            $parent.removeClass('has-success').addClass('has-error');

            $field.data('bootstrapValidator.error').html(message).show();

            this.$form.find(this.options.submitButtons).attr('disabled', 'disabled');
        },

        /**
         * Remove error from given field
         *
         * @param {jQuery} $field The field element
         */
        removeError: function($field) {
            delete this.invalidFields[$field.attr('name')];
            $field.parents('.form-group').removeClass('has-error').addClass('has-success');
            $field.data('bootstrapValidator.error').hide();
            this.$form.find(this.options.submitButtons).removeAttr('disabled');
        },

        /**
         * Start remote checking
         *
         * @param {jQuery} $field The field element
         * @param {String} validatorName
         * @param {XMLHttpRequest} xhr
         */
        startRequest: function($field, validatorName, xhr) {
            var field = $field.attr('name');

            $field.data('bootstrapValidator.isValid', false);
            this.$form.find(this.options.submitButtons).attr('disabled', 'disabled');

            if(this.numPendingRequests == null){
                this.numPendingRequests = 0;
            }
            this.numPendingRequests++;
            // Abort the previous request
            if (!this.xhrRequests[field]) {
                this.xhrRequests[field] = {};
            }

            if (this.xhrRequests[field][validatorName]) {
                this.numPendingRequests--;
                this.xhrRequests[field][validatorName].abort();
            }
            this.xhrRequests[field][validatorName] = xhr;
        },

        /**
         * Complete remote checking
         *
         * @param {jQuery} $field The field element
         * @param {String} validatorName
         * @param {boolean} isValid
         */
        completeRequest: function($field, validatorName, isValid) {
            if (isValid === false) {
                this.showError($field, validatorName);
            } else if (isValid === true) {
                this.removeError($field);
                $field.data('bootstrapValidator.isValid', true);
            }

            var field = $field.attr('name');

            delete this.xhrRequests[field][validatorName];

            this.numPendingRequests--;
            if (this.numPendingRequests <= 0) {
                this.numPendingRequests = 0;
                if (this.formSubmited) {
                    if (this.options.submitHandler && 'function' == typeof this.options.submitHandler) {
                        this.options.submitHandler.call(this, this, this.$form);
                    } else {
                        this.$form.submit();
                    }
                }
            }
        },

        /**
         * Check the form validity
         *
         * @returns {boolean}
         */
        isValid: function() {
            if (this.numPendingRequests > 0) {
                return false;
            }
            for (var field in this.invalidFields) {
                if (this.invalidFields[field]) {
                    return false;
                }
            }
            return true;
        }
    };

    // Plugin definition
    $.fn.bootstrapValidator = function(options) {
        return this.each(function() {
            var $this = $(this), data = $this.data('bootstrapValidator');
            if (!data) {
                $this.data('bootstrapValidator', (data = new BootstrapValidator(this, options)));
            }
        });
    };

    // Available validators
    $.fn.bootstrapValidator.validators = {};

    $.fn.bootstrapValidator.Constructor = BootstrapValidator;
}(window.jQuery));
