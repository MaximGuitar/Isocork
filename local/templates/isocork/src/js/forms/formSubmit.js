export async function formSubmit({ form, action, callback }) {
	if (!form)
		throw new Error('Форма не определена');

	let data = new FormData(form);
	data.append('action', action);
	data.append('href', window.location.href);

	const response = await fetch(window.ajaxURL, {
		body: data,
		method: 'POST'
	});
	const result = await response.json()
	callback({ form, data, result });
}