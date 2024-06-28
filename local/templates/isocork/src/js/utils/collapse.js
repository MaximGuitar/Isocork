function isCollapsed(element) {
	return element.classList.contains('is-collapsed');
}
function onSchedule(fn) {
	requestAnimationFrame(function() {
		requestAnimationFrame(function() {
		  fn();
		});
	});
}
function slideOpen(element){
	element.style.height = `${element.scrollHeight}px`;
	onSchedule(function(){
		element.classList.remove('is-collapsed');
		element.addEventListener("transitionend", function onTransitionEnd() {
			element.removeEventListener("transitionend", onTransitionEnd);
			element.style.height = "";
		});  
	})
}
function slideClose(element){
	element.style.height = `${element.scrollHeight}px`;
	onSchedule(function() {
		element.classList.add('is-collapsed');
		element.style.height = "";
	});
}
export function slideToggle(element){
	isCollapsed(element) ? slideOpen(element) : slideClose(element);
}