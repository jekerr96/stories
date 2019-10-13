import 'can-construct-super';
import Control from 'can-control';
import tippy from "tippy.js";

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
            })
        },
    },
);

export default BaseForm;