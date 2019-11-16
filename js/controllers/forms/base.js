import 'can-construct-super';
import Control from 'can-control';
import tippy from "tippy.js";
import autosize from "autosize";
import "jquery-validation";
import './helper/validation-extend-method';
import {i18nMessages} from "./helper/validation-message";
i18nMessages(document.documentElement.lang);

/**
 * Базовая форма
 */
const BaseForm  = Control.extend(
    {
        defaults: {

        }
    },
    {
        init() {

            this.$element = $(this.element);
            this.$errors = this.$element.find(".js-errors");

            tippy(".js-error", {
                animation: "scale",
                theme: 'light',
                placement: "bottom",
            });

            autosize(document.querySelectorAll('textarea'));
            this.validate();
        },

        "input, textarea input"(el) {
            el.classList.toggle("filled", !!el.value);
        },

        validate() {
            this.validator = this.$element.validate({
                rules: {
                    password: "required",
                    "repeat-password": {
                        equalTo: ".password"
                    }
                },
                ignore: '[type=hidden], .ignore',
                focusInvalid: true,
                highlight: function (element) {

                }.bind(this),
                unhighlight: function (element) {
                    $(element).closest("label").find(".js-error").remove();

                }.bind(this),
                submitHandler: function () {
                    if (this.$element.valid()) {
                        this.submitForm();
                    } else {
                        this.validator.focusInvalid();
                    }

                }.bind(this),
                errorPlacement: function(error, element) {
                    let $element = $(element);
                    let $label = $element.closest("label");
                    let $error = $label.find(".js-error");
                    if ($error.length) $error.remove();
                    if ($element.hasClass("password") || $element.attr("type") === "password") $label.addClass("password-error");
                    $error = $("<span class='error js-error' data-tippy-content='" + $(error).html() + "'></span>");
                    $label.prepend($error);
                    tippy($error.get(0));
                }.bind(this),
            });
        },

        submitForm() {
            let action = this.element.dataset.action || this.element.action;

            $.ajax({
                url: action,
                type: "POST",
                processData: false,
                contentType: false,
                dataType: this.options.type,
                data: new FormData(this.element),
                success: this.onAjaxSuccess.bind(this)
            });
        },

        onAjaxSuccess(data) {
            if (typeof data == "string") {
                data = JSON.parse(data);
            }

            if (data.errors) {
                this.$errors.html(data.errors);
            }

            if (data.fields) {
                this.validator.showErrors(data.fields);
            }
        }
    },
);

export default BaseForm;