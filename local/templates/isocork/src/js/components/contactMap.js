import { openModal, closeModal } from "./projectPage"

async function response(data, container, url = false) {
	if (!url) url = window.ajaxContactURL
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
	if (container.classList.contains("custom-modal")) {
		container.querySelector(".modal-contact__head").innerHTML = ""
		container.querySelector(".modal-contact__head").innerHTML = data
	} else {
		container.innerHTML = ""
		container.innerHTML = data
	}

	openModal(container)
}

export class YmapContact {
	constructor(map, dataOrigin = false) {
		this.details = {
			map,
			markers: map.querySelectorAll(".markers"),
			zoom: 15,
			marker: {
				icon: map.dataset.markerImg,
				iconActive: map.dataset.markerImgActive,
				iconHover: map.dataset.markerImgHover,
				height: map.dataset.markerHeight,
				width: map.dataset.markerWidth,
			},
		}
		this.init()
	}

	init() {
		this.ymap = new ymaps.Map(this.details.map.id, {
			center: [this.details.markers[0].dataset.lat, this.details.markers[0].dataset.lng],
			zoom: this.details.zoom,
			controls: [],
		})
		this.objectManager = new ymaps.ObjectManager({
			clusterize: true,
		})

		this.objectManager.objects.options.set({
			iconLayout: "default#image",
			iconImageHref: this.details.marker.icon,
			iconImageSize: [this.details.marker.width * 1, this.details.marker.height * 1],
			iconImageOffset: [(this.details.marker.width / 2) * -1, this.details.marker.height * -1],
		})
		this.objectManager.clusters.options.set({
			preset: "islands#nightClusterIcons",
			clusterIconColor: "#1E98FF",
		})

		this.ymap.geoObjects.add(this.objectManager)

		this.addMarkers()

		this.objectManager.objects.events.add("click", (e) => {
			const id = e.get("objectId")

			const marker = this.details.markers[id]
			if (!marker) return

			let formTitle = document.querySelector('#modal-contact input[name="form-title"]')
			formTitle.value = marker.dataset.name

			let formAddress = document.querySelector('#modal-contact input[name="form-address"]')
			formAddress.value = marker.dataset.address

			const containerMap = this.details.map.closest(".container-map")
			const address = containerMap.querySelector(`.contact__address[data-mark="${id}"]`)
			if (address) address.scrollIntoView({ behavior: "smooth", block: "center", inline: "nearest" })

			response(
				{
					action: "contact",
					id: marker.dataset.id,
				},
				document.querySelector("#modal-contact"),
				window.ajaxModalURL
			)
		})
	}

	addMarkers() {
		this.objectManager.removeAll()

		let myPlacemarks = {
			type: "FeatureCollection",
			features: [],
		}

		this.details.markers.forEach((coordinate, index) => {
			let data = {
				action: "contact",
				id: coordinate.dataset.id,
			}

			myPlacemarks.features.push({
				type: "Feature",
				id: index,
				geometry: {
					type: "Point",
					coordinates: [parseFloat(coordinate.dataset.lat), parseFloat(coordinate.dataset.lng)],
				},
			})
		})

		this.objectManager.add(myPlacemarks)

		this.centerMap()
		this.ymap.container.fitToViewport()

		this.clickAddress()
	}

	clickAddress() {
		var objectManager = this.objectManager
		var iconActive = this.details.marker.iconActive
		var iconHover = this.details.marker.iconHover
		var icon = this.details.marker.icon

		let citys = document.querySelectorAll(".contact-city__item")
		var activeElement = citys[0]
		var activeAr = activeElement.dataset.mark

		objectManager.objects.setObjectOptions(activeElement.dataset.mark, {
			iconImageHref: iconActive,
		})

		if (citys) {
			citys.forEach((element) => {
				element.addEventListener("click", function () {
					let markId = this.dataset.mark
					if (activeAr !== markId) {
						objectManager.objects.setObjectOptions(activeAr, {
							iconImageHref: icon,
						})
					}

					activeAr = markId

					objectManager.objects.setObjectOptions(markId, {
						iconImageHref: iconActive,
					})
				})
			})
		}

		let contacts = document.querySelectorAll(".contact__address")
		if (!contacts.length) return

		contacts.forEach((element) => {
			element.addEventListener("mouseover", function () {
				let markId = this.dataset.mark
				objectManager.objects.setObjectOptions(markId, {
					iconImageHref: iconHover,
				})
			})

			element.addEventListener("mouseout", function () {
				let markId = this.dataset.mark
				objectManager.objects.setObjectOptions(markId, {
					iconImageHref: icon,
				})
			})
		})
	}

	centerMap() {
		if (this.details.markers.length > 1) {
			this.ymap.setBounds(this.ymap.geoObjects.getBounds(), { checkZoomRange: true }).then(function () {
				if (this.ymap.getZoom() > 15) this.ymap.setZoom(15)
			})
		}
	}
}
