const Viewport = {
    minWidth    : 320,
    xs          : 480,
    sm          : 768,
    md          : 1024,
    lg          : 1240,
    xl          : 1440,
    isXs        : () => {return $(window).outerWidth() < Viewport.xs },
    isSm        : () => {return $(window).outerWidth() < Viewport.sm },
    isMd        : () => {return $(window).outerWidth() < Viewport.md },
    isLg        : () => {return $(window).outerWidth() < Viewport.lg },
    isXl        : () => {return $(window).outerWidth() < Viewport.xl },
    getScrollTop: () => {return window.pageYOffset || document.documentElement.scrollTop; },
    scrollHeight: () => {return $(window).outerHeight() < 600 || $(window).outerWidth() < Viewport.md},
};

export default Viewport;
