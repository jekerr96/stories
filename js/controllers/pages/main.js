import {BasePage} from "./base";

const MainPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
        },

        ".js-plus click"(el) {
            el.classList.toggle("active");
            el.closest(".js-genre").querySelector(".js-minus").classList.remove("active");
        },

        ".js-minus click"(el) {
            el.classList.toggle("active");
            el.closest(".js-genre").querySelector(".js-plus").classList.remove("active");
        },
    });

new MainPage(document.querySelector("body"));