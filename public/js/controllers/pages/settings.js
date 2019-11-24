import {BasePage} from "./base";
import {initForm} from "../forms/helper/loader";

const SettingsPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
            this.$element = $(this.element);

            initForm(this.$element);
        },
    });

new SettingsPage(document.querySelector("body"));