import Dropdown from './dropdown';

async function response(data, container) {
    let url = window.ajaxCalcURL

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    });
    let result = await response.text();
    result = JSON.parse(result);
    render(result, container);
}

function render(data, container) {
    if(container) {
        $(container).contents().not('[data-visible]').remove();
        // container.innerHTML = data.code;
        container.insertAdjacentHTML('beforeend', data.code);

        let notesWrap = document.querySelector('.calculate-form__notes-text');
        if(notesWrap) 
            notesWrap.innerHTML = data.note;

        let notesUnits = document.querySelector('.calculate-form__result-unit');
        if(notesUnits)
            notesUnits.innerHTML = data.unit;
    }

    dropdown(container);
    calculate()
}

const dropdown = (container) => {
    let selets = container.querySelectorAll('.calculate-form__filters:not([data-visible]) [data-dropdown]');
    selets.forEach(select => new Dropdown(select));

    dropdownType();
}

const renderModal = (event, element) => {
    let calcContainer = document.querySelector('[data-calc-wrap]');

    let data = {
        'action': 'calc',
        'type': event.currentTarget.dataset.calc
    }

    if(event.currentTarget.hasAttribute('data-dropdown-item-type')) {
        if(event.currentTarget.dataset.calc === 'napylyaemaya' || event.currentTarget.dataset.calc === 'shtukaturka') {
            cleanInputs();
            let inputDiament = document.querySelector('[name=diameter]');
            hiddenInput(inputDiament);
        } else {
            cleanInputs();
        }
    }
    
    response(data, calcContainer)
}

const dropdownType = () => {
    let dropdownTypeOption = document.querySelectorAll('[data-dropdown-item-type]');

    dropdownTypeOption.forEach(option => {
        option.addEventListener('click', renderModal);
    })

    let dropdownOptions = document.querySelectorAll('[data-dropdown-item]');
    dropdownOptions.forEach(option => {
        option.addEventListener('click', calculate);
    })

    let dropdownArchitectureOption = document.querySelectorAll('[data-dropdown-item-architecture]');

    dropdownArchitectureOption.forEach(options => {
        options.addEventListener('click', renderUnit);
    })
} 
dropdownType();

function calculate() {
    let calculateForm = document.querySelector('.calculate-form');
    let calcResult;

    if(!calculateForm)
        return;

    if(calculateForm) {
        let calcInputs = calculateForm.querySelectorAll('.form-number');
        calcResult = calculateForm.querySelector('.calculate-form__result-num');

        calcInputs.forEach(element => {
            element.addEventListener("change", function() {
                calculationWeight()
            }) 
        });
    }

    function calculationWeight() {
        let height = calculateForm.querySelector('.form-number[name="height"]').value ? parseFloat(calculateForm.querySelector('.form-number[name="height"]').value) : 0;
        let lenght = calculateForm.querySelector('.form-number[name="lenght"]').value ? parseFloat(calculateForm.querySelector('.form-number[name="lenght"]').value) : 0;
        let weight = calculateForm.querySelector('.form-number[name="weight"]').value ? parseFloat(calculateForm.querySelector('.form-number[name="weight"]').value) : 0;
        let diameter = calculateForm.querySelector('.form-number[name="diameter"]').value ? parseFloat(calculateForm.querySelector('.form-number[name="diameter"]').value) : 0;
        const formulas = {
            'napylyaemaya-wall-fasad' : (`${lenght}` * `${height}` * 2),
            'napylyaemaya-wall-interior' : (`${lenght}` * `${height}` * 1.5),
            'napylyaemaya-wall-ceil' : (`${lenght}` * `${weight}` * 1.8),
            'napylyaemaya-house-fasad' : ((parseFloat(`${lenght}`) + parseFloat(`${weight}`)) * 2) * `${height}` * 2,
            'napylyaemaya-house-interior' : ((parseFloat(`${lenght}`) + parseFloat(`${weight}`)) * 2) * `${height}` * 1.5,
            'napylyaemaya-house-ceil' : (`${lenght}` * `${weight}` * 1.8),
            'shtukaturka-wall-fasad' : (`${lenght}` * `${height}` * 1.5),
            'shtukaturka-wall-interior' : (`${lenght}` * `${height}` * 1),
            'shtukaturka-wall-ceil' : (`${lenght}` * `${weight}` * 1.2),
            'shtukaturka-house-fasad' : ((parseFloat(`${lenght}`) + parseFloat(`${weight}`)) * 2) * `${height}` * 1.5,
            'shtukaturka-house-interior' : ((parseFloat(`${lenght}`) + parseFloat(`${weight}`)) * 2) * `${height}` * 1,
            'shtukaturka-house-ceil' : (`${lenght}` * `${weight}` * 1.2),
            'germetik-wall-10' : ((`${height}` / `${diameter}`) * `${lenght}`) / 5,
            'germetik-wall-20' : ((`${height}` / `${diameter}`) * `${lenght}`) / 3,
            'germetik-house-10' : ((parseFloat(`${lenght}`) + parseFloat(`${weight}`)) * 2) * (`${height}` / `${diameter}`) / 5,
            'germetik-house-20' : ((parseFloat(`${lenght}`) + parseFloat(`${weight}`)) * 2) * (`${height}` / `${diameter}`) / 3,
            'germetik-joint-10' : (((parseFloat(`${height}`) * parseFloat(`${weight}`) )* parseFloat(`${lenght*10000}`))) / 4,
            'germetik-joint-20' : (((parseFloat(`${height}`) * parseFloat(`${weight}`) )* parseFloat(`${lenght*10000}`))) / 4,
        }

        let type = calculateForm.querySelector('[name="select-type"]');
        let work = calculateForm.querySelector('[name="select-work"]');
        let local = calculateForm.querySelector('[name="select-local"]');
        let seam = calculateForm.querySelector('[name="select-seam"]');


        let formula = [];
        if(type)
            formula.push(type.dataset.calc);

        if(local)
            formula.push(local.dataset.calc);

        if(work)
            formula.push(work.dataset.calc);

        if(seam)
            formula.push(seam.dataset.calc);

        let formulaStr = formula.join("-");

        let result = Math.ceil(formulas[formulaStr]);

        if(isFinite(result)) {
            changeFormResult(result)
        } else {
            changeFormResult(0)
        }
            
    }
    calculationWeight()

    filter(calculateForm);

    function changeFormResult(result) {
        calcResult.textContent = result;
        changeInputResult(calculateForm);
    }
}
calculate();

