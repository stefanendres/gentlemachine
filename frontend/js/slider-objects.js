export let starterSliderLeft = (document.querySelector('.starter-left-column')) ? {
  cr: document.querySelector('.starter-left-column'),
  slidesCount: document.querySelector('.starter-left-column').getAttribute('data-slides-count'),
  swiper: undefined
} : undefined

export let starterSliderCenter = (document.querySelector('.starter-center-column')) ? {
  cr: document.querySelector('.starter-center-column'),
  slidesCount: document.querySelector('.starter-center-column').getAttribute('data-slides-count'),
  swiper: undefined
} : undefined

export let starterSliderRight = (document.querySelector('.starter-right-column')) ? {
  cr: document.querySelector('.starter-right-column'),
  slidesCount: document.querySelector('.starter-right-column').getAttribute('data-slides-count'),
  swiper: undefined
} : undefined

export let featuredProductsSlider = (document.querySelector('.featured-products-container')) ? {
  cr: document.querySelector('.featured-products-container'),
  slidesCount: document.querySelector('.featured-products-container').getAttribute('data-slides-count'),
  swiper: undefined
} : undefined

export let featuredNewsSliders = (document.querySelector('.news-thumb-slider-container')) ? Array.prototype.map.call(document.querySelectorAll('.news-thumb-slider-container'), function (item, i) {
  return {
    cr: item,
    slidesCount: document.querySelectorAll('.news-thumb-slider-container')[i].getAttribute('data-slides-count'),
    swiper: undefined
  }
}) : undefined

export let singleProductSlider = (document.querySelector('.product-images-container .swiper')) ? {
  cr: document.querySelector('.product-images-container .swiper'),
  slidesCount: document.querySelector('.product-images-container .swiper').getAttribute('data-slides-count'),
  swiper: undefined
} : undefined