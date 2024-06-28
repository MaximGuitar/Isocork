export default function navigation(slider) {
  let dots, arrowLeft, arrowRight

  function markup(remove) {
    dotMarkup(remove)
    arrowMarkup(remove)
  }

  function removeElement(elment) {
    elment.parentNode.removeChild(elment)
  }
  function createDiv(className) {
    var div = document.createElement("div")
    var classNames = className.split(" ")
    classNames.forEach((name) => div.classList.add(name))
    return div
  }

  function arrowMarkup(remove) {
    if (remove) {
      removeElement(arrowLeft)
      removeElement(arrowRight)
      return
    }

    arrowLeft = createDiv("slider-arrow slider-arrow--left")
    arrowLeft.addEventListener("click", () => slider.prev())
    arrowRight = createDiv("slider-arrow slider-arrow--right")
    arrowRight.addEventListener("click", () => slider.next())

		arrowLeft.innerHTML = slider.options.arrowIcon
		arrowRight.innerHTML = slider.options.arrowIcon

    slider.options.arrowsContainer.appendChild(arrowLeft)
    slider.options.arrowsContainer.appendChild(arrowRight)
  }

  function dotMarkup(remove) {
    if (remove) {
      removeElement(dots)
      return
    }
    dots = createDiv("slider-dots")
    slider.track.details.slides.forEach((_e, idx) => {
      var dot = createDiv("dot")
      dot.addEventListener("click", () => slider.moveToIdx(idx))
      dots.appendChild(dot)
    })
    slider.options.dotsContainer.appendChild(dots)
  }

  function updateClasses() {
    var slide = slider.track.details.rel
    slide === 0
      ? arrowLeft.classList.add("slider-arrow--disabled")
      : arrowLeft.classList.remove("slider-arrow--disabled")
    slide === slider.track.details.slides.length - 1
      ? arrowRight.classList.add("slider-arrow--disabled")
      : arrowRight.classList.remove("slider-arrow--disabled")
    Array.from(dots.children).forEach(function (dot, idx) {
      idx === slide
        ? dot.classList.add("dot--active")
        : dot.classList.remove("dot--active")
    })
  }

  slider.on("created", () => {
    markup()
    updateClasses()
  })
  slider.on("optionsChanged", () => {
    markup(true)
    markup()
    updateClasses()
  })
  slider.on("slideChanged", () => {
    updateClasses()
  })
  slider.on("destroyed", () => {
    markup(true)
  })
}