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
            this.$inputAvatar = $(this.element.querySelector(".js-input-avatar"));
            this.avatarImage = this.element.querySelector(".js-avatar-image");
        },

        ".js-change-avatar click"() {
            this.$inputAvatar.click();
        },

        ".js-input-avatar change"(el) {
            let reader = new FileReader();

            reader.onload = (ev) => {
                this.avatarImage.src = ev.target.result;
            };

            reader.readAsDataURL(el.files[0]);
        }
    },
);

export default SettingsForm;