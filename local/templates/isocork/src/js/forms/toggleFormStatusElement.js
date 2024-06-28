export function toggleFormStatusElement(container, type, action = "add", classes = '') {
	if (action == "add")
		switch (type) {
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
				`);
				break;
			case 'mail-sent':
				container.insertAdjacentHTML('beforeend',
					`
				<div class="form-status ${classes}">
					<div class="order-result">
						<svg class="order-result__icon order-result__icon--ok" viewBox="0 0 60 42" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M59.553 0.431737C60.143 1.01329 60.1498 1.96302 59.5683 2.553L21.0429 41.6367L0.431737 20.7269C-0.14982 20.1369 -0.142987 19.1872 0.446998 18.6056C1.03698 18.0241 1.98671 18.0309 2.56826 18.6209L21.0429 37.3633L57.4317 0.446998C58.0133 -0.142987 58.963 -0.14982 59.553 0.431737Z"/>
						</svg>
						<p class="h1-title pt-sans order-result__title">Заявка отправлена</p>
						<div class="order-result__btn btn btn--default-height" data-micromodal-close>Хорошо</div>
					</div>
				</div>
				`);
				break;
			case 'ok':
				container.insertAdjacentHTML('beforeend',
				`
				<div class="form-status ${classes}">
					<svg class="form-status__ok-icon" viewBox="0 0 60 42" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M59.553 0.431737C60.143 1.01329 60.1498 1.96302 59.5683 2.553L21.0429 41.6367L0.431737 20.7269C-0.14982 20.1369 -0.142987 19.1872 0.446998 18.6056C1.03698 18.0241 1.98671 18.0309 2.56826 18.6209L21.0429 37.3633L57.4317 0.446998C58.0133 -0.142987 58.963 -0.14982 59.553 0.431737Z"/>
					</svg>
				</div>
				`);
				break;
		}

	else
		container.querySelector('.form-status').remove();
}