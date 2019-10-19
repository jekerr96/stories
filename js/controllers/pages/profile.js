import {BasePage} from "./base";
import JsTabs from 'js-tabs'

const ProfilePage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();

            this.myTabs = new JsTabs({
                elm: '.js-tabs'
            });

            this.myTabs.init()
        },
    });

new ProfilePage(document.querySelector("body"));