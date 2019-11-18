import {BasePage} from "./base";
import JsTabs from 'js-tabs';
import PushDataToUrl from "push-data-to-url";

const ProfilePage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();

            this.myTabs = new JsTabs({
                elm: '.js-tabs'
            });

            this.myTabs.init();

            this.$authorStories = this.$element.find(".js-author-stories");
            this.$authors = this.$element.find(".js-author");
            this.pushUrl = new PushDataToUrl();
        },

        ".js-author click"(el) {
            if (el.classList.contains("active")) return;

            this.$authors.removeClass("active");
            el.classList.add("active");

            $.ajax({
                url: "/ajax/profile/authors/?author=" + el.dataset.id,
                data: "",
                method: "POST",
                success: (data) => {
                    this.$authorStories.html(data);

                    this.pushUrl.add({key: "author", value: el.dataset.id});
                },
            })
        },
    });

new ProfilePage(document.querySelector("body"));