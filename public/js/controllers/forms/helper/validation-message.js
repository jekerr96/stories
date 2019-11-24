/**
 * Init i18nMessages messages for import 'jquery-validation'. Based on 'jquery-validation/dist/localization/messages_ru'
 * @param lang
 */
export const i18nMessages = (lang) => {
    switch (lang) {
        case 'ru':
            $.extend($.validator.messages, {
                required:    "Пожалуйста, заполните это поле",
                remote:      "Введите правильное значение",
                email:       "Введите корректный email",
                customEmail: "Введите корректный адрес электронной почты",
                phone:       "Пожалуйста, заполните это поле",
                url:         "Введите корректный URL",
                date:        "Введите корректную дату",
                dateISO:     "Введите корректную дату в формате ISO",
                number:      "Введите число",
                digits:      "Введите только цифры",
                creditcard:  "Введите правильный номер кредитной карты",
                equalTo:     "Введите такое же значение ещё раз",
                extension:   "Загрузите изображение",
                maxlength:   $.validator.format("Введите не больше {0} символов"),
                minlength:   $.validator.format("Введите не менее {0} символов"),
                rangelength: $.validator.format("Введите значение длиной от {0} до {1} символов"),
                range:       $.validator.format("Введите число от {0} до {1}"),
                max:         $.validator.format("Введите число меньше {0}"),
                min:         $.validator.format("Введите число больше {0}"),
                notEqual:    "Значения должны отличаться",
            });
            break;
    }
};
