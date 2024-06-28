import { lazyLoad } from "../utils/lazyLoad"
import { startWatch } from "../utils/startWatch"


function lazyLoadAssets(){
	const elements = document.querySelectorAll('[data-lazy]')
	if (!elements.length)
		return

	startWatch({
		elements,
		handler: lazyLoad,
		margin: "50% 0% 50%"
	})
}
lazyLoadAssets()