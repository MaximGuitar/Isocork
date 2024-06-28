import { delegate } from "../utils/delegate";

function circleDiagramm() {  
    let activeTab = ''; 
    let activeContent = ''; 

    const initTab = () => {
        const tabs = document.querySelectorAll('.button_circle');
        const tabsContent = document.querySelectorAll('.diagram_circle');

        if(tabs.length > 0 && tabsContent) {
            activeTab = tabs[0];
            tabs[0].classList.add('active');

            activeContent = tabsContent[0];
            tabsContent[0].classList.add('visible');
        }
    }
    initTab();
    
    const updateTabContent = id => {    
        let tabsContent = document.querySelector(`[data-tab-item="${id}"]`);

        activeContent.classList.remove('visible');
        activeContent = tabsContent;
        activeContent.classList.add('visible');
    }

    const openTab = (event, element) => {
        event.preventDefault()
    
        if (element !== activeTab ) {
            activeTab.classList.remove('active');
            activeTab = element;
            activeTab.classList.add('active');

            updateTabContent(element.dataset.tabId);
        }
    }
    
    delegate('click', '[data-tab-diagramm]', openTab)
}

circleDiagramm();