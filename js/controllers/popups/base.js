import 'can-construct-super';
import Control from 'can-control';
import {initForm} from "../forms/helper/loader";

const PopupBase = Control.extend(
    {
        defaults: {
            closeBtn: '.js-close-btn'
        }
    },
    {
        init: function() {
            this.$element = $(this.element);
            initForm(this.$element);
        },

        '{closeBtn} click'() {
            $.fancybox.close();
        }
    }
);


export default PopupBase;
