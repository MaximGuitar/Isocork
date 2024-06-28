import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'

function squareLinkBlocksSlider(){
  const sliders = document.querySelectorAll('.square-link-blocks-slider')
	if (!sliders.length)
		return

  sliders.forEach(slider => {
    new KeenSlider(slider.querySelector('.keen-slider'), {
      arrows: {
        enabled: true,
        container: slider.querySelector('.arrows'),
        icon: longestArrow
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
  })
}
squareLinkBlocksSlider()