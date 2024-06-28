export default class Burger{
	constructor(node){
		this.CLASS_OPENED = "burger--opened"
		this.CLASS_CLOSED = "burger--closed"
		this.EVENT_OPEN = new CustomEvent("burgerOpen", {bubbles: true})
		this.EVENT_CLOSE = new CustomEvent("burgerClose", {bubbles: true})
		this.currentState = "closed"
		this.elem = node
		this.elem.addEventListener('click', this.toggleState)
	}

	toggleState = () => {
		if (this.currentState == "closed")
			this.open()
		else
			this.close()
	}

	open(){
		this.currentState = "opened"
		this.elem.classList.add(this.CLASS_OPENED)
		this.elem.classList.remove(this.CLASS_CLOSED)
		this.elem.dispatchEvent(this.EVENT_OPEN)
	}

	close(){
		this.currentState = "closed"
		this.elem.classList.add(this.CLASS_CLOSED)
		this.elem.classList.remove(this.CLASS_OPENED)
		this.elem.dispatchEvent(this.EVENT_CLOSE)
	}

	addAction(handler,once=false){
		this.elem.addEventListener('click', handler, {once})
	}

	removeAction(handler){
		this.elem.removeEventListener('click', handler)
	}
}