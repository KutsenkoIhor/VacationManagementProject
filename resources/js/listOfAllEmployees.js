//-----------------------------------------/listOfAllEmployees/-----------------------------------------
if(window.location.pathname === '/listOfAllEmployees'){
    const openPopUpAddEmployee = document.getElementById("add_pop_up_employee");
    const closePopUpAddEmployee = document.getElementById("close_pop_up_employee");
    const popUpAddEmployee = document.getElementById("pop_up_employee");
    const saveEmployee = document.getElementById("save_pop_up_employee");

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
    })

    saveEmployee.addEventListener('click', function (e){
        e.preventDefault();
        saveUser();
    })

    function saveUser()
    {
        const elementCountry = document.getElementById("list_country_admin");
        const country = elementCountry.options[elementCountry.selectedIndex].value;

        const elementCity = document.getElementById("list_city_admin");
        const city = elementCity.options[elementCity.selectedIndex].value;

        let email = document.getElementById("create_email").value;
        let firstName = document.getElementById("create_first_name").value;
        let lastName = document.getElementById("create_last_name").value;
        let vacationDays = document.getElementById("Vacation_days_list_admin").value;
        let sickDays = document.getElementById("Sick_days_list_admin").value;
        let personalDays = document.getElementById("Personal_days_list_admin").value;

        var checkboxes = document.getElementsByClassName('create_checkbox')
        var checkboxesChecked = []; // можно в массиве их хранить, если нужно использовать
        for (var index = 0; index < checkboxes.length; index++) {
            if (checkboxes[index].checked) {
                checkboxesChecked.push(checkboxes[index].value); // положим в массив выбранный
            }
        }




        // console.log(checkboxesChecked);



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
                console.log('success')
                console.log(data);
            },
            error: function(er) {
                if (er.status === 422) {
                    console.log(er['responseJSON']);
                    console.log(er.responseJSON);
                }
                // console.log("erro")
                // console.log(er);
            }
        });
        // console.log("finish");
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


        const elementCountry = document.getElementById("list_country_admin")
        getListOfCities(elementCountry)
        elementCountry.addEventListener('change', function (e){
            e.preventDefault();
            getListOfCities(elementCountry)
        });


        function getListOfCities(elementCountry)
        {
            const element = document.getElementById("list_city_admin");
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

        const elementRole = document.getElementById("role_list_admin");
        getListOfDays(elementRole)
        elementRole.addEventListener('change', function (e){
            e.preventDefault();
            getListOfDays(elementRole)
        });

        function getListOfDays(elementRole)
        {
            const role = elementRole.options[elementRole.selectedIndex].value;
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



