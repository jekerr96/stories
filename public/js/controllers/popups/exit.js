import PopupBase from "./base";

const PopupExit = PopupBase.extend(
    {
        defaults: {

        }
    },
    {
        init() {
            this._super();
        },

        ".js-exit click"() {
            $.ajax({
                url: "/popups/exit/proccess",
                type: "POST",
                data: "",
                success: (data) => {
                    if (typeof data == "string") {
                        data = JSON.parse(data);
                    }


                    if (data.success) {
                        location.href = "/1";
                        location.reload();
                    }
                }
            });
        }
    }
);


export default PopupExit;
