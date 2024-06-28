

export function showError(field, text) {
	field.insertAdjacentHTML('beforebegin', `<p class="form-elem-error">${text}</p>`);
	field.classList.add('form-text-input--error');
}
