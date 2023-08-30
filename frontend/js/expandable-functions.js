export function resizeExpandables(items) {
  items.forEach(item => {
    const maxHeight = item.text.getBoundingClientRect().height
    item.cr.style.setProperty('--max_h', '' + maxHeight + 'px')
    item.maxHeight = maxHeight
  })
}