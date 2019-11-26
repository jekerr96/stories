import {BasePage} from "./base";
import "select2";
import Quill from "quill";
import autosize from "autosize";
import {initForm} from "../forms/helper/loader";

const WritePage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();

            var toolbarOptions = [
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

            this.initSelect();
            autosize(document.querySelectorAll('textarea'));
            initForm(this.$element);
        },

        initSelect() {
            this.element.querySelectorAll(".js-select").forEach((el) => {
                $(el).select2({
                    width: "100%",
                    minimumResultsForSearch: "1",
                    theme: "orange",
                    placeholder: {
                        id: '-1', // the value of the option
                        text: 'Выберите жанры'
                    },
                    language: {
                        noResults: () => {
                            return "По вашему запросу ничего не найдено";
                        }
                    },
                });
            });
        }
    });

new WritePage(document.querySelector("body"));
