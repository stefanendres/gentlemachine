export let page = {
  d : {
    h: undefined,
    sbW: undefined
  },
  vp: {
    h: undefined,
    initH: undefined, 
    w: undefined,
    t: (window.scrollY || document.documentElement.scrollTop),
    sot: undefined,
    orientation: (window.innerWidth >= window.innerHeight) ? 'landscape' : 'portrait',
    isSmall: (window.matchMedia("(max-width: 800px)").matches) ? true : false,
    lastRatio: undefined
  },
  breakpoints: { // always sync with variables.scss!!!
    break_xs: 375,
    break_s: 800,
    break_m: 1200,
    break_l: 1600,
  },
  scrolledOnce: false,
  lastScrollTop: undefined,
  loaded: false,
  body: document.querySelector('body'),
  header: {
    cr: document.querySelector('header'),
    d: {
      h: undefined
    },
    isVi: undefined,
    links: document.querySelectorAll('.header-link'),
    menu: {
      cr: document.querySelector('.main-menu-container'),
      btn: document.querySelector('.menu-button'),
      bg: document.querySelector('.menu-background'),
      links: document.querySelectorAll('.main-menu-container a'),
      isVi: false
    },
    mobileLogo: {
      cr: document.querySelector('.logo-container-mobile'),
      d: {
        h: undefined
      }
    }
  },

  pageCr: {
    el: document.querySelector('.site-content'),
    h: undefined // neeed?
  },
  footer: {

  },
  internalLinks: document.querySelectorAll('a:not([target="_blank"]):not(.remove):not(.shipping-calculator-button):not(.xoo-el-lostpw-tgr)'),
  cookieNotice: {
    cr: document.querySelector('.cookie-notice-container'),
    btn: document.querySelector('.cookie-notice-container button')
  }
}

export let observeVpItems = (document.querySelector('.observe-vp')) ? Array.prototype.map.call(document.querySelectorAll('.observe-vp'), function(item) {
  return {
    el: item,
    d: {
      h: undefined,
      t: undefined,
      b: undefined,
    },
    isVi: undefined,
    isCn: undefined,
    //offsetY: (item.getAttribute('data-scroll-offset')) ? item.getAttribute('data-scroll-offset') : 0
  }
}) : undefined

