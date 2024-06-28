function scaleImg(){
	const imgs = document.querySelectorAll('[data-scale-img]')
	if (!imgs.length)
		return

	imgs.forEach(img => {
		img.style.setProperty('--width', `${img.naturalWidth/24}rem`)
		img.style.setProperty('--height', `${img.naturalHeight/24}rem`)
	})
}
window.addEventListener('load', scaleImg)