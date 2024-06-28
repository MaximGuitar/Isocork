import { delegate } from "../utils/delegate";
import { toggleFormStatusElement } from '../forms/toggleFormStatusElement'
import { clearErrors } from '../forms/clearErrors'
import { showErrors } from '../forms/showErrors'
import { formSubmit } from '../forms/formSubmit'
import './dropdown'

async function phoneMask(){
	const inputs = document.querySelectorAll('[type="tel"]')
	if (!inputs.length)
	  return
  
	const smask = await import('smask')
  
	inputs.forEach(input => {
	  smask.input(input, ['+d (ddd) ddd-dd-dd'])
	})
  }
phoneMask()

function reziseTextarea() {
	var textarea = document.querySelectorAll('textarea.form-input--textarea');

	for (var i = 0; i < textarea.length; i++) {
		textarea[i].setAttribute('style', 'height:' + (textarea[i].scrollHeight) + 'px;overflow-y:hidden;');
		textarea[i].addEventListener("input", OnInput, false);
	}  

	function OnInput() {
		this.style.height = 'auto';
		this.style.height = (this.scrollHeight) + 'px';
	}
}
reziseTextarea();

function addFiles() {
	let fileAdd = document.querySelectorAll('#file-uploader');
	fileAdd.forEach(function(val) {
		val.addEventListener("change", function(evt) {
			let infoFile = this.parentElement.querySelector('.file-information');
			if(this.value) {
				this.parentElement.classList.remove('error');
				let files = this.files;
				let name;

				for (const file of files) {
				    name = file.name;
				} 

				let spanLast = this.parentElement.querySelector('.file-title');
				let spanText = this.parentElement.querySelector('.file-text');

				if(spanLast) {
					spanLast.remove()
					if(spanText) 
						spanText.remove()
				}

				let span = document.createElement('span');
				span.className = "file-title";
				span.textContent = name;

				infoFile.append(span)
			}
		})
	})
}
addFiles();

const feedbackFormSubmit = (event, form) => {
	event.preventDefault()

	let btn = form.querySelector('[data-submit-btn]')
	btn.disabled = true
	toggleFormStatusElement(btn, 'preloader', 'add', 'form-status--smaller')

	let captchResponse = form.querySelector('.g-recaptcha-response');
	let captchInput = form.querySelector('input[name="recaptcha-value"]');
	let recaptchaWrap = form.querySelector('.form-recaptcha');

	if(captchResponse) {
		if (!captchResponse.value.length) {
			recaptchaWrap.classList.add('error');
			captchInput.value = 'not-valid';
		} else {
			recaptchaWrap.classList.remove('error');
			captchInput.value = 'valid';
		}
	}

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
					form.reset() 
					//initTelMask();

					if(recaptchaWrap) {
						if(recaptchaWrap.dataset.recaptcha) {
							grecaptcha.reset(recaptchaWrap.dataset.recaptcha)
						} else {
							grecaptcha.reset()
						}
					}
					
				},4000)
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

delegate('submit', '[data-form]', feedbackFormSubmit)