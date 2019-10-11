import Control from "can-control";
import "can-construct-super";
import "@fancyapps/fancybox";
import {fancyboxOptions} from "../helpers/fancybox";

const BasePage = Control.extend({
    defaults: {}
}, {
    init() {
        this.scrollTop = this.element.querySelector(".js-to-top");
        this.checkScroll();
    },

    ".js-to-top click"() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    },

    "{window} scroll"() {
        this.checkScroll();
    },

    ".js-fancy click"(el) {
        let src = el.dataset.href;

        $.fancybox.open({
            src: src,
            type: "ajax",
            opts: fancyboxOptions
        })
    },

    checkScroll() {
        if (window.scrollY < 500) {
            this.scrollTop.classList.add("hidden");
        } else {
            this.scrollTop.classList.remove("hidden");
        }
    }
});

export {BasePage};