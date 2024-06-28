import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longArrow } from '../slider/arrows'

function productsSlider(){
	const sliderContainer = document.querySelector('#products-slider')
	if (!sliderContainer)
		return

	new KeenSlider(sliderContainer.querySelector('.keen-slider'), {
		arrows: {
			enabled: true,
			container: sliderContainer.querySelector('.section-products__controls-container'),
			icon: longArrow
		},
		dots: {
			enabled: false,
		},
		defaultAnimation: {
			duration: 700
		},
		breakpoints: {
			'(min-width: 768px)': {
				disabled: true
			}
		}
	}, [navigation])
}
productsSlider()