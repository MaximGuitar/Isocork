import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'
import AvtoSwith from "../slider/sliderAvtoSwith"

function advantagesType2Slider(){
    const application = document.querySelectorAll('.section-advantages-type2__slider')
	if (!application.length)
		return

    const createSlider = section => {
        new KeenSlider(section.querySelector('.keen-slider'), {
            drag: true,
            loop: true,
            arrows: {
                enabled: true,
                container: section.querySelector('.section-advantages-type2__slider-arrows'),
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
                        perView: 2,
                        spacing: 15, 
                    },
                },
                "(min-width: 1280px)": {
                    slides: { 
                        perView: 3,
                        spacing: 30, 
                    },
                },
            }, 
            slides: {
                perView: 1,
                spacing: 15,
            },
        }, [navigation,AvtoSwith])
    }

    application.forEach(createSlider)
}
advantagesType2Slider();