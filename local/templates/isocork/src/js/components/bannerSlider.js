import Swiper from "swiper"
import { Navigation, Pagination, Autoplay } from "swiper/modules"

function bannerSlider() {
	const sliderContainer = document.querySelector(".screen-banner--slider")
	if (!sliderContainer) return

	let swiper = new Swiper("#screen-slider", {
		modules: [Pagination, Autoplay],
		loop: true,
		autoplay: true,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
			renderBullet: function (index, className) {
				return (
					'<div class="' +
					className +
					'"><span class="bullet-number">' +
					String(index + 1).padStart(2, "0") +
					'</span><span data-slide-index="' +
					(index + 1) +
					'" class="bullet-progress"><p class="progressline"></p></span></div>'
				)
			},
		},
		on: {
			init: function (swiper) {
				setTimeout(() => {
					let numberActiveSlide = swiper.activeIndex + 1
					updateSlider(sliderContainer, numberActiveSlide)
				}, 500)
			},
		},
	})

	swiper.on("slideChange", function () {
		let numberActiveSlide = swiper.activeIndex + 1
		updateSlider(sliderContainer, numberActiveSlide)
		let currentSlideIndex = swiper.activeIndex
		let currentSlideElement = swiper.slides[currentSlideIndex]
		let duration = currentSlideElement.dataset.swiperAutoplay
		let currentPaginationElement = swiper.pagination.bullets[currentSlideIndex]
		let currentLine = currentPaginationElement.querySelector(".progressline")
		currentLine.style.transitionDuration = duration + "ms"
	})

	function updateSlider(slider, numberActiveSlide) {
		const allElements = Array.from(slider.querySelectorAll(".swiper-pagination-bullet"))
		allElements.forEach((element) => {
			element.classList.remove("bullet--prev")
			element.classList.remove("bullet--next")
			element.classList.remove("bullet--active")
		})

		let activeSlide =
			allElements[allElements.findIndex((element) => element.classList.contains("swiper-pagination-bullet-active"))]
		if (activeSlide) activeSlide.classList.add("bullet--active")

		let prevSlide =
			allElements[allElements.findIndex((element) => element.classList.contains("swiper-pagination-bullet-active")) - 1]
		if (prevSlide) prevSlide.classList.add("bullet--prev")

		let nextSlide =
			allElements[allElements.findIndex((element) => element.classList.contains("swiper-pagination-bullet-active")) + 1]
		if (nextSlide) nextSlide.classList.add("bullet--next")
	}
}

window.addEventListener("load", function () {
	bannerSlider()
})
