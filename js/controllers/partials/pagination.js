import 'can-construct-super';
import Control from "can-control";
import PushDataToUrl from "push-data-to-url";

const Pagination = Control.extend(
    {
        defaults: {

        }
    },
    {
        init() {
            this._super();
            this.pushUrl = new PushDataToUrl();
        },

        ".js-ajax-container a click"(el, ev) {
            let $container = $(el).closest(".js-ajax-container");
            let name = $container.data("name");
            if (!name) {
                name = "page";
            }

            if (el.dataset.page) {
                this.pushUrl.add({key: name, value: el.dataset.page});
            } else {
                this.pushUrl.remove(name);
            }

            let url;

            if ($container.data("href")) {
                url = $container.data("href") + location.search;
            } else {
                url = "/ajax" + el.getAttribute("href");
            }

            ev.preventDefault();

            $.ajax({
                url: url,
                method: "POST",
                data: {name: name},
                success: (data) => {
                    $container.html(data);
                    $("html, body").animate({scrollTop: $container.offset().top});
                }
            });
        }
    }
);


export default Pagination;
