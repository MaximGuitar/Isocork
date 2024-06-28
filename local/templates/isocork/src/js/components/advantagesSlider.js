import Swiper from "swiper"
import { Navigation, Autoplay } from "swiper/modules"
import { delegate } from "../utils/delegate"

function advantagesSlider() {
	const sliders = document.querySelectorAll("#slider-goals")
	if (!sliders.length) return

	sliders.forEach((slider) => {
		const swiper = new Swiper(slider.querySelector(".swiper"), {
			slidesPerView: 3,
			speed: 450,
			spaceBetween: 20,
			loop:true,
			centeredSlides: true,
			navigation: {
				prevEl: slider.querySelector(".slider-arrow--left"),
				nextEl: slider.querySelector(".slider-arrow--right"),
			},
			autoplay: {
				delay: 3000,
				disableOnInteraction: true,
				pauseOnMouseEnter: true,
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
			},
			modules: [Navigation, Autoplay],
		})

		delegate(
			"click",
			".swiper-slide",
			(event, slide) => {
				swiper.slideTo(slide.dataset.id)
			},
			slider
		)
	})
}
advantagesSlider()
