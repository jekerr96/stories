import 'can-construct-super';
import Control from 'can-control';
import tippy from "tippy.js";
import autosize from "autosize";

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

            tippy(".js-error", {
                animation: "scale",
                theme: 'light',
                placement: "bottom",
            });

            autosize(document.querySelectorAll('textarea'));
        },

        "input, textarea input"(el) {
            el.classList.toggle("filled", !!el.value);
        },
    },
);

export default BaseForm;