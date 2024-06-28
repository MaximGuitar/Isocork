

export function clearErrors(form) {
	let errors = form.querySelectorAll('.form-elem-error');
	if (!errors)
		return false;

	let inputs = form.querySelectorAll('.form-text-input--error');
	inputs.forEach(input => input.classList.remove('form-text-input--error'));
	errors.forEach(error => error.remove());
}
