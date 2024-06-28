import Swiper from "swiper"
import { Navigation, Pagination, Autoplay } from "swiper/modules"

function circlesSlider() {
	const sliders = document.querySelectorAll(".circles-slider")

	if (!sliders.length) {
		return
	}

	sliders.forEach((slider) => {
		const swiper = new Swiper(slider, {
			speed: 550,
			slidesPerView: 1,
			initialSlide: 1,
			centeredSlides: true,
			loop: true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: true,
				pauseOnMouseEnter: true,
			},
			navigation: {
				prevEl: slider.querySelector(".slider-arrow--left"),
				nextEl: slider.querySelector(".slider-arrow--right"),
			},
			pagination: {
				el: slider.querySelector(".pagination"),
				type: "fraction",
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 3,
				},
			},
			modules: [Navigation, Pagination, Autoplay],
		})

		slider.querySelector(".listing_blockleft").addEventListener("click", () => {
			swiper.slidePrev()
		})

		slider.querySelector(".listing_blockRight").addEventListener("click", () => {
			swiper.slideNext()
		})
	})
}

circlesSlider()
