import {BasePage} from "./base";
import PushToUrl from "push-data-to-url";

const MainPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
            this.$element = $(this.element);
            this.$genres = this.$element.find(".js-toggle-genres");
            this.pushUrl = new PushToUrl();
            this.$storiesContainer = this.$element.find(".js-list-stories");
        },

        ".js-plus click"(el) {
            el.classList.toggle("active");
            el.closest(".js-genre").querySelector(".js-minus").classList.remove("active");

            let include = this.pushUrl.get("include");
            let exclude = this.pushUrl.get("exclude");
            let search = this.pushUrl.get("q");

            this.pushUrl.removeAll();

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
            }

            if (exclude.length) {
                this.pushUrl.add({key: "exclude", value: exclude});
            }

            if (include.length) {
                this.pushUrl.add({key: "include", value: include});
            }

            if (search) {
                this.pushUrl.add({key: "q", value: search});
            }

            this.getStories();
        },

        ".js-minus click"(el) {
            el.classList.toggle("active");
            el.closest(".js-genre").querySelector(".js-plus").classList.remove("active");

            let exclude = this.pushUrl.get("exclude");
            let include = this.pushUrl.get("include");
            let search = this.pushUrl.get("q");

            this.pushUrl.removeAll();

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
            }

            if (include.length) {
                this.pushUrl.add({key: "include", value: include});
            }

            if (exclude.length) {
                this.pushUrl.add({key: "exclude", value: exclude});
            }

            if (search) {
                this.pushUrl.add({key: "q", value: search});
            }

            this.getStories();
        },

        ".js-search-form submit"(el, ev) {
            ev.preventDefault();
            let exclude = this.pushUrl.get("exclude");
            let include = this.pushUrl.get("include");
            let search = el.querySelector("input").value;
            console.log(search);
            this.pushUrl.removeAll();

            if (search) {
                this.pushUrl.add({key: "q", value: search});
            }

            if (include) {
                this.pushUrl.add({key: "include", value: include});
            }

            if (exclude) {
                this.pushUrl.add({key: "exclude", value: exclude});
            }

            this.getStories();
        },

        ".js-genres-toggle-btn click"(el) {
            el.classList.toggle("active");
            this.$genres.slideToggle();
        },

        getStories() {
            this.$storiesContainer.fadeOut();

            $.ajax({
                url: "/" + location.search,
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
