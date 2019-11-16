import 'can-construct-super';
import PopupBase from "./base";

const PopupExit = PopupBase.extend(
    {
        defaults: {

        }
    },
    {
        init() {
            this._super();
            console.log("init");
        },

        ".js-exit click"() {
            $.ajax({
                url: "/ajax/exit/",
                type: "POST",
                processData: false,
                contentType: false,
                dataType: this.options.type,
                data: "",
                success: (data) => {
                    data = JSON.parse(data);

                    if (data.exit) {
                        location.reload();
                    }
                }
            });
        }
    }
);


export default PopupExit;
