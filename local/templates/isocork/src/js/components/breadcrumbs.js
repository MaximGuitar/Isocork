let breadcrumbsContainer = document.querySelector('#breadcrumbs');
if(breadcrumbsContainer) {
    document.addEventListener("DOMContentLoaded", function(){
        breadcrumbsContainer.appendChild(document.querySelector('ul.breadcrumbs'))
    });
}