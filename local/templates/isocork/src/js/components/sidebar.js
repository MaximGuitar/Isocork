function sidebar(){
    const sidebar = document.querySelector(`.sidebar-list`);
    if (!sidebar)
        return

    const headers = document.querySelectorAll(`.page h2`)
    
    headers.forEach((header, i) => {
        header.id = `sidebar-header-${i+1}`;

        const li = document.createElement('li')
        const a = document.createElement('a')
        a.className = 'sidebar__link inter'
        a.href = `#${header.id}`
        a.textContent = header.textContent
        li.className = 'sidebar-list__item'
        li.append(a)

        sidebar.appendChild(li);
    });

    const sidebarItems = sidebar.querySelectorAll(`.sidebar-list__item`);
    let sidebarActiveItem;

    /* Установка начального активного пункта в сайдбаре */
    sidebarItems[0].classList.add(`sidebar__item--active`);
    sidebarActiveItem = sidebarItems[0];

    /* Изменение активного пункта в сайдбаре при скролле страницы */
    const textPageScrollHandler = () => {
        headers.forEach((header, i) => {
            if (header.getBoundingClientRect().top < 125) {
                sidebarActiveItem.classList.remove(`sidebar__item--active`);
                sidebarActiveItem = sidebarItems[i];
                sidebarItems[i].classList.add(`sidebar__item--active`);
            }
        });
    };

    document.addEventListener(`scroll`, textPageScrollHandler);

    /* Скролл к пункту в контенте по клику на соотв. ссылку сайдбара */
    sidebarItems.forEach((sidebarItem, i) => {
        sidebarItem.addEventListener(`click`, (evt) => {
            evt.preventDefault();
            const elemCoordY = headers[i].getBoundingClientRect().top;

            document.removeEventListener(`scroll`, textPageScrollHandler);
            sidebarActiveItem.classList.remove(`sidebar__item--active`);
            sidebarItem.classList.add(`sidebar__item--active`);
            sidebarActiveItem = sidebarItem;

            window.scrollBy({
                top: elemCoordY - 140,
                behavior: "smooth"
            });

            const textPageScrollHandlerWrapper = () => {
                document.addEventListener(`scroll`, textPageScrollHandler);
            }

            setTimeout(textPageScrollHandlerWrapper, 700);
        });
    });
}
sidebar()