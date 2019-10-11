const btnTemplates = {
    download: '<a download data-fancybox-download class="fancybox-button fancybox-button--download" title="{{DOWNLOAD}}" href="javascript:;">' +
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.62 17.09V19H5.38v-1.91zm-2.97-6.96L17 11.45l-5 4.87-5-4.87 1.36-1.32 2.68 2.64V5h1.92v7.77z"/></svg>' +
    "</a>",

    zoom: '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}">' +
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.7 17.3l-3-3a5.9 5.9 0 0 0-.6-7.6 5.9 5.9 0 0 0-8.4 0 5.9 5.9 0 0 0 0 8.4 5.9 5.9 0 0 0 7.7.7l3 3a1 1 0 0 0 1.3 0c.4-.5.4-1 0-1.5zM8.1 13.8a4 4 0 0 1 0-5.7 4 4 0 0 1 5.7 0 4 4 0 0 1 0 5.7 4 4 0 0 1-5.7 0z"/></svg>' +
    "</button>",

    close: '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}">' +
    '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"><path fill="#333" fill-rule="evenodd" d="M14.004 12.66l-1.344 1.343-5.745-5.745-5.552 5.552L.04 12.488l5.552-5.552L.007 1.35 1.351.006l5.585 5.586L12.492.036l1.323 1.322-5.556 5.556 5.745 5.746z"/></svg>' +
    "</button>",

    // Arrows
    arrowLeft: '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">' +
    '<div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"/></svg></div>' +
    "</button>",

    arrowRight: '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">' +
    '<div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"/></svg></div>' +
    "</button>",

    // This small close button will be appended to your html/inline/ajax content by default,
    // if "smallBtn" option is not set to false
    smallBtn: '<button type="button" data-fancybox-close class="popup-close" title="{{CLOSE}}"></button>'
};

export const fancyboxOptions = {
    autoFocus        : true,
    closeClickOutside: true,
    keyboard         : true,
    padding          : 0,
    touch            : false,
    smallBtn         : true,
    hash             : false,
    helpers: {
        overlay: {
            locked: true
        }
    },
    lang   : document.documentElement.lang || 'ru',
    i18n   : {
        ru: {
            ERROR: 'Произошла ошибка при загрузке',
            CLOSE: 'Закрыть',
            NEXT : 'Следующее',
            PREV : 'Предыдущее',
            PLAY_START: "Запустить слайдшоу",
            PLAY_STOP: "Остановить слайдшоу",
            FULL_SCREEN: "Полный экран",
            THUMBS: "Превью",
            DOWNLOAD: "Скачать",
            SHARE: "Поделиться",
            ZOOM: "Увеличить"
        }
    },

    btnTpl: btnTemplates,

    afterLoad(instance) {
        let $content = instance.current.$content;
        let popup    = $content.hasClass('popup') ? $content.get(0) : false;
        let PopupController;

        if (!popup) {
            return true;
        }

        if (popup.dataset['popupController']) return;

        // Инициализируем контроллер попапа
        let popupType = popup.dataset.popupType;


        require.ensure([],
            (module) => {
                PopupController = require(`../popups/${popupType}`);
                new PopupController.default(popup);
                popup.dataset.popupController = 'true';
            },

            () => {
                PopupController = require('../popups/base');
                new PopupController.default(popup);
                popup.dataset.popupController = 'true';
            },

            'popups'
        );
    },
    afterShow() {
        let popup = document.querySelector('.fancybox-container .popup');

        if (!popup) {
            return true;
        }
    }
};