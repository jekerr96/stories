import {BasePage} from "./base";
import PushDataToUrl from "push-data-to-url";

const MainPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
            this.$element = $(this.element);
            this.$genres = this.$element.find(".js-toggle-genres");
            this.pushUrl = new PushDataToUrl();
            this.$storiesContainer = this.$element.find(".js-list-stories");

        },

        ".js-plus click"(el) {
            el.classList.toggle("active");
            el.closest(".js-genre").querySelector(".js-minus").classList.remove("active");

            let include = this.pushUrl.get("include");
            let exclude = this.pushUrl.get("exclude");

            if (!include) include = "";
            if (include) {
                include = include.split(",");
            } else {
                include = [];
            }

            let index = include.indexOf(el.dataset.id);
            if (index !== -1) {
                include.splice(index, 1);
            } else {
                include.push(el.dataset.id);
            }

            if (!exclude) {
                exclude = [];
            } else {
                exclude = exclude.split(",");
            }

            let indexExc = exclude.indexOf(el.dataset.id);

            if (indexExc !== -1) {
                exclude.splice(indexExc, 1);
                this.pushUrl.add({key: "exclude", value: exclude});
            }

            this.pushUrl.remove("page");
            this.pushUrl.add({key: "include", value: include});

            this.getStories();

        },

        ".js-minus click"(el) {
            el.classList.toggle("active");
            el.closest(".js-genre").querySelector(".js-plus").classList.remove("active");

            let exclude = this.pushUrl.get("exclude");
            let include = this.pushUrl.get("include");

            if (!exclude) exclude = "";
            if (exclude) {
                exclude = exclude.split(",");
            } else {
                exclude = [];
            }

            let index = exclude.indexOf(el.dataset.id);
            if (index !== -1) {
                exclude.splice(index, 1);
            } else {
                exclude.push(el.dataset.id);
            }

            if (!include) {
                include = [];
            } else {
                include = include.split(",");
            }

            let indexExc = include.indexOf(el.dataset.id);

            if (indexExc !== -1) {
                include.splice(indexExc, 1);
                this.pushUrl.add({key: "include", value: include});
            }

            this.pushUrl.remove("page");
            this.pushUrl.add({key: "exclude", value: exclude});

            this.getStories();
        },

        ".js-genres-toggle-btn click"(el) {
            el.classList.toggle("active");
            this.$genres.slideToggle();
        },

        getStories() {
            let urlParams = new URLSearchParams(window.location.search);
            this.$storiesContainer.fadeOut();

            $.ajax({
                url: this.$storiesContainer.data("url") + "?" + urlParams.toString(),
                method: "post",
                processData: false,
                success: (data) => {
                    this.$storiesContainer.html(data).stop(true, true).fadeIn();
                },
                error: (data) => {
                    this.$storiesContainer.stop(true, true).fadeIn();
                }
            });
        }
    });

new MainPage(document.querySelector("body"));