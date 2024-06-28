import { showError } from "./showError";



export function showErrors(form, errors) {
	for (const key in errors) {
		let field = form.querySelector(`[name="${key}"]`);
		if (!field)
			continue;

		if (typeof errors[key] == "string")
			showError(field, errors[key]);

		else
			showError(field, errors[key][0]);
	}
}
