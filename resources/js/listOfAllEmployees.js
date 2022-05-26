//-----------------------------------------/listOfAllEmployees/-----------------------------------------
if(window.location.pathname === '/listOfAllEmployees'){
    const openPopUpAddEmployee = document.getElementById("add_pop_up_employee");
    const closePopUpAddEmployee = document.getElementById("close_pop_up_employee");
    const popUpAddEmployee = document.getElementById("pop_up_employee");
    const saveEmployee = document.getElementById("save_pop_up_employee");
    const elementErrorRoles = document.getElementById("roles_error");
    const elementErrorEmail = document.getElementById("email-error");
    const elementErrorLastName = document.getElementById("last_name_error");
    const elementErrorFirstName = document.getElementById("first_name_error");
    const elementErrorVacationDays = document.getElementById("vacation_days_error");
    const elementErrorSickDays = document.getElementById("sick_days_error");
    const elementErrorPersonalDays = document.getElementById("personal_days_error");
    const elementCountry = document.getElementById("list_country_admin");
    const elementCity = document.getElementById("list_city_admin");
    const checkboxes = document.getElementsByClassName('create_checkbox');
    const checkboxesEditUser = document.getElementsByClassName('create_checkbox_edit_user');


    const elementRole = document.getElementById("role_list_admin");
    const elementPushNotification = document.getElementById("push-notifications");
    const elementTextPushNotification = document.getElementById("push-notifications-text");
    const elementElasticsearch = document.getElementById("elasticsearchListUser");
    const elementElasticsearchOptionsList = document.getElementById("elasticsearchOptionsList");
    const elementElasticsearchNotFound = document.getElementById("elasticsearchNotFound");
    const elementListElasticsearch = document.getElementsByClassName('elasticsearchOptionsListUser');
    const firstPage = document.getElementById("first-page-table-user");
    const previousPage = document.getElementById("previous-page-table-user");
    const nextPage = document.getElementById("next-page-table-user");
    const lastPage = document.getElementById("last-page-table-user");
    const textNumberPage = document.getElementById("text-number-page");


    var currentPageNumber;
    var lastPageNumber;
    dataaa = [];


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    createEmployeeDataTable()

    checkClick()

    function checkClick()
    {
        firstPage.addEventListener('click', function (e){
            e.preventDefault();
            createEmployeeDataTable("1")
        })

        previousPage.addEventListener('click', function (e){
            e.preventDefault();
            if (currentPageNumber > 1) {
                createEmployeeDataTable(currentPageNumber - 1)
            } else {
                createEmployeeDataTable("1")
            }
        })

        nextPage.addEventListener('click', function (e){
            e.preventDefault();
            if (currentPageNumber < lastPageNumber){
                createEmployeeDataTable(currentPageNumber + 1)
            } else {
                createEmployeeDataTable(currentPageNumber)
            }

        })

        lastPage.addEventListener('click', function (e){
            e.preventDefault();
            createEmployeeDataTable(lastPageNumber)
        })

        openPopUpAddEmployee.addEventListener('click', function (e){
            e.preventDefault();
            popUpAddEmployee.classList.add('active');
            addEmployee()
        })

        closePopUpAddEmployee.addEventListener('click', function (e){
            e.preventDefault();
            popUpAddEmployee.classList.remove('active');
            clearAfterSave();
        })

        saveEmployee.addEventListener('click', function (e){
            e.preventDefault();
            saveUser();
        })

        // checkButtonsHistoryVacationUser()
        // checkButtonsEditUser()
        // checkButtonsDeleteUser()
        checkCheckBox()
        closingElasticsearch()
        sendInputElasticsearch()

    }

    function elasticsearch(data)
    {
        let arr = [];
        for (let i in data) {
            arr['email_' + i] = data[i]['email']
            arr['name__' + i] = data[i]['name']
        }

        elementElasticsearch.oninput = function(){
            const globalListElasticsearchUsers = [];
            elementElasticsearchOptionsList.innerHTML = '';
            let val = this.value.trim();
            if (val !== '') {
                let iter = 0
                let strSearchUser = null;
                for (let y in arr) {
                    let str = arr[y].toLowerCase();
                    let inputStr = val.toLowerCase();
                    if (str.search(inputStr) !== -1){
                        strSearchUser = arr[y];
                        iter++
                        globalListElasticsearchUsers.length = 0;
                        globalListElasticsearchUsers[y] = arr[y];
                        if (iter < 6) {
                            let li = document.createElement('li');
                            li.textContent = arr[y];
                            li.classList.add('cursor-default', 'select-none', 'px-4', 'py-2', 'hover:bg-gray-50')
                            li.id = y;
                            li.value = y;
                            elementElasticsearchOptionsList.appendChild(li);
                            elementElasticsearchOptionsList.classList.add("active");
                            elementElasticsearchNotFound.classList.remove("active")
                        }
                    }
                }
                if (!strSearchUser) {
                    elementElasticsearchOptionsList.classList.remove("active");
                    elementElasticsearchNotFound.classList.add("active")
                }
            } else {
                elementElasticsearchOptionsList.classList.remove("active");
                elementElasticsearchNotFound.classList.remove("active")
            }
            checkClickElasticsearchList()
            dataaa = globalListElasticsearchUsers;
        }
    }

    function sendInputElasticsearch()
    {
        elementElasticsearch.addEventListener('keypress', function (e){
            if(e.which === 13) {
                e.preventDefault();
                console.log(dataaa)
                console.log(elementElasticsearch.value);
                elementElasticsearchOptionsList.classList.remove("active");
            }
        });
    }

    function closingElasticsearch()
    {
        $(document).click( function(e){
            if ( !$(e.target).closest('.box-elasticsearchUser').length ) {
                elementElasticsearchOptionsList.classList.remove("active");
                elementElasticsearchNotFound.classList.remove("active")
            }
        });
    }

    function checkButtonsHistoryVacationUser(checkButtonsHistoryVacation)
    {
        for (let i in checkButtonsHistoryVacation) {
            let idButton = "button-historyVacations-" + checkButtonsHistoryVacation[i]['value'];
            if (idButton !== 'button-historyVacations-undefined') {
                let elementButtonHistoryVacation = document.getElementById(idButton);
                elementButtonHistoryVacation.addEventListener('click', function (e){
                    e.preventDefault();
                });
            }
        }
    }

    function checkButtonsEditUser(checkButtonsEdit)
    {
        for (let i in checkButtonsEdit) {
            let idButton = "button-edit-" + checkButtonsEdit[i]['value'];
            if (idButton !== 'button-edit-undefined') {
                let elementButtonEdit = document.getElementById(idButton);
                elementButtonEdit.addEventListener('click', function (e){
                    e.preventDefault();
                    editUser(checkButtonsEdit[i]['value']);
                });
            }
        }
    }

    function checkButtonsDeleteUser(checkButtonsDelete)
    {
        for (let i in checkButtonsDelete) {
            let idButton = "button-delete-" + checkButtonsDelete[i]['value'];
            if (idButton !== 'button-delete-undefined') {
                let elementButtonDelete = document.getElementById(idButton);
                elementButtonDelete.addEventListener('click', function (e){
                    e.preventDefault();
                    deleteUser(checkButtonsDelete[i]['value'])
                });
            }
        }
    }

    function checkClickElasticsearchList()
    {
        for (let i in elementListElasticsearch[0]['childNodes']) {
            let idElasticsearchListUser = elementListElasticsearch[0]['childNodes'][i]['id'] + "";
            if (idElasticsearchListUser !== 'undefined') {
                // console.log(elementListElasticsearch[0]['childNodes'][i]["textContent"])

                let elementListElasticsearchUser = document.getElementById(idElasticsearchListUser);
                elementListElasticsearchUser.addEventListener('click', function (e){
                    e.preventDefault();
                    elementElasticsearch.value = elementListElasticsearch[0]['childNodes'][i]["textContent"];
                    // console.log(idElasticsearchListUser)
                });
            }
        }

    }

    function checkCheckBox()
    {
        for (let i in checkboxes) {
            let role = checkboxes[i]['value']
            let idBoxCheckBox = role + "_box";
            let idCheckBox = role + "_checkbox";
            if (idBoxCheckBox !== 'undefined_box') {
                let elementBoxCheckBox = document.getElementById(idBoxCheckBox);
                elementBoxCheckBox.addEventListener('click', function (e){
                    e.preventDefault();
                    document.getElementById(idCheckBox).checked = !document.getElementById(idCheckBox).checked;
                });
            }
        }
    }

    function paginationHandler(paginationData)
    {
        currentPageNumber = paginationData['current_page'];
        lastPageNumber = paginationData['last_page'];
        textNumberPage.innerText = currentPageNumber + " / " + lastPageNumber
    }

    function createEmployeeDataTable(page = 1)
    {
        let url = "/listOfAllEmployees/createEmployeeDataTable?page=" + page
        console.log(page)

        $.ajax({
            method: "GET",
            url: url,
            dataType: "html",
            success: function(data) {

                let block = document.getElementById('1234567');
                block.innerHTML = data;

                const checkButtonsHistoryVacation = document.getElementsByClassName('button-historyVacations-user');
                const checkButtonsEdit = document.getElementsByClassName('button-edit-user');
                const checkButtonsDelete = document.getElementsByClassName('button-delete-user');
                checkButtonsHistoryVacationUser(checkButtonsHistoryVacation)
                checkButtonsEditUser(checkButtonsEdit)
                checkButtonsDeleteUser(checkButtonsDelete)
            }
        });

        $.ajax({
            method: "POST",
            url: url,
            dataType: "json",
            success: function(data) {
                elasticsearch(data['dataForElasticsearch'])
                paginationHandler(data['userModel'])
                // lastPageNumber = paginationData['last_page'];

                // sendInputElasticsearch(data['dataForElasticsearch'])
                // console.log(data)
                // console.log(data['dataForElasticsearch']);
            },
        });
    }

    function clearAfterSave()
    {
        //clear Errors
        elementErrorEmail.classList.remove('active');
        elementErrorFirstName.classList.remove('active');
        elementErrorLastName.classList.remove('active');
        elementErrorVacationDays.classList.remove('active');
        elementErrorSickDays.classList.remove('active');
        elementErrorPersonalDays.classList.remove('active');
        elementErrorRoles.classList.remove('active');
        //clear Forms
        document.getElementById("create_email").value = "";
        document.getElementById("create_first_name").value = "";
        document.getElementById("create_last_name").value = "";
    }

    function addEmployee()
    {
        //---ajax request---
        const arr = $.ajax({
            url: "/listOfAllEmployees/addUser",       /* Куда пойдет запрос */
            method: 'POST',             /* Метод передачи (post или get) */
            dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
            async: false,
            data: {},      /* Параметры передаваемые в запросе. */
            global: true,
            success: function (response) {
                return response;
            }
        }).responseJSON;

        // console.log(arr)


        getListOfCities(elementCountry)
        elementCountry.addEventListener('change', function (e){
            e.preventDefault();
            getListOfCities(elementCountry)
        });


        function getListOfCities(elementCountry)
        {
            let element = document.getElementById("list_city_admin");
            //---Delete all items in the list---
            const opts = element.options;
            while(opts.length > 0) {
                opts[opts.length - 1] = null;
            }
            const country = elementCountry.options[elementCountry.selectedIndex].value;
            for( const i in arr['CountriesAndCities']){
                if (country === i) {
                    for (const y in arr['CountriesAndCities'][i]){
                        //---Create new list items---
                        const oOpt1st = document.createElement('OPTION');
                        oOpt1st.value = arr['CountriesAndCities'][i][y];
                        oOpt1st.text = arr['CountriesAndCities'][i][y];
                        element.appendChild(oOpt1st);
                    }
                }
            }
        }


        getListOfDays(elementRole)
        elementRole.addEventListener('change', function (e){
            e.preventDefault();
            getListOfDays(elementRole)
        });

        function getListOfDays(elementRole)
        {
            let role = elementRole.options[elementRole.selectedIndex].value;
            for (const i in arr['roles']) {
                if (role === arr['roles'][i]) {
                    const role = arr['roles'][i];
                    document.getElementById("Vacation_days_list_admin").value = arr[role]["vacations"];
                    document.getElementById("Sick_days_list_admin").value = arr[role]["personal_days"];
                    document.getElementById("Personal_days_list_admin").value = arr[role]["sick_days"];
                }
            }
        }
    }

    function saveUser()
    {
        //---get form values
        let country = elementCountry.options[elementCountry.selectedIndex].value;
        let city = elementCity.options[elementCity.selectedIndex].value;
        let email = document.getElementById("create_email").value;
        let firstName = document.getElementById("create_first_name").value;
        let lastName = document.getElementById("create_last_name").value;
        let vacationDays = document.getElementById("Vacation_days_list_admin").value;
        let sickDays = document.getElementById("Sick_days_list_admin").value;
        let personalDays = document.getElementById("Personal_days_list_admin").value;

        let checkboxesChecked = [];
        for (let index = 0; index < checkboxes.length; index++) {
            if (checkboxes[index].checked) {
                checkboxesChecked.push(checkboxes[index].value);
            }
        }

        $.ajax({
            method: "POST",
            url: "/listOfAllEmployees/saveUser",
            dataType: "json",
            data: {
                "country" : country,
                "city" : city,
                "email" : email,
                "firstName" : firstName,
                "lastName" : lastName,
                "vacationDays" : vacationDays,
                "sickDays" : sickDays,
                "personalDays" : personalDays,
                "roles" : checkboxesChecked,

            },
            success: function(data) {
                pushNotifications(firstName, lastName)
                clearAfterSave()
                console.log(data);
                createEmployeeDataTable()
            },
            error: function(er) {
                if (er.status === 422) {
                    validate(er);
                    console.log(er['responseJSON']['errors']);
                }
            }
        });

        function pushNotifications(firstName, lastName)
        {

            elementTextPushNotification.textContent = firstName + " " + lastName + " added successfully";
            elementPushNotification.classList.add('active');
            setTimeout(function() {
                elementPushNotification.classList.remove('active');
            }, 3700);
        }



        function validate(er)
        {
            if (er['responseJSON']['errors']['email']){
                elementErrorEmail.classList.add('active');
                elementErrorEmail.textContent = er['responseJSON']['errors']['email'][0];
            } else {
                elementErrorEmail.classList.remove('active');
            }
            if (er['responseJSON']['errors']['firstName']){
                elementErrorFirstName.classList.add('active');
                elementErrorFirstName.textContent = er['responseJSON']['errors']['firstName'][0];
            } else {
                elementErrorFirstName.classList.remove('active');
            }
            if (er['responseJSON']['errors']['lastName']){
                elementErrorLastName.classList.add('active');
                elementErrorLastName.textContent = er['responseJSON']['errors']['lastName'][0];
            } else {
                elementErrorLastName.classList.remove('active');
            }
            if (er['responseJSON']['errors']['vacationDays']){
                elementErrorVacationDays.classList.add('active');
                elementErrorVacationDays.textContent = er['responseJSON']['errors']['vacationDays'][0];
            } else {
                elementErrorVacationDays.classList.remove('active');
            }
            if (er['responseJSON']['errors']['sickDays']){
                elementErrorSickDays.classList.add('active');
                elementErrorSickDays.textContent = er['responseJSON']['errors']['sickDays'][0];
            } else {
                elementErrorSickDays.classList.remove('active');
            }
            if (er['responseJSON']['errors']['personalDays']){
                elementErrorPersonalDays.classList.add('active');
                elementErrorPersonalDays.textContent = er['responseJSON']['errors']['personalDays'][0];
            } else {
                elementErrorPersonalDays.classList.remove('active');
            }
            if (er['responseJSON']['errors']['roles']){
                elementErrorRoles.classList.add('active')
                elementErrorRoles.textContent = er['responseJSON']['errors']['roles'][0];
            } else {
                elementErrorRoles.classList.remove('active')
            }
        }
    }

    function deleteUser(userId)
    {
        $.ajax({
            method: "POST",
            url: "/listOfAllEmployees/deleteUser",
            dataType: "json",
            data: {
                "userId" : userId,
            },
            success: function(data) {
                console.log(data);
                createEmployeeDataTable(currentPageNumber)
            },
            error: function(er) {
                console.log(er['responseJSON']['errors']);
            }
        });
    }

    function editUser(userId)
    {
        const modalWindowEditUser = document.getElementById('pop_up_edit_user');
        const buttonCloseModalWindowEditUser = document.getElementById("close-modal-window-edit-user");

        modalWindowEditUser.classList.add('active')

        buttonCloseModalWindowEditUser.addEventListener('click', function (e){
            e.preventDefault();
            modalWindowEditUser.classList.remove('active');
        })

        $.ajax({
            method: "POST",
            url: "/listOfAllEmployees/editUser",
            dataType: "json",
            data: {
                "userId" : userId,
            },
            success: function(data) {
                fillingEmployeeDetailsForEditing(data)
                console.log(data);
            },
            error: function(er) {
                    console.log(er);
                }
        });

        function fillingEmployeeDetailsForEditing(data)
        {
            const elementEditEmail = document.getElementById('edit_email');


        }

    }

}
