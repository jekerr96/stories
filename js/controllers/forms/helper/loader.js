/**
 * Инициализация форм
 */

export const initForm = function($element) {
    $element.find('form[data-form-type]').each((i, val) => {
        let form = val;
        let FormController;

        if (form.dataset.formController) return;

        let formType = form.dataset.formType;


        try {
            FormController = require('../' + formType);
        } catch (ex) {
            FormController = require('../base');
        }

        form.dataset.formController = 'true';
        new FormController.default(form);
    });
};
