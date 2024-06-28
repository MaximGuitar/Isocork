import { YmapContact } from "./contactMap"
import { MiniBar } from "minibarjs"
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

  if (container.classList.contains("map")) {
    initMaps(container)
  } else if (container.classList.contains("contact-region__search-wrap")) {
    selectRegion()
  } else if (container.classList.contains("custom-modal")) {
    openModal(container)
  } else {
    scrollbarText(container)
    clickAddress()
  }

  selectDistributors()
}

function selectCity() {
  let citys = document.querySelectorAll(".contact-city__item")
  let containerCity = document.querySelector(".contact-scrollbar:not(.contact-distributor__scrollbar)")
  var activeElement = citys[0]

  if (!citys.length || !containerCity) return

  citys.forEach((element) => {
    element.addEventListener("click", function () {
      if (!element.classList.contains("active")) {
        activeElement.classList.remove("active")
        activeElement = element
        activeElement.classList.add("active")

        let data = {
          action: "contact",
          cityId: this.dataset.city,
        }

        response(data, containerCity)
      }
    })
  })
}

function scrollbarText(container = false) {
  let scrollSection = document.querySelectorAll(".contact-content.visible .scrollbar-rail")
  if (container) {
    if (!container.classList.contains("scrollbar-rail")) {
      scrollSection = container.querySelector(".scrollbar-rail")
    } else {
      scrollSection = container
    }

    let barScroll = new MiniBar(scrollSection, {
      hideBars: false,
      alwaysShowBars: true,
    })
    barScroll.update()
  }

  if (!scrollSection.length) return

  const createScrollbar = (section) => {
    let bar = new MiniBar(section, {
      hideBars: false,
      alwaysShowBars: true,
    })

    bar.update()
  }

  scrollSection.forEach(createScrollbar)
}

function displayRegion() {
  let regionBtn = document.querySelector(".contact-region")
  let regionContainer = document.querySelector(".contact-region__scrollbar")
  if (!regionBtn || !regionContainer) return

  regionBtn.addEventListener("click", function () {
    regionContainer.classList.toggle("active")
    regionBtn.classList.toggle("active")
  })
}

let data = {
  action: "",
  region: "",
  type: "",
}

function selectDistributors() {
  let distributors = document.querySelectorAll(".contact-distributor__item")

  if (!distributors) return

  let containerDistributors = document.querySelector(".contact-distributor__scrollbar")
  let distributorsMap = document.querySelector("#map-2")
  let distributorsActive = distributors[0]

  distributors.forEach((element) => {
    element.addEventListener("click", function () {
      let type = this.dataset.type

      if (!element.classList.contains("active")) {
        distributorsActive.classList.remove("active")
        distributorsActive = element
        distributorsActive.classList.add("active")

        data.action = "distributors"
        data.type = type
        response(data, containerDistributors)

        setTimeout(() => {
          data.action = "distributorsMap"
          response(data, distributorsMap)
        }, 200)
      }
    })
  })
}

function searchRegion() {
  let inputSearch = document.querySelector(".contact-region__search")
  if (!inputSearch) return
  let regionWrap = document.querySelector(".contact-region__search-wrap")
  inputSearch.addEventListener("keyup", (evt) => {
    let dataSearch = {
      action: "search",
      word: inputSearch.value,
    }

    response(dataSearch, regionWrap)
  })

  selectRegion()
}

function selectRegion() {
  const regions = document.querySelectorAll(".contact-region__item")
  if (!regions) return

  const containerDistributors = document.querySelector(".container-content__wrap")
  const distributorsMap = document.querySelector("#map-2")
  const regionBtn = document.querySelector(".contact-region")
  const regionsReset = document.querySelector(".region-reset")
  const regionContainer = document.querySelector(".contact-region__scrollbar")

  regions.forEach((element) => {
    element.addEventListener("click", function (evt) {
      let regionId = this.dataset.region
      data.region = regionId

      let dataRegion = {
        action: "region",
        region: regionId,
      }

      response(dataRegion, containerDistributors)

      dataRegion = {
        action: "distributorsMap",
        region: regionId,
      }

      response(dataRegion, distributorsMap)

      regionBtn.querySelector(".contact-region__text").textContent = this.textContent

      regionContainer.classList.remove("active")
      regionBtn.classList.remove("active")

      regionsReset.classList.add("active")
    })
  })

  regionsReset.addEventListener("click", () => {
    response(
      {
        action: "region",
      },
      containerDistributors
    )

    response(
      {
        action: "distributorsMap",
      },
      distributorsMap
    )

    regionsReset.classList.remove("active")
    regionBtn.querySelector(".contact-region__text").textContent = "Выбрать регион"
  })
}

function selectType() {
  let selects = document.querySelectorAll(".contact-type__item")
  if (!selects.length) return

  let activeSelect = selects[0]
  selects.forEach((select) => {
    select.addEventListener("click", function (evt) {
      evt.preventDefault()
      if (activeSelect !== select) {
        activeSelect.classList.remove("active")

        document
          .querySelector('.contact-content[data-item="' + activeSelect.dataset.type + '"]')
          .classList.remove("visible")
        activeSelect = select
        activeSelect.classList.add("active")
        document
          .querySelector('.contact-content[data-item="' + activeSelect.dataset.type + '"]')
          .classList.add("visible")
        scrollbarText()
        initMaps(document.querySelector(".contact-content.visible .map"))
      }
    })
  })

  if (location.hash == "#gdecupittab") {
    selects[1].click()
  }
}

function clickAddress() {
  let address = document.querySelectorAll(".contact__address")
  if (!address.length) return

  address.forEach((element) => {
    element.addEventListener("click", function () {
      let data = {
        action: "contact",
        id: this.dataset.id,
      }

      let formTitle = document.querySelector('#modal-contact input[name="form-title"]')
      formTitle.value = this.dataset.name

      let formAddress = document.querySelector('#modal-contact input[name="form-address"]')
      formAddress.value = this.dataset.address

      response(data, document.querySelector("#modal-contact"), window.ajaxModalURL)
    })
  })
}

function initMaps(container) {
  if (container.querySelectorAll("ymaps").length === 0) {
    new YmapContact(container)
  }
}

const maps = document.querySelector(".map")
if (maps) {
  document.addEventListener("DOMContentLoaded", () => {
    const script = document.createElement("script")
    script.src = "//api-maps.yandex.ru/2.1/?lang=ru_RU&onload=initMap"
    document.head.appendChild(script)
  })
}

window.initMap = () => {
  new YmapContact(maps)

  selectCity()
  scrollbarText()
  displayRegion()
  selectDistributors()
  searchRegion()
  clickAddress()
  selectType()
}
