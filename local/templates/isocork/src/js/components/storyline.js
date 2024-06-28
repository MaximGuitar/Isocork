import throttle from "lodash-es/throttle"

class storyLine{
    constructor(container){
        this.container = container
        this.line = this.container.querySelector('[data-line]')
        this.points = this.container.querySelectorAll('[data-point]')
        this.linePosition = 0


        const containerObserver = new IntersectionObserver((entries, observer) => {
            let containerEntry = entries[0]
            if (containerEntry.isIntersecting){
                this._startAnim()
                observer.unobserve(this.container)
            }
        }, {rootMargin: '0px 0px 0px 0px' });
        containerObserver.observe(this.container)

    }
    _startAnim(){
        const throttledFunc = throttle(this._pointsTransform, 200)
        this._pointsTransform = throttledFunc
        window.addEventListener('scroll', this._onScroll)
    }
    _setLinePosition(position){
        this.linePosition = position
        this.line.setAttribute('style', `--translate: ${position}px;`);
    }
    _onScroll = () => {
        this._lineTransform()
        this._pointsTransform()
    }
    _lineTransform(){
        const rect = this.line.getBoundingClientRect();
		const top = rect.top - window.innerHeight * 0.7;
        let linePos

        if( top < 0 ) {
            linePos = top * -1
		} else {
            linePos = 0
        }

        this._setLinePosition(linePos)
    }
    _pointsTransform(){
        const rect = this.line.getBoundingClientRect();
        let skip = false;
        for (let el of this.points){
            let part = el.closest('[data-part]')
            if (skip == false){
                const elRect = el.getBoundingClientRect();
                if( elRect.top <= rect.top + this.linePosition ) {
                    part.classList.add('active');
                }
                else {
                    part.classList.remove('active');
                    skip = true
                }
            }
            else part.classList.remove('active');
        }
    }
}

let storylineContainer =  document.querySelector('#storyline')
if (storylineContainer)
    new storyLine(storylineContainer)