export default function navigation(slider) {
  let dots, arrowLeft, arrowRight

	const { options } = slider

  function markup(remove) {
		if (options.dots.enabled){
			dotMarkup(remove)
		}
		if (options.arrows.enabled){
			arrowMarkup(remove)
		}
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

		arrowLeft.innerHTML = options.arrows.icon
		arrowRight.innerHTML = options.arrows.icon

    if(slider.options.arrows.container) {
      slider.options.arrows.container.appendChild(arrowLeft)
      slider.options.arrows.container.appendChild(arrowRight)
    }

    let perView = 1;
    if(options.slides && options.slides.perView) 
      perView = options.slides.perView;

    if(slider.track.details.slides.length <= perView && slider.options.arrows.container) {
      slider.options.arrows.container.style.display = "none";   
    }
  }

  function dotMarkup(remove) {
    if (remove) {
      removeElement(dots)
      return
    }
    dots = createDiv(options.dots.className ? options.dots.className : "slider-dots")
    slider.track.details.slides.forEach((_e, idx) => {
      const dot = createDiv("dot")
      dot.addEventListener("click", () => slider.moveToIdx(idx))
      dots.appendChild(dot)
    })
    options.dots.container.appendChild(dots)
  }

  function updateClasses() {
    const slide = slider.track.details.rel;
    let slidesCount = 0;
    if(options.slides && options.slides.perView)
      slidesCount = options.slides.perView;
    
    let currentSlide = slide + slidesCount;

		if (options.arrows.enabled){
			slide === 0
				? arrowLeft.classList.add("slider-arrow--disabled")
				: arrowLeft.classList.remove("slider-arrow--disabled")
      if(currentSlide === slider.track.details.slides.length || slide === slider.track.details.slides.length - 1) {
        arrowRight.classList.add("slider-arrow--disabled")
      } else {
        arrowRight.classList.remove("slider-arrow--disabled")
      }
		}

		if (options.dots.enabled)
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