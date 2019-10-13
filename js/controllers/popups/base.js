import 'can-construct-super';
import Control from 'can-control';
import {initForm} from "../forms/helper/loader";

/**
 * Стандартный контроллер для попапов, с минимально-достаточным функционалом
 * Для более сложных попапов можно наследоваться от этого контроллера
 * Контроллеры попапов подключаются автоматически при открытии со стандартными настройками fancybox из Helper'a
 **/

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
