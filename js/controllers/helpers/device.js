import viewport from "./viewport";

let device = {
    isMac() {
        return  navigator.platform.indexOf('Mac') > -1;
    },

    isIos() {
        let isIpad    = (navigator.platform.indexOf("iPad")    !== -1) || (navigator.userAgent.match(/iPad/i)     !== null);
        let isIphone  = this.isIphone();
        let isIpod    = (navigator.platform.indexOf("iPod")    !== -1) || (navigator.userAgent.indexOf("iPod")    !== -1);
        return isIpad || isIphone || isIpod;
    },

    isIphone() {
        return (navigator.platform.indexOf("iPhone")  !== -1) || (navigator.userAgent.indexOf("iPhone")  !== -1);
    },

    isAndroid() {
        return (navigator.platform.indexOf("Android") !== -1) || (navigator.userAgent.indexOf("Android") !== -1);
    },

    isLinux() {
        return /Linux/.test(navigator.platform);
    },

    isWindows() {
        return ['Win32', 'Win64', 'Windows', 'WinCE'].indexOf(navigator.platform) !== -1;
    },

    isTouch() {
        let isIos = this.isIos();
        let isAndroid = this.isAndroid();
        let isBlackBerry = (navigator.platform.indexOf("BlackBerry") !== -1) || (navigator.userAgent.indexOf("BlackBerry")  !== -1);
        let isOperaMini  = (navigator.platform.indexOf("Opera Mini") !== -1) || (navigator.userAgent.indexOf("Opera Mini")  !== -1);
        return isIos || isAndroid || isBlackBerry || isOperaMini || navigator.msMaxTouchPoints;
    },

    isSimple() {
        return (this.isTouch() && viewport.isXxs()) || ($(window).height() <= viewport.xxs)
    }
};

export { device };
