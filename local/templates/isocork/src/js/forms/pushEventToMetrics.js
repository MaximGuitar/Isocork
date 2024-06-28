export function pushEventToMetrics($eventName) {
	if (typeof dataLayer == 'undefined')
		return false;

	dataLayer.push({ 'event': $eventName });
}