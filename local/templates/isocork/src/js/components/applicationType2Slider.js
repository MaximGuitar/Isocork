import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'

function applicationSlider(){
    const application = document.querySelectorAll('.slider-application-type2')
	if (!application.length)
		return

    const createSlider = section => {
        let slider = new KeenSlider(section.querySelector('.keen-slider'), {
            drag: false,
            arrows: {
                enabled: true,
                container: section.querySelector('.slider-application-type2__arrows'),
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
                "(min-width: 767px)": {
                    slides: { 
                        perView: 3,
                        spacing: 25,
                    },
                },
                "(min-width: 992px)": {
                    slides: { 
                        perView: 4,
                        spacing: 25,
                    },
                },
                "(min-width: 1400px)": {
                    slides: { 
                        perView: 6,
                        spacing: 25, 
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
applicationSlider();