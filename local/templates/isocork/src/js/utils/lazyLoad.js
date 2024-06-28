export function lazyLoad(observerEntry) {
	if (!observerEntry.isIntersecting)
		return

	const element = observerEntry.target

	if (element.nodeName == "PICTURE") {
		let sources = element.querySelectorAll('[data-srcset]');
		sources.forEach(function (source) {
			source.srcset = source.dataset.srcset;
		});

		let img = element.querySelector('[data-src]');
		if (img)
			img.src = img.dataset.src;
	}
	else {
		if (element.dataset.src)
			element.src = element.dataset.src;
		else if (element.dataset.bg)
			element.style.backgroundImage = `url('${element.dataset.bg}')`;
	}
	element.classList.remove('loading');
}
