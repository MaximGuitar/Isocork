import KeenSlider from "keen-slider"
import navigation from "../slider/sliderNavigation"

function mainSlider() {
	const firstScreen = document.querySelector("#first-screen")

	if (!firstScreen) return

	const sliderContainer = firstScreen.querySelector(".main-screen__slider")
	if (!sliderContainer) return

	const slider = new KeenSlider(
		sliderContainer,
		{
			arrows: {
				enabled: false,
			},
			dots: {
				enabled: true,
				container: firstScreen.querySelector(".main-screen__dots-container"),
				className: "main-screen__dots",
			},
			defaultAnimation: {
				duration: 700,
			},
			loop: true,
		},
		[
			(slider) => {
				let timeout
				let mouseOver = false
				function clearNextTimeout() {
					clearTimeout(timeout)
				}
				function nextTimeout() {
					clearTimeout(timeout)

					timeout = setTimeout(() => {
						slider.next()
					}, 15000)
				}
				slider.on("created", () => {
					slider.container.addEventListener("mouseover", () => {
						mouseOver = true
						clearNextTimeout()
					})
					slider.container.addEventListener("mouseout", () => {
						mouseOver = false
						nextTimeout()
					})
					nextTimeout()
				})
				slider.on("dragStarted", clearNextTimeout)
				slider.on("animationEnded", nextTimeout)
				slider.on("updated", nextTimeout)
			},
			navigation,
		]
	)
}
mainSlider()
