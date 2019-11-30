import {BasePage} from "./base";
import "select2";
import autosize from "autosize";
import {initForm} from "../forms/helper/loader";

const WritePage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();

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
