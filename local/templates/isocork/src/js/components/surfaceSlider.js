import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'
import AvtoSwith from "../slider/sliderAvtoSwith"

function surfaceSlider(){
	const surfaces = document.querySelectorAll('.slider-surface')
	if (!surfaces.length)
		return

	const createSlider = section => {
		new KeenSlider(section.querySelector('.keen-slider'), {
            loop: true, // Циклический режим
			arrows: {
				enabled: true,
				container: section.querySelector('.section-surface__arrows'),
				icon: longestArrow,
			},
			dots: {
				enabled: false
			},
			defaultAnimation: {
				duration: 700
			},
            breakpoints: {
                "(min-width: 592px)": {
                    slides: { 
                      perView: 2,
                      spacing: 15,
                    },
                },
                "(min-width: 992px)": {
                    slides: { 
                        perView: 3,
                        spacing: 25,
                    },
                },
                "(min-width: 1400px)": {
                    slides: { 
                        perView: 4,
                        spacing: 45, 
                    },
                },
            }, 
            slides: {
                perView: 1,
                spacing: 15,
            },

		}, [navigation,AvtoSwith])
	}
	surfaces.forEach(createSlider)
}
surfaceSlider()