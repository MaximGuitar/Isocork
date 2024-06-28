import Swiper from "swiper"
import { Navigation, Pagination } from "swiper/modules"

function sliderOrder() {
	const orders = document.querySelectorAll(".section-order__swiper")
	if (!orders.length) return

	const createSlider = (section) => {
		const swiper = new Swiper(section, {
			modules: [Pagination, Navigation],
			navigation: {
				nextEl: section.querySelector(".slider-arrow--right"),
				prevEl: section.querySelector(".slider-arrow--left"),
			},
			pagination: {
				el: section.parentElement.querySelector(".section-order__dots-wrap"),
				clickable: true,
			},
		})

		function locationBullets() {
			var type = 1
			let bullets = section.parentElement.querySelectorAll(".swiper-pagination-bullet")
			var numberOfElements = type === 1 ? bullets.length : bullets.length - 1
			var start = -90
			var slice = (360 * type) / numberOfElements
			let dots = section.parentElement.querySelector(".section-order__dots-wrap")
			let dotsWidth = dots.offsetWidth
			dotsWidth =
				dotsWidth - parseInt(getComputedStyle(dots).paddingLeft) - parseInt(getComputedStyle(dots).paddingRight)
			var radius = parseInt(dotsWidth / 2)

			let index = 0
			bullets.forEach((bullet) => {
				var self = bullet,
					rotate = slice * index + start,
					rotateReverse = rotate * -1

				bullet.style.transform = "rotate(" + rotate + "deg) translate(" + radius + "px) rotate(0)"
				index++
			})
		}

		function formingCircle() {
			let circle = section.parentElement.querySelector("#circle")
			if (window.screen.width > 1279 && circle) {
				circle.setAttribute("stroke-dasharray", circle.getTotalLength())
				circle.setAttribute("stroke-dashoffset", circle.getTotalLength())
			}
		}

		function updateCircle(allElements, expectedElements) {
			let circle = section.parentElement.querySelector("#circle")
			if (window.screen.width > 1279 && circle) {
				let circleLength = circle.getTotalLength()
				let countBullets = allElements.length
				let circleOneSection = parseFloat(circleLength / countBullets)
				let countPrevElement = expectedElements.length

				let dashoffsetPath = parseFloat(circleLength - circleOneSection * countPrevElement)

				circle.setAttribute("stroke-dashoffset", dashoffsetPath)
			}
		}

		locationBullets()
		formingCircle()

		function updateSlider(slider, numberActiveSlide) {
			const allElements = Array.from(slider.parentElement.querySelectorAll(".swiper-pagination-bullet"))
			allElements.forEach((element) => {
				element.classList.remove("swiper-pagination-bullet--prev")
			})

			const expectedElements = allElements.slice(
				0,
				allElements.findIndex((element) => element.classList.contains("swiper-pagination-bullet-active"))
			)

			expectedElements.forEach((element) => {
				element.classList.add("swiper-pagination-bullet--prev")
			})

			updateCircle(allElements, expectedElements)

			let numberCurrentSlide = slider.querySelector(".slider-current-slide")

			numberCurrentSlide.textContent = String(numberActiveSlide).padStart(2, "0")
		}

		function updateIcon(iconUrl) {
			let iconWrap = section.parentElement.querySelector(".section-order__icon")
			iconWrap.src = iconUrl
		}

		swiper.on("slideChange", function () {
			let numberActiveSlide = swiper.activeIndex + 1
			let activeSlideUrl = swiper.slides[swiper.activeIndex].dataset.icon

			updateSlider(section, numberActiveSlide)
			updateIcon(activeSlideUrl)
		})

		window.addEventListener(
			"resize",
			function (event) {
				locationBullets()
			},
			true
		)
	}
	orders.forEach(createSlider)
}
sliderOrder()
