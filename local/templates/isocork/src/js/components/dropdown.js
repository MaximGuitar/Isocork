export default class Dropdown {
	constructor(select) {
		this.elems = {
			dropdown: select,
			dropdownHeader: select.querySelector('[data-dropdown-header]'),
			dropdownHeaderText: select.querySelector('[data-dropdown-option]'),
			dropdownHeaderInput: select.querySelector('[data-dropdown-input]'),
			dropdownBody: select.querySelector('[data-dropdown-dropdown]'),
			options: select.querySelectorAll('[data-dropdown-item]'),
		};
		// this.startSelector();
		this.initEvents();
		
	}

	initEvents = () => {
		// open dropdown
		this.elems.dropdownHeader.addEventListener('click', this.dropdownOpen);

		// select option
		this.elems.options.forEach(option => {
			option.addEventListener('click', this.selectOption);
		})
	}

	dropdownOpen = event => {
		event.preventDefault()

		this.elems.dropdown.classList.toggle('active');

		window.addEventListener('click', this.documentClick);
	}

	dropdownClose = () => {
		this.elems.dropdown.classList.remove('active');

		window.removeEventListener('click', this.documentClick);
	}

	documentClick = event => {
		if (!this.elems.dropdown.contains(event.target)) {
			this.dropdownClose()
		}
	}

	selectOption = event => {
		event.preventDefault()
		const target = event.currentTarget || event.target;

		this.elems.dropdownHeaderInput.value = target.dataset.select;
		this.elems.dropdownHeaderInput.dataset.calc = target.dataset.calc;
		this.elems.dropdownHeaderText.innerHTML = target.innerHTML;

		this.elems.options.forEach(option => option.classList.remove('selected'));
		target.classList.add('selected');

		this.elems.dropdown.dispatchEvent(new CustomEvent("selected", {
			detail: { target }
		}));

		this.dropdownClose();
	}

	// getQueryParams = () => {
	// 	const queryString = window.location.search.substring(1);
	// 	const params = queryString.split('&');
	// 	const queryParams = {};

	// 	params.forEach((param) => {
	// 		const [key, value] = param.split('=');
	// 		queryParams[key] = decodeURIComponent(value);
	// 	});

	// 	return queryParams;
	// }

	// startSelector = () => {
	// 	const queryParams = this.getQueryParams();
	// 	const prod=(queryParams['product']);
	// 	console.log(prod);
	// 	if (prod == 'napylyaemaya-probka?product') {
	// 		const element = document.querySelector(`[data-calc="${'napylyaemaya'}"]`);
	// 		this.elems.dropdownHeaderInput.value = element.dataset.select;
	// 		this.elems.dropdownHeaderInput.dataset.calc = element.dataset.calc;
	// 		this.elems.dropdownHeaderText.innerHTML = element.innerHTML;
	// 		this.elems.options.forEach(option => option.classList.remove('selected'));
	// 		element.classList.add('selected');
	// 	}
	// }



}


const selets = document.querySelectorAll('[data-dropdown]');
selets.forEach(select => new Dropdown(select));