import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'

function textureSlider(){
    const application = document.querySelectorAll('.slider-texture')
	if (!application.length)
		return

    const createSlider = section => {
        let slider = new KeenSlider(section.querySelector('.keen-slider'), {
            drag: false,
            arrows: {
                enabled: true,
                container: section.querySelector('.section-texture__slider-arrows'),
                icon: longestArrow,
            },
            dots: {
                enabled: false
            },
            defaultAnimation: {
                duration: 700
            },
            breakpoints: {
                "(min-width: 767px)": {
                    slides: { 
                        perView: 3,
                        spacing: 15, 
                    },
                },
                "(min-width: 992px)": {
                    slides: { 
                        perView: 5,
                        spacing: 15, 
                    },
                },
                "(min-width: 1280px)": {
                    slides: { 
                        perView: 5,
                        spacing: 30, 
                    },
                },
            }, 
            slides: {
                perView: 2,
                spacing: 15,
            },
        }, [navigation])
    }

    application.forEach(createSlider)
}
textureSlider();