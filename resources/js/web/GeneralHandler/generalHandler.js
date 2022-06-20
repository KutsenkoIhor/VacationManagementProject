
// clearBgSidebarButton() // clear the background of the sidebar buttons


// function clearBgSidebarButton()
// {
//     let buttonSideBar = document.getElementsByClassName("sidebar_button_bg")
//     for (let i = 0; i < buttonSideBar.length; i++) {
//         buttonSideBar[i].classList.remove("active")
//     }
// }
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


sideBarButtonIllumination()

function sideBarButtonIllumination()
{
    let currentPage = window.location.pathname;

    currentPage === '/home' ? sideBarButtonHome() : null;
    currentPage === '/vacations/requestHistory' ? sideBarButtonVacationRequestHistory() : null;
    currentPage === '/vacations/requests' ? sideBarButtonVacationRequests() : null;
    currentPage === '/vacations/upcoming' ? sideBarButtonVacationsUpcoming() : null;
    currentPage === '/listOfAllEmployees' ? sideBarButtonListOfAllEmployees() : null;
    currentPage === '/managementPM' ? sideBarButtonManagementPM() : null;
    currentPage === '/managementHR' ? sideBarButtonManagementHR() : null;
    currentPage === '/publicHoliday' ? sideBarButtonPublicHoliday() : null;
    currentPage === '/settingsPage' ? sideBarButtonSettingsPage() : null;
    currentPage === '/profile' ? sideBarButtonProfile() : null;
}

function sideBarButtonHome()
{
    document.getElementById("sideBar_home").classList.add("active");
    document.getElementById("sideBar_home_svg").classList.add("active");
}

function sideBarButtonVacationRequestHistory()
{
    document.getElementById("sideBar_vacations_history").classList.add("active");
    document.getElementById("sideBar_vacations_history_svg").classList.add("active");
}

function sideBarButtonVacationRequests()
{
    document.getElementById("sideBar_vacations_requests").classList.add("active");
    document.getElementById("sideBar_vacations_requests_svg").classList.add("active");
}

function sideBarButtonVacationsUpcoming()
{
    document.getElementById("sideBar_vacations_overview").classList.add("active");
    document.getElementById("sideBar_vacations_overview_svg").classList.add("active");
}

function sideBarButtonListOfAllEmployees()
{
    document.getElementById("sideBar_list_of_all_employees").classList.add("active");
    document.getElementById("sideBar_list_of_all_employees_svg").classList.add("active");
}

function sideBarButtonManagementPM()
{
    document.getElementById("sideBar_PM_manage").classList.add("active");
    document.getElementById("sideBar_PM_manage_svg").classList.add("active");
}

function sideBarButtonManagementHR()
{
    document.getElementById("sideBar_HR_manage").classList.add("active");
    document.getElementById("sideBar_HR_manage_svg").classList.add("active");
}

function sideBarButtonPublicHoliday()
{
    document.getElementById("sideBar_public_holiday").classList.add("active");
    document.getElementById("sideBar_public_holiday_svg").classList.add("active");
}

function sideBarButtonSettingsPage()
{
    document.getElementById("sideBar_settings_page").classList.add("active");
    document.getElementById("sideBar_settings_page_svg").classList.add("active");
}

function sideBarButtonProfile()
{
    document.getElementById("sideBar_profile").classList.add("active");
    document.getElementById("sideBar_profile_svg").classList.add("active");
}


