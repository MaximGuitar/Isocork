import Swiper from "swiper"
import { Navigation, Pagination, Autoplay } from "swiper/modules"

function projectsSlider() {
	const sliderContainer = document.querySelector("#projects-slider")
	if (!sliderContainer) return

	const slider = sliderContainer.querySelector(".section-projects__swiper-main")
	if (slider) {
		const swiper = new Swiper(slider, {
			speed: 1000,
			loop:true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: true,
				pauseOnMouseEnter: true,
			},
			modules: [Navigation, Autoplay],
			navigation: {
				nextEl: sliderContainer.querySelector(".slider-arrow--right"),
				prevEl: sliderContainer.querySelector(".slider-arrow--left"),
			},
			allowTouchMove: false,
			breakpoints: {
				// 1279: {
				// 	initialSlide: slider.querySelector('.swiper-wrapper').childElementCount - 1,
				// }
			},
		})

		const infoContainer = sliderContainer.querySelector("[data-info-container]")
		const title = infoContainer.querySelector(".section-projects__info-title")
		const type = infoContainer.querySelector(".section-projects__info-type")
		const desc = infoContainer.querySelector(".section-projects__info-desc span")
		const link = infoContainer.querySelector(".section-projects__info-btn")

		const changeInfo = (data) => {
			title.textContent = data.title
			if (type) {
				type.textContent = data.type
			}
			if (desc) {
				desc.textContent = data.desc
			}

			link.href = data.link
		}

		swiper.on("slideChange", function () {
			const currentIndex = this.activeIndex
			const currentSlide = this.slides[currentIndex]

			changeInfo(currentSlide.dataset)
		})
	}

	const sliderMini = sliderContainer.querySelectorAll(".section-projects__swiper-mini")
	if (sliderMini) {
		sliderMini.forEach((element) => {
			let swiperMini = new Swiper(element, {
				modules: [Pagination],
				pagination: {
					el: ".slider-dots",
					clickable: true,
				},
			})
		})
	}
}

projectsSlider()

function projectsSliderType2() {
	const sliderMiniType2 = document.querySelectorAll(".projects__slider-mini")
	if (!sliderMiniType2) return

	if (sliderMiniType2) {
		sliderMiniType2.forEach((element) => {
			let swiperMini = new Swiper(element, {
				modules: [Pagination],
				pagination: {
					el: ".projects__dots",
					clickable: true,
				},
			})
		})
	}

	const sliderType2 = document.querySelectorAll(".projects__list")
	if (!sliderType2) return

	if (sliderType2) {
		sliderType2.forEach((element) => {
			const swiperMini = new Swiper(element, {
				modules: [Navigation],
				navigation: {
					nextEl: ".slider-arrow--right",
					prevEl: ".slider-arrow--left",
				},
				allowTouchMove: false,
				slidesPerView: 1,
				spaceBetween: 15,

				breakpoints: {
					767: {
						slidesPerView: 2,
						spaceBetween: 25,
					},
					1279: {
						slidesPerView: 3,
						spaceBetween: 45,
					},
				},
			})
		})
	}
}
projectsSliderType2()
