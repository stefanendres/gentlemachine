export function resizePage(page) {
  page.d.h = Math.max(document.body.scrollHeight, document.body.offsetHeight, document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight);
  if (!page.d.sbW) {
    page.d.sbW = window.innerWidth - document.documentElement.clientWidth
    document.documentElement.style.setProperty('--sb_w', ''+page.d.sbW +'px')
  }

  if (window.innerWidth >= window.innerHeight) {
    page.vp.orientation = 'landscape'
    document.documentElement.classList.remove('portrait')
    document.documentElement.classList.add('landscape')
  } else {
    page.vp.orientation = 'portrait'
    document.documentElement.classList.remove('landscape')
    document.documentElement.classList.add('portrait')
  }

  page.vp.isSmall = (window.matchMedia("(max-width: 800px)").matches) ? true : false
  page.vp.h = window.innerHeight
  if (!page.vp.initH) {
    page.vp.initH = window.innerHeight
    document.documentElement.style.setProperty('--vp_ih', '' + window.innerHeight + 'px')
  }
  page.vp.w = window.innerWidth
  page.vp.t = (window.scrollY || document.documentElement.scrollTop)
  document.documentElement.style.setProperty('--vp_h', ''+window.innerHeight+'px')

  page.header.d.h = page.header.cr.getBoundingClientRect().height
  document.documentElement.style.setProperty('--h_h', page.header.d.h + 'px')
  //page.header.menu.d.h = page.header.menu.wr.getBoundingClientRect().height
  

  // orientationchange event "polyfill"
  if ((1 - page.vp.lastRatio) <= 0 && (1 - (window.innerWidth / window.innerHeight)) > 0) {
    window.location.reload()
    //console.log('orientationchange from landscape to portrait')
  } else if ((1 - page.vp.lastRatio) > 0 && (1 - (window.innerWidth / window.innerHeight)) <= 0) {
    window.location.reload()
    //console.log('orientationchange from portrait to landscape')
  } else {
    //console.log('no orientationchange')
  }
  page.vp.lastRatio = window.innerWidth / window.innerHeight
}

export function resizeObserveVpItems(page, items) {
  items.forEach((item) => {
    const bcr = item.el.getBoundingClientRect()
    item.d.h = bcr.height
    item.d.t = bcr.top + page.vp.t
    item.d.b = bcr.top + page.vp.t + bcr.height
  })
}

export function observeScrollPos(page, items, offsetVp, offsetCn) {
  if (items.length > 1) {
    items.forEach((item) => {
      observeScrollPosFn(page, item, offsetVp, offsetCn)
    })
  } else if (items.length <= 1) {
    observeScrollPosFn(page, items[0], offsetVp, offsetCn)
  } else {
    //console.log(items.length, 'undefined') // important for subheader scroll sections (single item is piped into functions there)
    observeScrollPosFn(page, items, offsetVp, offsetCn)
  }
}

function observeScrollPosFn(page, item, offsetVp, offsetCn) {
  if (page.vp.t > (item.d.b - offsetVp) || (page.vp.t + page.vp.h) < (item.d.t + offsetVp)) {
    //console.log(i, 'not in view…')
    item.isVi = false
    item.el.classList.remove('is-in-view')
    item.isCn = false
    item.el.classList.remove('is-in-center')
  } else {
    //console.log(i, 'in view!')
    item.isVi = true
    item.el.classList.add('is-in-view')
    if (!item.el.classList.contains('is-visible')) {
      item.el.classList.add('is-visible')
    }
  }
  if (offsetCn !== 0) {
    if ((page.vp.t + page.vp.h*0.5 - offsetCn) > item.d.b || (page.vp.t + page.vp.h - page.vp.h*0.5 + offsetCn) < item.d.t) {
      //console.log(i, 'not in center…')
      item.isCn = false
      //item.el.classList.remove('is-in-center')
    } else {
      //console.log(i, 'in center!')
      item.isCn = true
      item.el.classList.add('is-in-center')
    }
  }
}

export function updateScrollDirection(page) {
    const offset = 0//page.header.d.h
    if (page.vp.t - offset > page.lastScrollTop) {
      document.documentElement.classList.remove('scrolling-up')
      page.header.cr.classList.remove('is-visible')
      page.header.isVi = false
      //page.footer.cr.classList.remove('is-visible')
      //page.footer.isVi = false
    } else if (page.vp.t - offset <= page.lastScrollTop) {
      document.documentElement.classList.add('scrolling-up')
      page.header.cr.classList.add('is-visible')
      page.header.isVi = true
      //page.footer.cr.classList.add('is-visible')
      //page.footer.isVi = true
    }
    if (page.vp.t + page.vp.h >= page.d.h) { // need?
      //page.footer.cr.classList.add('is-visible')
      //page.footer.isVi = true
    }
    page.lastScrollTop = ((page.vp.t - offset) <= 0) ? offset : (page.vp.t - offset) // For Mobile or negative scrolling
  //}
}

export function fixPage(page) {
  page.body.classList.add('is-fixed')
  page.body.style.position = 'fixed'
  page.body.style.top = -1 * page.vp.t + 'px'
  page.vp.sot = page.vp.t
  //console.log('fix', page.vp.sot)
}

export function unfixPage(page) {
  page.body.classList.remove('is-fixed')
  page.body.style.position = 'relative'
  page.body.style.top = ''
  //console.log('unfix', page.vp.sot)
  window.scrollTo(0,page.vp.sot)
}

export function setCookie(cname, cvalue, exdays) {
  var d = new Date()
  d.setTime(d.getTime() + (exdays*24*60*60*1000))
  var expires = 'expires='+ d.toUTCString()
  document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/'
}

export function getCookie(cname) {
  const name = cname + '='
  const decodedCookie = decodeURIComponent(document.cookie)
  const ca = decodedCookie.split(';')
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i]
    while (c.charAt(0) == ' ') {
      c = c.substring(1)
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length)
    }
  }
  return ''
}
