import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'

function newsSlider(){
	const news = document.querySelectorAll('.section-slider-news')
	if (!news.length)
		return

	const createSlider = section => {
		new KeenSlider(section.querySelector('.keen-slider'), {
			arrows: {
				enabled: true,
				container: section.querySelector('.section-news__arrows'),
				icon: longestArrow,
			},
			dots: {
				enabled: false
			},
			defaultAnimation: {
				duration: 700
			},
			slides: { 
				spacing: 10,
			},
			breakpoints: {
				'(min-width: 768px)': {
					slides: { 
                        perView: 3,
						spacing: 20,
                    },
				},
				'(min-width: 1279px)': {
					slides: { 
                        perView: 3,
						spacing: 54,
                    },
				}
			}
		}, [navigation])
	}
	news.forEach(createSlider)
}
newsSlider()