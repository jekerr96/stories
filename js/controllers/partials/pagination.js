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

            ev.preventDefault();

            $.ajax({
                url: "/ajax" + el.getAttribute("href"),
                method: "POST",
                data: {name: name},
                success: (data) => {
                    $container.html(data);

                    $("html, body").animate({scrollTop: $container.offset().top})

                    if (el.dataset.page) {
                        this.pushUrl.add({key: name, value: el.dataset.page});
                    } else {
                        this.pushUrl.remove(name);
                    }

                }
            });
        }
    }
);


export default Pagination;
