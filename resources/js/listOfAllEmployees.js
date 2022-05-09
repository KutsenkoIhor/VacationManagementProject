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
    const elementRole = document.getElementById("role_list_admin");
    const elementPushNotification = document.getElementById("push-notifications");
    const elementTextPushNotification =document.getElementById("push-notifications-text");


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


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



    checkCheckBox()

    function checkCheckBox() {
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
}



