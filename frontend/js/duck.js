const isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0 // Opera 8.0+

const isFirefox = typeof InstallTrigger !== 'undefined' // Firefox 1.0+

const isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification)) // Safari 3.0+ "[object HTMLElementConstructor]"

const isIE = /*@cc_on!@*/false || !!document.documentMode // Internet Explorer 6-11

const isEdge = !isIE && !!window.StyleMedia // Edge 20+

const isChrome = !!window.chrome // Chrome 1+

const isBlink = (isChrome || isOpera) && !!window.CSS


export const browserTypes = {
  isOpera : isOpera,
  isFirefox : isFirefox,
  isSafari : isSafari,
  isIE : isIE,
  isEdge : isEdge,
  isChrome : isChrome,
  isBlink : isBlink
}
