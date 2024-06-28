import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'

function applicationBefore(container) {
    const sliders = container.querySelectorAll('.section-applicationation__item');
    
    sliders.forEach(slider => {
        const before = slider.querySelector('.section-applicationation__item-before');
        const change = slider.querySelector('.section-applicationation__item-change');
        
        let isActive = false;
        
        const activate = () => isActive = true
        const deactivate = () => isActive = false

        change.addEventListener('mousedown', (event) => {
            console.log(event)
            activate()
        });
        document.addEventListener('mouseup', deactivate);
        document.addEventListener('mouseleave', deactivate);
        
        const beforeAfterSlider = (x) => {
            const shift = Math.max(0, Math.min(x, slider.offsetWidth));
            before.style.width = `${shift}px`;
            change.style.left = `${shift}px`;
        };
        
        const pauseEvents = (e) => {
            e.stopPropagation();
            e.preventDefault();
            return false;
        };
        
        document.addEventListener('mousemove', (e) => {
            if (!isActive)
                return
        
            let x = e.pageX;
            x -= slider.getBoundingClientRect().left;
            beforeAfterSlider(x);
            pauseEvents(e);
        });
        
        change.addEventListener('touchstart', activate);
        document.addEventListener('touchend', deactivate);
        document.addEventListener('touchcancel', deactivate);
        
        document.addEventListener('touchmove', (e) => {
            if (!isActive) {
                return;
            }
        
            let x;
            for (let i = 0; i < e.changedTouches.length; i++) {
                x = e.changedTouches[i].pageX; 
            }
            
            x -= slider.getBoundingClientRect().left;
            
            beforeAfterSlider(x);
            pauseEvents(e);
        });
    });
}

function applicationSlider(){
	const application = document.querySelectorAll('.slider-application')
	if (!application.length)
		return

	const createSlider = section => {
		new KeenSlider(section.querySelector('.keen-slider'), {
            drag: false,
			arrows: {
				enabled: true,
				container: section.querySelector('.section-applicationation__arrows'),
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
            created: () => applicationBefore(section)
		}, [navigation])
	}
	application.forEach(createSlider)
}
applicationSlider()