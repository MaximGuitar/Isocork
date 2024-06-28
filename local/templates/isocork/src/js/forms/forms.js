import {delegate} from "../utils/utils"
import { clearErrors } from "./clearErrors";
import { formSubmit } from "./formSubmit";
import { pushEventToMetrics } from "./pushEventToMetrics";
import { showErrors } from "./showErrors";

export function toggleFormStatusElement(container, type, action="add", classes=''){
	if (action=="add")
		switch (type){
			case 'preloader':
				container.insertAdjacentHTML('beforeend',
				`
				<div class="form-status ${classes}">
					<div class="preloader">
						<div class="preloader__item preloader__item-1"></div>
						<div class="preloader__item preloader__item-2"></div>
						<div class="preloader__item preloader__item-3"></div>
						<div class="preloader__item preloader__item-4"></div>
						<div class="preloader__item preloader__item-5"></div>
						<div class="preloader__item preloader__item-6"></div>
						<div class="preloader__item preloader__item-7"></div>
						<div class="preloader__item preloader__item-8"></div>
					</div>
				</div>
				`)
				break;
			case 'mail-sent':
				container.insertAdjacentHTML('beforeend',
				`
				<div class="form-status ${classes}">
					<div class="order-result">
						<svg class="order-result__icon order-result__icon--ok" viewBox="0 0 60 42">
							<use xlink:href='${window.templateUrl}/static/images/sprite.svg#ok'/>
						</svg>
						<p class="h1-title pt-sans order-result__title">Заявка отправлена</p>
						<div class="order-result__btn btn btn--default-height" data-micromodal-close>Хорошо</div>
					</div>
				</div>
				`)
				break;
			case 'ok':
				container.insertAdjacentHTML('beforeend',
				`
				<div class="form-status ${classes}">
					<svg class="form-status__ok-icon" viewBox="0 0 60 42">
						<use xlink:href='${window.templateUrl}/static/images/sprite.svg#ok'/>
					</svg>
				</div>
				`)
				break;
		}
	else
		container.querySelector('.form-status').remove()
}

const horizontalFormSubmit = (event, form) => {
	event.preventDefault()

	const btn = form.querySelector('[data-submit-btn]')
	btn.disabled = true
	toggleFormStatusElement(btn, 'preloader', 'add', 'form-status--smaller')

	const callback = ({form ,data, result}) => {
		console.log(result)

		toggleFormStatusElement(btn, 'preloader', 'remove')
		clearErrors(form)

		switch (result.status){
			case "success":
				toggleFormStatusElement(btn, 'ok', 'add', 'form-status--smaller')
				setTimeout(() => {
					btn.disabled = false
					toggleFormStatusElement(btn, 'ok', 'remove')
				},4000)
	
				const formID = data.get('form-id')
				pushEventToMetrics(`mail-sent: ${formID}`)
				break
	
			case "not-valid":
				btn.disabled = false
				showErrors(form, result.errors)
				break
	
			default:
				if (result.message)
					console.log(result.message)
				break
		}
	}

	formSubmit({
		form,
		action: 'feedback',
		callback
	})
}
delegate("submit", "[data-form]", horizontalFormSubmit)