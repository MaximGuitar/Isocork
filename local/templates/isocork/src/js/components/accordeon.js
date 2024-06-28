import { slideToggle } from "../utils/collapse";
import { delegate } from "../utils/delegate"

function accordeon(){
	delegate('click', '[data-accordeon-toggle]', (e, target) => {
		const parent = target.closest('[data-accordeon]')
		const collapse = parent.querySelector('[data-accordeon-collapse]')
		if (collapse){
			slideToggle(collapse)
			parent.classList.toggle('opened')
		}
	})
}
accordeon()