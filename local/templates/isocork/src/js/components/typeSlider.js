import navigation from "../slider/sliderNavigation"
import KeenSlider from 'keen-slider'
import { longestArrow } from "../slider/arrows"

function typeSlider(){
	const sliderContainer = document.querySelector('#slider-type')
	if (!sliderContainer)
		return

    if(window.screen.width > 992) {
        let firstSlide = sliderContainer.querySelector('.section-type__item:first-child')
        let activeSlide = firstSlide;
        activeSlide.classList.add('active');

        var idSlide = setInterval(function(){
            activeSlide.classList.remove('active')
            var next = activeSlide.nextElementSibling;
            if(!next)
                next = firstSlide;

            next.classList.add('active');

            activeSlide = next;
        }, 6500);   

        let slides = sliderContainer.querySelectorAll('.section-type__item')
        if(slides) {
            slides.forEach(element => {
                element.addEventListener("mouseover", function() {
                    activeSlide.classList.remove('active')
                    var next = element;
                    if(!next)
                        next = firstSlide;
        
                    next.classList.add('active');
        
                    activeSlide = next;
                    clearInterval(idSlide);
                })
            });
        }
    }


    new KeenSlider(sliderContainer.querySelector('.keen-slider'), {
        arrows: {
            enabled: true,
            container: sliderContainer.querySelector('.section-type__arrows'),
            icon: longestArrow,
        },
        dots: {
            enabled: false
        },
        defaultAnimation: {
            duration: 700
        },

        slides: {
            spacing: 20,
		},

        breakpoints: {
            '(min-width: 992px)': {
                disabled: true
            }
        }
    }, [navigation])
}
typeSlider()