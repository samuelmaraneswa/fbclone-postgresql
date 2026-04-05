document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll('.tooltip-parent').forEach(parent => {
    const tooltipChild = parent.querySelector('.tooltip-child')

    parent.addEventListener("mouseenter", () => {
      const rect = parent.getBoundingClientRect();

      const spaceAbove = rect.top
      const spaceBelow = window.innerHeight - rect.bottom

      tooltipChild.classList.remove("bottom-full", "top-full")

      if(spaceAbove > spaceBelow){
        tooltipChild.classList.add("bottom-full")
      }else{
        tooltipChild.classList.add("top-full")
      }
    })
  })
})