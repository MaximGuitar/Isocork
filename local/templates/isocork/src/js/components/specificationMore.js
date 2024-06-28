let btnMore = document.querySelectorAll('.section-specification__btn-more');

if(btnMore) {
    btnMore.forEach(element => {
        element.addEventListener("click", function() {
            let btnMoreWrapper = element.parentElement;
            let specificationRowsHidden = btnMoreWrapper.querySelectorAll('.section-specification__table-row.hidden');

            if(specificationRowsHidden) {
                specificationRowsHidden.forEach(row => {
                    row.classList.remove('hidden');   
                });
            }

            element.style.display = "none";
        })   
    });
}