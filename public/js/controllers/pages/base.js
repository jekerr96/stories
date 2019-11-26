import Control from "can-control";
import "can-construct-super";
import "@fancyapps/fancybox";
import {fancyboxOptions} from "../helpers/fancybox";
import tippy from "tippy.js";
import {device} from "../helpers/device";

const BasePage = Control.extend({
    defaults: {}
}, {
    init() {
        this.$element = $(this.element);
        window.csrf = document.head.querySelector("[name='csrf-token']").content;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.csrf,
            }
        });

        this.stickyMessage = this.element.querySelector(".js-sticky-message");
        this.showStickyMessage();
        if (device.isTouch()) document.documentElement.classList.add("is-touch");
        this.scrollTop = this.element.querySelector(".js-to-top");
        this.checkScroll();

        this.headerActions = this.element.querySelector(".js-header-actions");

        tippy(".js-tippy", {
            theme: 'light',
            placement: "top",
        })
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

    ".js-header-profile click"(el) {
        el.classList.toggle("open");

        this.openHeaderActions = el.classList.contains("open");

        if (!this.headerActions) return;

        let height = 0;

        if (el.classList.contains("open")) {
            height = this.headerActions.scrollHeight;
        }

        this.headerActions.style.height = (height + (height === 0 ? 0 : 50)) + "px";
    },

    "{window} click"(el, ev) {
        if (!this.openHeaderActions) return;

        if (!ev.target.closest(".js-header-profile")) {
            this.element.querySelector(".js-header-profile").click();
        }
    },

    checkScroll() {
        if (window.scrollY < 500) {
            this.scrollTop.classList.add("hidden");
        } else {
            this.scrollTop.classList.remove("hidden");
        }
    },

    showStickyMessage() {
        this.stickyMessage.classList.add("active");

        setTimeout(() => {
            this.stickyMessage.classList.remove("active");
        }, 3000);
    },
});

export {BasePage};
