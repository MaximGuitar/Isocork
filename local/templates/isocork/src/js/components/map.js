import { startWatch } from "../utils/startWatch"

function map(){
	const mapContainer = document.querySelector('#map-container')
	if (!mapContainer)
		return
		
	const setScroll = () => {
		mapContainer.scrollLeft = mapContainer.scrollWidth * 0.42
	}
	window.addEventListener('resize', setScroll)
	setScroll()

	startWatch({
		elements: [mapContainer],
		margin: "0% 0% -60%",
		handler: (entry) => {
			if (entry.isIntersecting)
				entry.target.classList.add('start-anim')
		}
	})
}
map()