import 'can-construct-super';
import Control from "can-control";

const Pagination = Control.extend(
    {
        defaults: {

        }
    },
    {
        init() {
            this._super();
        },

        ".js-ajax-pagination a click"(el, ev) {
            let $container = $(el).closest(".js-ajax-container");
            ev.preventDefault();

            $.ajax({
                url: "/ajax" + el.getAttribute("href"),
                method: "POST",
                data: "",
                success: (data) => {
                    $container.html(data);
                }
            });
        }
    }
);


export default Pagination;
