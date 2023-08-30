export let expandableItems = (document.querySelector('.expandable-item')) ? Array.prototype.map.call(document.querySelectorAll('.expandable-item'), function (item, i) {
  return {
    cr: item,
    title: document.querySelectorAll('.expandable-item')[i].querySelector('.title-wrapper'),
    text: document.querySelectorAll('.expandable-item')[i].querySelector('.text-wrapper'),
    isExp: false,
    maxHeight: undefined,
  }
}) : undefined