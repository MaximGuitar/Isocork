import Swiper from "swiper"
import { Navigation } from "swiper/modules"

function advantagesType3Slider() {
	const sliders = document.querySelectorAll(".advantages-type3-slider")
	if (!sliders.length) return

	sliders.forEach((slider) => {
		new Swiper(slider.querySelector(".swiper"), {
			slidesPerView: 4,
			speed: 450,
			watchSlidesProgress: true,
			initialSlide: 1,
			loop: true,
			navigation: {
				prevEl: slider.querySelector(".orange_image2"),
				nextEl: slider.querySelector(".orange_image1"),
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spacing: 50,
				},

				768: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 4,
				},
			},
			slides: {
				perView: 4,
				spacing: 15,
			},
			modules: [Navigation],
		})
	})
}
advantagesType3Slider()
