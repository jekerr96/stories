import 'can-construct-super';
import BaseForm from "./base";

const AuthForm  = BaseForm.extend(
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

            if (data.success) {
                location.reload();
            }
        }
    },
);

export default AuthForm;
