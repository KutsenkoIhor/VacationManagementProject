require('./bootstrap');

const openPopUp = document.getElementById("user-menu-button");
const closePopUp = document.getElementById("user-menu-item-2");
const popUp = document.getElementById("pop_up_menu");


document.addEventListener('click',(e) => {
    const clickMenu = e.composedPath().includes(openPopUp);
    const clickBox = e.composedPath().includes(popUp);
    if (clickMenu) {
        const statusMenu = popUp.classList.contains('active');
        if (!statusMenu) {
            popUp.classList.add('active')
        } else {
            popUp.classList.remove('active')
        }
    } else if (!clickBox) {
        const statusMenu = popUp.classList.contains('active');
        if (statusMenu) {
            popUp.classList.remove('active')
        }
    }
})







