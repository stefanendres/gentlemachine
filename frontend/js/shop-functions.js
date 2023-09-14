export function toggleProductFilter(productFilter) {
  if (!productFilter.isVi) {
    productFilter.wr.classList.add('is-visible')
    productFilter.isVi = true
  } else {
    productFilter.wr.classList.remove('is-visible')
    productFilter.isVi = false
  }
}
export function closeProductFilter(productFilter) {
  if (productFilter.isVi) {
    productFilter.wr.classList.remove('is-visible')
    productFilter.isVi = false
  }
}
export function updateProductFilterState(productFilter) {
  if (window.location.href.indexOf("filter") > -1) {
    if (!productFilter.isAc) {
      productFilter.wr.classList.add('is-active')
      productFilter.isAc = true
    }
  } else {
    if (productFilter.isAc) {
      productFilter.wr.classList.remove('is-active')
      productFilter.isAc = false
    }
  }
}

export function makeOverlayCloasble(triggerClass, triggerEvent, overlayClass) {
  const trigger = document.querySelector(triggerClass)
  trigger.addEventListener(triggerEvent, () => {
    setTimeout(() => {
      if (document.querySelector(overlayClass)) {
        const overlay = document.querySelector(overlayClass)
        overlay.classList.add('closable')
        overlay.addEventListener('click', () => {
          overlay.classList.add('closed')
        })
      }
    }, 1500)
    //resize()
  })
}