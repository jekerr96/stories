import 'can-construct-super';
import BaseForm from "./base";

const SettingsForm  = BaseForm.extend(
    {
        defaults: {

        }
    },
    {
        init() {
            this._super();

        },

        onAjaxSuccess(data) {
            this._super(data);

            if (typeof data == "string") {
                data = JSON.parse(data);
            }

            if (data.auth) {
                console.log("true");
                location.reload();
            }
        }
    },
);

export default SettingsForm;