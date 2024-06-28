export default function navigation(slider) {
    let timeout
    let mouseOver = false
    let click = false
    function clearNextTimeout() {
        clearTimeout(timeout)
    }
    function nextTimeout() {
        clearTimeout(timeout)
        if (mouseOver || click) return
     
        timeout = setTimeout(() => {
            slider.next()
        }, 1000)
    }
    slider.on("created", () => {
        slider.container.addEventListener("mouseover", () => {
            mouseOver = true
            clearNextTimeout()
        })
        slider.container.addEventListener("mouseout", () => {
            mouseOver = false          
            nextTimeout()
        })

        slider.container.addEventListener("click", () => {
            mouseOver = true
            click = true
            nextTimeout()
        })

    })

    slider.container.addEventListener("mouseover", () => {
        mouseOver = true
        clearNextTimeout()
    })
    slider.on("dragStarted", clearNextTimeout)
    slider.on("animationEnded", nextTimeout)
    slider.on("updated", nextTimeout)

}