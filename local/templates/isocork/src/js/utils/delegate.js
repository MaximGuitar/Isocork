export function delegate(eventName, elementSelector, handler,listener=document){
	if (!listener)
		return false;
		
	listener.addEventListener(eventName, function(e){
		for (let target = e.target; target && target != this; target = target.parentNode) {
			if (target.matches(elementSelector)) {
				handler.call(target, e, target);
				break;
			}
		}
	});
}