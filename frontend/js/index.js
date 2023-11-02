

//import smoothscroll from 'smoothscroll-polyfill'
//smoothscroll.polyfill()

// core version + navigation, pagination modules:
import Swiper from 'swiper' // Navigation, 
import { Navigation, Pagination, Autoplay, EffectCoverflow, FreeMode } from 'swiper/modules'
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
//import { initFeaturedProductsSwiper } from '../frontend/js/slider-functions.js'
//import { featuredProductsSwiper } from '../frontend/js/slider-objects.js'

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
    /* home / faqs * expandables */
    if (document.querySelector('.expandable-item')) {
      resizeExpandables(expandableItems)
    }
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
    page.header.links.forEach(link => {
      link.addEventListener('click', () => {
        page.header.menu.cr.classList.remove('is-visible')
        page.header.menu.btn.classList.remove('is-active')
        page.header.menu.isVi = false
        unfixPage(page)
      })
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

    /* home * starter */
    if (document.querySelector('.home')) {
      initStarterSwiper(starterSliderLeft, Swiper, Autoplay, EffectCoverflow, FreeMode, 900, 1200)
      setTimeout(() => {
        initStarterSwiper(starterSliderCenter, Swiper, Autoplay, EffectCoverflow, FreeMode, 900, 1200)
      }, 300)
      setTimeout(() => {
        initStarterSwiper(starterSliderRight, Swiper, Autoplay, EffectCoverflow, FreeMode, 900, 1200)
      }, 600)

      initProductsSwiper(featuredProductsSlider, Swiper, Navigation)

      window.addEventListener('scroll', () => {
        if (starterSliderLeft.stopped) {
          starterSliderLeft.swiper.autoplay.start()
          starterSliderLeft.stopped = false
        }
        if (starterSliderCenter.stopped) {
          setTimeout(() => {
            starterSliderCenter.swiper.autoplay.start()
            starterSliderCenter.stopped = false
          }, 300)
        }
        if (starterSliderRight.stopped) {
          setTimeout(() => {
            starterSliderRight.swiper.autoplay.start()
            starterSliderRight.stopped = false
          }, 600)
        }
      })
    }
    /* home & news * news-overview */
    if (document.querySelector('.home') || document.querySelector('.page-id-179')) {
      featuredNewsSliders.forEach((newsSlider, i) => {
        setTimeout(() => {
          initNewsThumbSwiper(newsSlider, Swiper, Autoplay, Pagination, 2700, 900)
        }, (i*1800))
      })
    }
    /* home * carerepair video */
    if (document.querySelector('.video-container') && Modernizr.touchevents) {
      const video = document.querySelector('.video-container video')
      window.addEventListener('touchstart', () => {
        if (video.paused) {
          video.play()
        }
      })
    }
    /* home & faqs * expandables */
    if (document.querySelector('.expandable-item')) {
      expandableItems.forEach(item => {
        item.title.addEventListener('click', () => {
          if (!item.isExp){
            item.cr.classList.add('is-expanded')
            item.isExp = true
          } else {
            item.cr.classList.remove('is-expanded')
            item.isExp = false
          }
          resize()
        })
      })
    }

    /* shop archive * product-filter */
    if (document.querySelector('.archive')) {
      updateProductFilterState(productFilter)
      productFilter.btn.addEventListener('click', () => {
        toggleProductFilter(productFilter)
      })
      document.querySelector('ul.products').addEventListener('click', () => {
        closeProductFilter(productFilter)
      })
      productFilter.cr.addEventListener('click', () => {
        setTimeout(() => {
          updateProductFilterState(productFilter)
        }, 100);
      })
    }

    /* single-product * slider */
    if (document.querySelector('.single-product')) {
      if (window.innerWidth <= page.breakpoints.break_s && singleProductSlider){
        initProductsSwiper(singleProductSlider, Swiper, Navigation)
      }
      if (addToCartButton) {
        addToCartButton.el.addEventListener('click', () => {
          setTimeout(() => {
            if (addToCartButton.el.classList.contains('added')) {
              addToCartButton.el.classList.remove('added')
            }
          }, 6000);
        })
      }
      if (document.querySelector('.woocommerce-error')) {
        const error = document.querySelector('.woocommerce-error')
        error.classList.add('closable')
        error.addEventListener('click', () => {
          error.classList.add('closed')
        })
      }
    }

    /* checkout * make woocommerce-notice closable */
    // additional woocommerce notice is an overlay and should be closable
    if (document.querySelector('form.checkout')) {
      const form = document.querySelector('form.checkout')
      form.addEventListener('submit', () => {
        setTimeout(() => {
          if (document.querySelector('.woocommerce-NoticeGroup')) {
            const noticeGroup = document.querySelector('.woocommerce-NoticeGroup')
            noticeGroup.classList.add('closable')
            noticeGroup.addEventListener('click', () => {
              noticeGroup.classList.add('closed')
            })
          }
          console.log(document.querySelector('.woocommerce-error'))
          if (document.querySelector('.woocommerce-error')) {
            const noticeGroup = document.querySelector('.woocommerce-error')
            noticeGroup.classList.add('closable')
            noticeGroup.addEventListener('click', () => {
              noticeGroup.classList.add('closed')
            })
          }
        }, 3000)
      })
      if (document.querySelector('.ppc-button-wrapper')) {
        window.addEventListener('blur', () => {
          setTimeout(() => {
            if (document.querySelector('.woocommerce-NoticeGroup')) {
              const noticeGroup = document.querySelector('.woocommerce-NoticeGroup')
              noticeGroup.classList.add('closable')
              noticeGroup.addEventListener('click', () => {
                noticeGroup.classList.add('closed')
              })
            }
            if (document.querySelector('.woocommerce-error')) {
              const noticeGroup = document.querySelector('.woocommerce-error')
              noticeGroup.classList.add('closable')
              noticeGroup.addEventListener('click', () => {
                noticeGroup.classList.add('closed')
              })
            }
          }, 6000)
        })
      }
    }
    
  }



  //page loading
  fixPage(page)
  setTimeout(() => {
    unfixPage(page)
    document.documentElement.classList.add('page-loaded')
    page.loaded = true
    resize()
    init()
    resize()
  }, 10)


  if (getCookie('gentlemachine_shop-cn-accepted') !== 'confirmed') {
    setTimeout(() => {
      page.cookieNotice.cr.classList.add('is-visible')
    }, 300)
    page.cookieNotice.btn.addEventListener('click', () => {
      setCookie('gentlemachine_shop-cn-accepted', 'confirmed', 365)
      page.cookieNotice.cr.classList.remove('is-visible')
    })
  }


}
