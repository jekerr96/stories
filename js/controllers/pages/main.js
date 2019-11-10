import {BasePage} from "./base";

const MainPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
            this.$element = $(this.element);
            this.$genres = this.$element.find(".js-toggle-genres");
        },

        ".js-plus click"(el) {
            el.classList.toggle("active");
            el.closest(".js-genre").querySelector(".js-minus").classList.remove("active");
        },

        ".js-minus click"(el) {
            el.classList.toggle("active");
            el.closest(".js-genre").querySelector(".js-plus").classList.remove("active");
        },

        ".js-genres-toggle-btn click"(el) {
            el.classList.toggle("active");
            this.$genres.slideToggle();
            console.log("toggle");
        }
    });

new MainPage(document.querySelector("body"));