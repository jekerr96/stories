import 'can-construct-super';
import BaseForm from "./base";
import Quill from "quill";

const WriteForm  = BaseForm.extend(
    {
        defaults: {

        }
    },
    {
        init() {
            this._super();

            let toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                // ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                // [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                // [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                // [{ 'direction': 'rtl' }],                         // text direction

                // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                // [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                // [{ 'font': [] }],
                [{ 'align': [] }],

                ['clean']                                         // remove formatting button
            ];

            this.editor = new Quill('.js-editor', {
                modules: { toolbar: toolbarOptions },
                theme: 'snow'
            });
        },

        getFormData() {
            let formData = new FormData(this.element);
            formData.append("text", this.element.querySelector(".ql-editor").innerHTML);
            return formData;
        }
    },
);

export default WriteForm;
