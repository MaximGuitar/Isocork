import navigation from "../slider/sliderNavigation"
import KeenSlider from 'keen-slider'
import { longestArrow } from "../slider/arrows"
import AvtoSwith from "../slider/sliderAvtoSwith"

function colorSlider() {
    const sliderContainer = document.querySelector('#slider-color')
    if (!sliderContainer)
        return

    let sliderObject = new KeenSlider(sliderContainer.querySelector('.keen-slider'), {
        loop: true, // Циклический режим

        arrows: {
            enabled: true,
            container: sliderContainer.querySelector('.section-color__arrows'),
            icon: longestArrow,
        },
        dots: {
            enabled: false
        },
        defaultAnimation: {
            duration: 700
        },

        slides: {
            spacing: 15,
            perView: 4
        },
        breakpoints: {
            '(min-width: 600px)': {
                slides: {
                    spacing: 20,
                    perView: 6
                },
            },
            '(min-width: 992px)': {
                slides: {
                    spacing: 30,
                    perView: 8
                },
            },
            '(min-width: 1400px)': {
                slides: {
                    spacing: 30,
                    perView: 11
                },
            }
        }
    },
        [navigation, AvtoSwith],
    )
}
colorSlider()