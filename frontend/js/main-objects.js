
export let page = {
  siteUrl: document.querySelector('body').getAttribute('data-site-url'),
  siteTitle: document.querySelector('body').getAttribute('data-site-title'),
  url: document.querySelector('body').getAttribute('data-page-url'),
  title: document.querySelector('body').getAttribute('data-page-title'),
  template: document.querySelector('body').getAttribute('data-template-slug'),
  slug: document.querySelector('body').getAttribute('data-page-slug'),
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
    menu: {

    }
  },

  pageCr: {
    el: document.querySelector('.site-content'),
    h: undefined // neeed?
  },
  footer: {

  },
  internalLinks: document.querySelectorAll('a:not([target="_blank"])'),
  cookieNotice: {
    cr: document.querySelector('.cookie-cr'),
    btn: document.querySelector('.cookie-cr button')
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

