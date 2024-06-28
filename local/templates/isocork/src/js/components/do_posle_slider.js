function applicationBefore(sliders) {
  
    
    sliders.forEach(slider => {
        const before = slider.querySelector('.section-do-posle__item-before');
        const change = slider.querySelector('.section-do-posle__item-change');
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
    const slider = document.querySelectorAll('.section-do-posle__item');
    applicationBefore(slider);
}
applicationSlider()