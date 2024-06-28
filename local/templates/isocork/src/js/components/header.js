import Burger from "../libs/Burger"
import { startWatch } from "../utils/startWatch"

const headerBurger = new Burger(document.querySelector('#header-burger'))

function mainOverlay(){
  const menu = document.querySelector('#main-overlay')
  const header = document.querySelector('.header')
  if (!menu)
    return

  const toggle = () => {
    header.classList.toggle('menu-opened')
    menu.classList.toggle('opened')
		document.body.classList.toggle('overflow-hidden')
  }
  headerBurger.addAction(toggle)
}
mainOverlay()

function fixedHeader(){
	const header = document.querySelector('.header')
	if (!header)
		return

	if(document.querySelector('#first-screen')) {
		startWatch({
			elements: [document.querySelector('#first-screen')],
			margin: '-12% 0% 0%',
			unobserve: false,
			handler: (entry) => {
				entry.isIntersecting ? header.classList.remove('filled') : header.classList.add('filled')
			}
		})
	} else {
		header.classList.add('filled')
	}
}
fixedHeader()