function renderUnit(option) {
    let notesUnits = document.querySelector('.calculate-form__result-unit');
    if(notesUnits) {
        if(option.currentTarget.dataset.calc === 'cartouche') {
            notesUnits.innerHTML = 'шт. картушей.';
            changeSelect(option, "sausage", "cartouche");
            let seam = document.querySelector('[name="select-seam"]');
            if(seam) {
                displayBlock(seam, 'visible')
            }
        } else if(option.currentTarget.dataset.calc === 'sausage') {
            notesUnits.innerHTML = 'шт. колб.';
            changeSelect(option, "cartouche", "sausage");
            let seam = document.querySelector('[name="select-seam"]');
            if(seam){
                displayBlock(seam)
            }
        }
    }

    function displayBlock(block, type="hidden") { // Отображение блока Размер шва в зависимости от выбора Колбасы или Картуш
        if(type == 'visible') {
            block.closest('.calculate-form__filters').style.display = "none";
            block.closest('.calculate-form__filters').style.visibility = "hidden";
        } else {
            block.closest('.calculate-form__filters').style.display = "block";
            block.closest('.calculate-form__filters').style.visibility = "visible";
        }
    }

    function changeSelect(option, hidden, visible) { // Скрытие элементов списка для Колбасы и Картуш
        let drop = option.currentTarget.closest('[data-calc-wrap]').querySelector('[data-dropdown-architecture]');
        let dropOpt = drop.querySelectorAll('[data-dropdown-item]');
        dropOpt.forEach(element => element.classList.remove('hidden'));

        let dropOptSelect = drop.querySelectorAll(`[data-formula="${hidden}"]`);
        dropOptSelect.forEach(element => element.classList.add('hidden'));

        let dropOptActive = drop.querySelectorAll(`[data-formula="${visible}"]`);
        dropOptActive[0].click();
    }
}

function cleanInputs() {
    let inputs = document.querySelectorAll('.calculate-form__params-item');
    inputs.forEach(element => element.classList.remove('hidden'));
}

function cleanInputsDisabled() {
    let inputs = document.querySelectorAll('.calculate-form__params-item');
    inputs.forEach(element => element.classList.remove('disabled'));
}

function hiddenInput(input) {
    input.parentElement.classList.add('hidden');
}

function filter(calculateForm) { // Блокировка полей
    cleanInputsDisabled();
    let type = calculateForm.querySelector('[name="select-type"]');
    let work = calculateForm.querySelector('[name="select-work"]');
    let local = calculateForm.querySelector('[name="select-local"]');
    let seam = calculateForm.querySelector('[name="select-seam"]');

    let height = calculateForm.querySelector('.form-number[name="height"]');
    let weight = calculateForm.querySelector('.form-number[name="weight"]');
    let diameter = calculateForm.querySelector('.form-number[name="diameter"]');

    if(type)
        type = calculateForm.querySelector('[name="select-type"]').dataset.calc;
    if(work)
        work = calculateForm.querySelector('[name="select-work"]').dataset.calc;
    if(local)
        local = calculateForm.querySelector('[name="select-local"]').dataset.calc;
    if(seam)
        seam = calculateForm.querySelector('[name="select-seam"]').dataset.calc;

    if(type === 'napylyaemaya' || type === 'shtukaturka') {
        if(local === 'wall') {
            if(work === 'fasad' || work === 'interior') {
                weight.parentElement.classList.add('disabled');
            }  else if(work === 'ceil') {
                height.parentElement.classList.add('disabled');
            }
        } else if(local === 'house') {
            if(work === 'ceil') {
                height.parentElement.classList.add('disabled');
            }
        }
    } else if(type === 'germetik') {
        if(local === 'wall') {
            if(seam === '10' || seam === '20') {
                weight.parentElement.classList.add('disabled');
            }
        } else if(local === 'joint') {
            diameter.parentElement.classList.add('disabled');
        }
    }
}

function changeInputResult(calculateForm) {
    let input = calculateForm.querySelector('[name="form-result"]');
    let result = document.querySelector('.calculate-form__result');
    if(result && input) 
        input.value = result.textContent;
}

