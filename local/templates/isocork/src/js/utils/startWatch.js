export function startWatch({elements, handler, margin="35% 0% 35%", threshold=0, unobserve = true}){
	if (!elements)
		return false

	const callback = (entries, observer) => {
		entries.forEach(entry => {
			handler(entry)
			if(entry.isIntersecting && unobserve)
				observer.unobserve(entry.target)
		})
	}

	const observer = new IntersectionObserver(callback, {rootMargin: margin, threshold: threshold });
	elements.forEach(elem => observer.observe(elem))
}