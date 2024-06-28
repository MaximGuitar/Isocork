import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'

function postSlider(){
	const news = document.querySelectorAll('.post-more')
	if (!news.length)
		return

	const createSlider = section => {
		new KeenSlider(section.querySelector('.keen-slider'), {
			arrows: {
				enabled: true,
				container: section.querySelector('.post-more__arrows'),
				icon: longestArrow,
			},
			dots: {
				enabled: false
			},
			defaultAnimation: {
				duration: 700
			},
            slides: {
                perView: 1,
                spacing: 15,
            },
            breakpoints: {
                "(min-width: 768px)": {
                    slides: {
                        perView: 2,
                        spacing: 45,
                    },
                },
              },
		}, [navigation])
	}
	news.forEach(createSlider)
}
postSlider()