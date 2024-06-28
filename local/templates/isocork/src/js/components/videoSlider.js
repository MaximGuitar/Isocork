import KeenSlider from 'keen-slider'
import navigation from '../slider/sliderNavigation'
import { longestArrow } from '../slider/arrows'
import AvtoSwith from "../slider/sliderAvtoSwith"

function videoSlider() {
    const application = document.querySelectorAll('.slider-video')
    if (!application.length)
        return

    function ThumbnailPlugin(main) {
        return (slider) => {
            function removeActive() {
                slider.slides.forEach((slide) => {
                    slide.classList.remove("active")
                })
            }
            function addActive(idx) {
                slider.slides[idx].classList.add("active")
            }

            function addClickEvents() {
                slider.slides.forEach((slide, idx) => {
                    slide.addEventListener("click", () => {
                        main.moveToIdx(idx)
                    })
                })
            }

            slider.on("created", () => {
                addActive(slider.track.details.rel)
                addClickEvents()
                main.on("animationStarted", (main) => {
                    removeActive()
                    const next = main.animator.targetIdx || 0
                    addActive(main.track.absToRel(next))
                    slider.moveToIdx(Math.min(slider.track.details.maxIdx, next))
                })
            })
        }
    }

    const createSlider = section => {
        var slider = new KeenSlider(section.querySelector('.keen-slider--big'))
        var thumbnails = new KeenSlider(section.querySelector('.keen-slider--thumbnail'),
            {
                loop: true, // Циклический режим
                initial: 0,
                slides: {
                    perView: 2,
                    spacing: 15,
                },
                breakpoints: {
                    "(min-width: 767px)": {
                        slides: {
                            perView: 3,
                            spacing: 15,
                        },
                    },
                    "(min-width: 992px)": {
                        slides: {
                            perView: 5,
                            spacing: 15,
                        },
                    },
                    "(min-width: 1280px)": {
                        slides: {
                            perView: 5,
                            spacing: 30,
                        },
                    },
                },

                arrows: {
                    enabled: true,
                    container: section.querySelector('.section-video__arrows'),
                    icon: longestArrow,
                },
                dots: {
                    enabled: false
                },
            },
            [ThumbnailPlugin(slider), navigation,AvtoSwith],
        )
    }

    application.forEach(createSlider)
}
videoSlider();

// Включение/выключение видео
let btnVideo = document.querySelectorAll('.section-video__slide-preview-image');
if (btnVideo) {
    btnVideo.forEach(element => {
        element.addEventListener("click", function () {
            let videoWrap = element;
            videoWrap.classList.toggle('video-play');
            let videoFrame = videoWrap.parentElement.querySelector('iframe');

            console.log(videoFrame);
            videoFrame.src = videoFrame.src + '?autoplay=1';
        })
    });
}