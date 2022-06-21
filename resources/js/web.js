let currentPage = window.location.pathname;

//connect a common controller
require('./web/GeneralHandler/generalHandler');

//connect a page controllers
currentPage === '/home' ? require('./web/Home/home') : null;
currentPage === '/vacations/requestHistory' ? require('./web/VacationRequestHistory/vacationRequestHistory') : null;
currentPage === '/vacations/requests' ? require('./web/VacationRequests/vacationRequests') : null;
currentPage === '/vacations/upcoming' ? require('./web/VacationOverview/vacationOverview') : null;
currentPage === '/listOfAllEmployees' ? require('./web/ListOfAllEmployees/listOfAllEmployees') : null;
currentPage === '/managementPM' ? require('./web/ManagePM/managePM') : null;
currentPage === '/managementHR' ? require('./web/ManageHR/manageHR') : null;
currentPage === '/publicHoliday' ? require('./web/PublicHoliday/publicHoliday') : null;
currentPage === '/settingsPage' ? require('./web/SettingsPage/settingsPage') : null;
currentPage === '/profile' ? require('./web/Profile/profile') : null;

