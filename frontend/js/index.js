

//import smoothscroll from 'smoothscroll-polyfill'
//smoothscroll.polyfill()

// core version + navigation, pagination modules:
//import Swiper, { Pagination, Navigation, Autoplay } from 'swiper' // Navigation, 

import {
  page,
  observeVpItems,
  //PageObj
} from '../frontend/js/main-objects.js'
import {
  resizePage,
  //resizeMyPage,
  resizeObserveVpItems,
  observeScrollPos,
  updateScrollDirection,
  fixPage,
  unfixPage,
  initSwiper
} from '../frontend/js/main-functions.js'
import { getCookie, setCookie } from '../frontend/js/main-functions.js' //this is imported automatically????

// Safari Back-/Forward-Button fix
window.onpageshow = (ev) => {
  if (ev.persisted) {
    window.location.reload()
  }
}

window.onload = () => {
  let throttle = require('lodash.throttle')
  let debounce = require('lodash.debounce')

  let resize = () => {
    resizePage(page)
    if (observeVpItems !== undefined) {
      resizeObserveVpItems(page, observeVpItems)
      observeScrollPos(page, observeVpItems, page.vp.h * 0, 0)
    }
    updateScrollDirection(page)
  }
  let debouncedResize = debounce(resize, 300)
  if (Modernizr.touchevents && page.vp.isSmall) {
    window.addEventListener('orientationchange', debouncedResize)
  } else {
    window.addEventListener('resize', debouncedResize)
  }
  resize()


  let scroll = () => {
    page.vp.t = (window.scrollY || document.documentElement.scrollTop)
    if (!page.scrolledOnce) {
      page.scrolledOnce = true
      document.documentElement.classList.add('scrolled-once')
    }
  }
  let throttleScroll = () => {
    page.vp.t = (window.scrollY || document.documentElement.scrollTop)
    if (page.vp.t > page.vp.h) {
      document.documentElement.classList.add('scrolled-one-screen')
    } else {
      document.documentElement.classList.remove('scrolled-one-screen')
    }
    updateScrollDirection(page)
    if (observeVpItems) {
      observeScrollPos(page, observeVpItems, page.vp.h * 0, 0)
    }
  }
  window.addEventListener('scroll', throttle(throttleScroll, 150), { passive: true })
  window.addEventListener('scroll', scroll, { passive: true })


  let init = () => {
    console.log('index->init()')
    /* internal links / page transitions */
    page.internalLinks.forEach(link => {
      link.addEventListener('click', (ev) => {
        if (Modernizr.touchevents && page.vp.isSmall && page.vp.orientation == 'portrait' && window.location.hash) {
          resize() // because ios prevents page reload here
          scroll()
          throttleScroll()
        } else {
          // because ios prevents page reload here
          document.documentElement.classList.remove('page-loaded')
          page.loaded = false
        }
      })
    })

    /* header menu */
    page.header.menu.btn.addEventListener('click', () => {
      if (!page.header.menu.isVi) {
        page.header.menu.cr.classList.add('is-visible')
        page.header.menu.btn.classList.add('is-active')
        page.header.menu.isVi = true
        fixPage(page)
      } else {
        page.header.menu.cr.classList.remove('is-visible')
        page.header.menu.btn.classList.remove('is-active')
        page.header.menu.isVi = false
        unfixPage(page)
      }
    })
    page.header.menu.bg.addEventListener('click', () => {
      page.header.menu.cr.classList.remove('is-visible')
      page.header.menu.btn.classList.remove('is-active')
      page.header.menu.isVi = false
      unfixPage(page)
    })
    page.header.menu.links.forEach(link => {
      link.addEventListener('click', () => {
        page.header.menu.cr.classList.remove('is-visible')
        page.header.menu.btn.classList.remove('is-active')
        page.header.menu.isVi = false
        unfixPage(page)
      })
    })
    
  }



  //page loading
  fixPage(page)
  setTimeout(() => {
    unfixPage(page)
    document.documentElement.classList.add('page-loaded')
    page.loaded = true
    resize()
    init()
  }, 150)


  if (getCookie('nuejazz-cn-accepted') !== 'confirmed') {
    setTimeout(() => {
      page.cookieNotice.cr.classList.add('is-visible')
    }, 300)
    page.cookieNotice.btn.addEventListener('click', () => {
      setCookie('nuejazz-cn-accepted', 'confirmed', 365)
      page.cookieNotice.cr.classList.remove('is-visible')
    })
  }


}
