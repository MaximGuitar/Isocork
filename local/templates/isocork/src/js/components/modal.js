import { delegate } from "../utils/delegate"

async function response(data, container) {
	let url = window.ajaxModalURL
	const response = await fetch(url, {
		method: "POST",
		headers: {
			"Content-Type": "application/json;charset=utf-8",
		},
		body: JSON.stringify(data),
	})

	let result = await response.text()
	render(result, container)
}

function render(data, container) {
	if (container) {
		container.innerHTML = ""
		container.innerHTML = data
	}
}

function openModal(modal) {
	let closeBtn = modal.querySelector(".close-modal")
	modal.classList.add("modal-open")

	$("body").css("overflow", "hidden")

	if (closeBtn) {
		closeBtn.addEventListener("click", function () {
			closeModal()
		})
	}

	$(document).keydown(function (e) {
		if (e.keyCode == 27) {
			closeModal()
		}
	})

	$(".custom-modal").click(function (e) {
		if ($(e.target).is(".custom-modal")) {
			closeModal()
		}
	})

	//Легендарный костыль #1
	// let place = document.querySelector('.modal-seo__text');
	// console.log(String(place.innerHTML));
	// if (String(place.innerHTML).includes("<p><br></p>"))
	// {
	//     place.remove();
	// }
}

function closeModal() {
	let modalOpen = document.querySelector(".modal-open")
	if (modalOpen) {
		if (modalOpen.classList.contains("modal-open")) {
			modalOpen.classList.remove("modal-open")
		}
	}
	$("body").css("overflow", "auto")
}

const renderModal = async (event, element) => {
	event.preventDefault()

	let modal = document.querySelector(`#modal-${element.dataset.type}`)

	let modalContainer = modal.querySelector("[modal-container]")

	let data = {
		action: element.dataset.type,
		IdIblock: element.dataset.idiblock,
		IdElement: element.dataset.idelement,
		elementCount: element.dataset.id,
		blockElement: element.dataset.block,
		SlideCount: element.dataset.slideid,
		content: window.content,
	}
	await response(data, modalContainer)

	const modalText = document.querySelector("#modal-seo .modal-seo__text")
	modalText?.innerHTML.length < 300
		? modal.classList.add("custom-modal--compact")
		: modal.classList.remove("custom-modal--compact")

	openModal(modal)
}

delegate("click", "[data-modal]", renderModal)
