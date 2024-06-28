import Swiper from "swiper"
import { Thumbs, EffectFade, Navigation } from "swiper/modules"

var swiper = new Swiper(".swiper-render--thumbnail", {
	modules: [Thumbs, Navigation],
	slidesPerView: "auto",
	freeMode: true,
	watchSlidesProgress: true,
	navigation: {
		nextEl: ".slider-render__thumbnail-arrows .slider-arrow--right",
		prevEl: ".slider-render__thumbnail-arrows .slider-arrow--left",
	},
	spaceBetween: 20,
	breakpoints: {
		320: {
			spaceBetween: 20,
		},
		767: {
			direction: "vertical",
			autoHeight: true,
		},
		1200: {
			direction: "vertical",
			spaceBetween: 46,
		},
	},
})
var swiper2 = new Swiper(".slider-render", {
	modules: [Thumbs, EffectFade],
	spaceBetween: 10,
	allowTouchMove: false,
	speed: 500,
	thumbs: {
		swiper: swiper,
	},
})

const sliderMini = document.querySelectorAll(".slider-render__slide")
if (sliderMini) {
	sliderMini.forEach((element) => {
		let swiperMini = new Swiper(element.querySelector(".slider-render__slide-slider--thumbnail"), {
			modules: [Thumbs, EffectFade],
			slidesPerView: "auto",
		})

		let swiperRender = new Swiper(element.querySelector(".slider-render__slide-slider"), {
			modules: [Thumbs, EffectFade],
			spaceBetween: 10,
			allowTouchMove: false,
			effect: "fade",
			thumbs: {
				swiper: swiperMini,
			},
		})
	})
}

function clearClass() {
	let items = document.querySelectorAll(".slider-render__slide-slider--thumbnail .swiper-slide")
	items.forEach((element) => {
		element.classList.remove("slide-hover")
		element.classList.remove("slide-hover-2")
		element.classList.remove("slide-hover-3")
		element.classList.remove("slide-hover-4")
	})
}

function hoverSlide() {
	let items = document.querySelectorAll(".slider-render__slide-slider--thumbnail .swiper-slide")
	for (let index = 0; index < items.length; index++) {
		const element = items[index]
		element.addEventListener("mouseover", function () {
			let prevSlide = items[index - 1]
			let prevSlide2 = items[index - 2]
			let prevSlide3 = items[index - 3]

			let nextSlide = items[index + 1]
			let nextSlide2 = items[index + 2]
			let nextSlide3 = items[index + 3]

			element.classList.add("slide-hover")

			if (prevSlide) prevSlide.classList.add("slide-hover-2")

			if (prevSlide2) prevSlide2.classList.add("slide-hover-3")

			if (prevSlide3) prevSlide3.classList.add("slide-hover-4")

			if (nextSlide) nextSlide.classList.add("slide-hover-2")

			if (nextSlide2) nextSlide2.classList.add("slide-hover-3")

			if (nextSlide3) nextSlide3.classList.add("slide-hover-4")
		})

		element.addEventListener("mouseout", clearClass, false)
	}
}

if (window.screen.width > 1024) {
	hoverSlide()
}
