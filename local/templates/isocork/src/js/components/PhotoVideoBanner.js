import Swiper from "swiper"
import { Navigation, Pagination, Autoplay } from "swiper/modules"

function PhotoVideoSlider() {
	let swiper = new Swiper("#VideoPhotoSlider", {
		modules: [Pagination, Autoplay],
		loop: true,
		autoplay: {
			delay: 5000,
		},
	})
}

//window.addEventListener('load', function () {
PhotoVideoSlider()
//})
