import KeenSlider from "keen-slider"
import navigation from "../slider/sliderNavigation"
import { shortArrow } from "../slider/arrows"
function featuresSlider() {
	const features = document.querySelectorAll(".slider-features")
	if (!features.length) return

	const createSlider = (section) => {
		let slider = new KeenSlider(
			section.querySelector(".keen-slider"),
			{
				drag: true,
				loop: false,
				arrows: {
					enabled: true,
					container: section.querySelector(".section-features__arrows"),
					icon: shortArrow,
				},
				dots: {
					enabled: false,
				},
				defaultAnimation: {
					duration: 700,
				},
				breakpoints: {
					"(min-width: 592px)": {
						slides: {
							perView: 2,
						},
					},
					"(min-width: 992px)": {
						slides: {
							perView: 3,
						},
					},
					"(min-width: 1279px)": {
						slides: {
							perView: 2,
						},
					},
				},
				slides: {
					perView: 1,
					spacing: 21,
				},
			},
			[navigation]
		)
	}

	features.forEach(createSlider)
}
featuresSlider()
