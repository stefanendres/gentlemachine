export function initStarterSwiper(item, Swiper, Autoplay, EffectCoverflow, FreeMode, delay, speed) {
  if (item.slidesCount > 1) {
    item.swiper = new Swiper({
      el: item.cr,
      modules: [Autoplay, EffectCoverflow, FreeMode],
      effect: 'coverflow',
      coverflowEffect: {
        rotate: 75,
        stretch: 0,
        depth: 0,
        scale: 0.75,
      },
      watchSlidesProgress: true,
      direction: 'vertical',
      loop: true,
      autoplay: {
        delay: delay,
        disableOnInteraction: true,
        reverseDirection: true,
      },
      speed: speed,
      slidesPerView: 1,
      centeredSlides: true,
      grabCursor: true,
      freeMode: {
        enabled: true,
        sticky: true
      }
    })
    // custom events
    item.swiper.on('autoplayStop', (ev) => {
      console.log('stop', ev)
      item.stopped = true
    })
  }
}

export function initProductsSwiper(item, Swiper, Navigation) {
  if (item.slidesCount > 1) {
    item.swiper = new Swiper({
      el: item.cr,
      modules: [Navigation],
      rewind: true,
      speed: 600,
      //slidesPerView: 3,
      slidesPerView: 'auto',
      //slidesPerColumn: 3,
      grabCursor: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    })
  }
}

export function initNewsThumbSwiper(item, Swiper, Autoplay, Pagination, delay, speed) {
  if (item.slidesCount > 1) {
    item.swiper = new Swiper({
      el: item.cr,
      modules: [Autoplay, Pagination],
      //autoplay: {
      //  delay: delay,
      //  pauseOnMouseEnter: true,
      //  disableOnInteraction: true,
      //},
      loop: true,
      speed: speed,
      grabCursor: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
    })
  }
}