import KeenSlider from 'keen-slider'

export default function getProjectItems() {
    let projectItems = document.querySelectorAll('[data-project]');
    if(projectItems) {
        projectItems.forEach(element => {
            element.addEventListener("click", function(evt) {
                evt.preventDefault();
                let data = {
                    'action': 'project',
                    'id': element.dataset.id
                }
                response(data)
            })
        });
    }
}

getProjectItems();

async function response(data) {
    const response = await fetch(window.ajaxModalURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    });
    let result = await response.text();
    render(result);
}

function render(data) {
    let modal = document.querySelector('#modal-project .custom-modal-body');
    modal.innerHTML = '';
    modal.innerHTML = data;

    openModal();
    initializationSlider();
    gallery() 
}

export function openModal(container) {
    let modal = document.querySelector(`#modal-project`);
    if(container)
      modal = container
    
    let closeBtn = modal.querySelector(".close-modal");
    modal.classList.add('modal-open');

    $('body').css('overflow','hidden');  

    if(closeBtn) {
        closeBtn.addEventListener("click", function() {
            closeModal();
        })
    }
  
    $(document).keydown(function(e) {        
      if (e.keyCode == 27) {
        closeModal();
      }
    });
  
    $('.custom-modal').click(function(e) {
      if ($(e.target).is('.custom-modal')) {
        closeModal();
      }
    })
}

export function closeModal() {
	let modalOpen = document.querySelector('.modal-open');
    if(modalOpen) {
        if(modalOpen.classList.contains('modal-open')) {
            modalOpen.classList.remove('modal-open');
        }
    }
	$('body').css('overflow','auto');	
}

function initializationSlider() {
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
    
    if(document.querySelector("#project-slider-origin")) {
        var slider = new KeenSlider("#project-slider-origin",
        {
            slides: {
                spacing: 10,
            },
        }
        )
        var thumbnails = new KeenSlider(
            "#project-slider-thumbnails",
            {
                initial: 0,
                slides: {
                  perView: 4,
                  spacing: 10,
                },
                breakpoints: {
                  "(min-width: 768px)": {
                    vertical: true,
                    slides: {
                      perView: 6,
                      spacing: 10,
                    },
                  },
                },
            },
            [ThumbnailPlugin(slider)]
        )
    }
}