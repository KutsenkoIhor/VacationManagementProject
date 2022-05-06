const openPopUp = document.getElementById("user-menu-button");
// const closePopUp = document.getElementById("user-menu-item-2");
const popUp = document.getElementById("pop_up_menu");

const buttonHome = document.getElementById("button_home");
buttonHome.addEventListener('click', function (e){
    e.preventDefault();
    console.log("good");
    buttonHome.classList.add('active');
    // buttonHome.classList.add('bg-gray-700');
    // buttonHome.classList.remove('bg-gray-700');
    buttonHome2.classList.remove('active');
})
const buttonHome2 = document.getElementById("button_home2");
buttonHome2.addEventListener('click', function (e){
    e.preventDefault();
    console.log("good");
    buttonHome2.classList.add('active');
    // buttonHome2.classList.add('bg-gray-700');
    // buttonHome2.classList.remove('bg-gray-700');
    buttonHome.classList.remove('active');
})


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

const mobile_openPopUp = document.getElementById("mobile_user_menu_button");
const mobile_closePopUp = document.getElementById("mobile_user_close_menu_button");
const mobile_popUp = document.getElementById("mobile_pop_up_menu");

mobile_openPopUp.addEventListener('click', function (e){
    e.preventDefault();
    mobile_popUp.classList.add('active');
})

mobile_closePopUp.addEventListener('click', function (e){
    e.preventDefault();
    mobile_popUp.classList.remove('active');
})
