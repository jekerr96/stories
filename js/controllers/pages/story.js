import {BasePage} from "./base";
import "select2";
import autosize from "autosize";

const StoryPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
            this.textContainer = this.element.querySelector(".js-text-container");
            this.initSelect();
            autosize(document.querySelectorAll('textarea'));
        },

        ".js-vote mousemove"(el, ev) {
            let stars = 5;
            let line = el.querySelector(".js-line-vote");
            // width += width / stars * 2;
            let elWidth = el.offsetWidth;
            let percent = ev.offsetX / elWidth * 100;
            let width = (Math.ceil(percent/10)*10);

            line.style.width = width + "%";
        },

        initSelect() {
            this.element.querySelectorAll(".js-select").forEach((el) => {
               $(el).select2({
                   width: "70",
                   minimumResultsForSearch: "-1",
                   theme: "orange"
               });

               if (this.textContainer) {
                   $(el).on("select2:select", (ev) => {
                       this.textContainer.style.fontSize = ev.params.data.id + "%";
                   });
               }
            });
        }

    });

new StoryPage(document.querySelector("body"));