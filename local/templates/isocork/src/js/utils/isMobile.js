export function isMobile(media = "(max-width: 1279px)"){
	return window.matchMedia(media).matches
}