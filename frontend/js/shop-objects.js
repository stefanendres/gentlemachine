let productFilter = (document.querySelector('.product-filter')) ? {
    wr: document.querySelector('.product-filter'),
    cr: document.querySelector('.product-filter-container'),
    btn: document.querySelector('.product-filter-button'),
    items: document.querySelectorAll('.product-filter-container li'),
    isVi: false,
    isAc: false
} : undefined

let addToCartButton = (document.querySelector('.single_add_to_cart_button')) ? {
    el: document.querySelector('.single_add_to_cart_button')
} : undefined