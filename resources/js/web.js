let currentPage = window.location.pathname;

//connect a common controller
require('./web/GeneralHandler/generalHandler');

//connect a page controllers
currentPage === '/home' ? require('./web/Home/home') : null;
currentPage === '/vacations' ? require('./web/Vacations/vacations') : null;
currentPage === '/vacations/requestHistory' ? require('./web/VacationsHistory/vacationsHistory') : null;
currentPage === '/vacations/requests' ? require('./web/VacationsRequests/vacationsRequests') : null;
currentPage === '/vacations/upcoming' ? require('./web/VacationsOverview/vacationsOverview') : null;
currentPage === '/listOfAllEmployees' ? require('./web/ListOfAllEmployees/listOfAllEmployees') : null;
currentPage === '/publicHoliday' ? require('./web/PublicHoliday/publicHoliday') : null;
currentPage === '/manageHRandPM' ? require('./web/ManageHRAndPM/manageHRAndPM') : null;
currentPage === '/settingsPage' ? require('./web/SettingsPage/settingsPage') : null;
currentPage === '/profile' ? require('./web/Profile/profile') : null;

