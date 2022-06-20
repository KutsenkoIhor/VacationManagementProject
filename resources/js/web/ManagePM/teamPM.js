let idPM;

export function teamPm(idPm)
{
    $.ajax({
        method: "POST",
        url: "/managementPM/teamPm",
        dataType: "json",
        data: {
            "pmId" : idPm,
        },
        success: function(data) {
            createBlocPm(data['pm']);
            createBlocTeam(data['team'])
            idPM = idPm;
            checkButtonsDeleteEmployee(data['team'])
        },
        error: function(er) {
            console.log(er);
        }
    });
}
checkButtonsAddEmployee()
function checkButtonsAddEmployee()
{
    document.getElementById('add-employee-in-team').addEventListener('click', function (e){
        e.preventDefault();
        let email = document.getElementById('email-employee-in-team').value
        console.log(email)
        $.ajax({
            method: "POST",
            url: "/managementPM/teamPm/addEmployee",
            dataType: "json",
            data: {
                "emailEmployee" : email,
                "idPm": idPM,
            },
            success: function(data) {
                if (data) {
                    teamPm(idPM);
                    document.getElementById('add-employee-in-team-email-error').classList.remove('active');
                }


            },
            error: function(error) {
                validate(error['responseJSON']['errors'])
            }
        });
    });
}

function checkButtonsDeleteEmployee(arrTeamInformation)
{
    for (let idEmployee in arrTeamInformation) {
        document.getElementById("button-select-employee" + idEmployee).addEventListener('click', function (e){
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "/managementPM/teamPm/deleteEmployee",
                dataType: "json",
                data: {
                    "idEmployee" : idEmployee,
                    "idPm" : idPM,
                },
                success: function(data) {
                    if (data) {
                        teamPm(idPM);
                    }
                },
                error: function(er) {
                    console.log(er);
                }
            });

        });
    }
}

function createBlocPm(informationPm)
{
    if (informationPm['avatar']) {
        document.getElementById("bloc-pm-information").innerHTML =
            "<img src=\"" + informationPm['avatar'] + "\" class=\"mx-auto h-16 w-16 rounded-full\" alt=\"\">\n" +
            "<h2 class=\"mt-3 font-semibold text-gray-900\">" + informationPm['name'] + "</h2>\n" +
            "<p class=\"text-sm leading-6 text-gray-500\">" + informationPm['email'] + "</p>"
    } else {
        document.getElementById("bloc-pm-information").innerHTML =
            "<img src=\"image/AvatarsWithPlaceholderIcon.png\" class=\"mx-auto h-16 w-16 rounded-full\" alt=\"\">\n" +
            "<h2 class=\"mt-3 font-semibold text-gray-900\">" + informationPm['name'] + "</h2>\n" +
            "<p class=\"text-sm leading-6 text-gray-500\">" + informationPm['email'] + "</p>"
    }
}

function createBlocTeam(informationTeam)
{
    document.getElementById("bloc-team-information").innerHTML = "";
    for (let id in informationTeam) {
        if (informationTeam[id]['avatar']) {
            let tr = document.createElement('tr');
            document.getElementById("bloc-team-information").appendChild(tr);
            tr.innerHTML =
                "   <td class=\"whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6\">\n" +
                "       <div class=\"flex items-center\">\n" +
                "           <div class=\"hidden sm:block h-10 w-10 flex-shrink-0\">\n" +
                "               <img class=\"h-10 w-10 rounded-full\" src=\"" + informationTeam[id]['avatar'] + "\" alt=\"\">\n" +
                "           </div>\n" +
                "           <div class=\"ml-4\">\n" +
                "               <div class=\"font-medium text-gray-900\">" + informationTeam[id]['name'] + "</div>\n" +
                "               <div class=\"text-gray-500\">" + informationTeam[id]['email'] + "</div>\n" +
                "           </div>\n" +
                "       </div>\n" +
                "   </td>\n" +
                "   <td class=\"hidden sm:block whitespace-nowrap px-3 py-7 text-sm text-gray-500\">" + informationTeam[id]['country'] + "</td>\n" +
                "\n" +
                "   <td class=\"relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium\">\n" +
                "       <button type=\"button\" id=\"button-select-employee" + id + "\" class=\"inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30\">Delete<span class=\"sr-only\">, Hobby</span></button>\n" +
                "   </td>"
        } else {
            let tr = document.createElement('tr');
            document.getElementById("bloc-team-information").appendChild(tr);
            tr.innerHTML =
                "   <td class=\"whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6\">\n" +
                "       <div class=\"flex items-center\">\n" +
                "           <div class=\"hidden sm:block h-10 w-10 flex-shrink-0\">\n" +
                "               <img class=\"h-10 w-10 rounded-full\" src=\"image/AvatarsWithPlaceholderIcon.png\" alt=\"\">\n" +
                "           </div>\n" +
                "           <div class=\"ml-4\">\n" +
                "               <div class=\"font-medium text-gray-900\">" + informationTeam[id]['name'] + "</div>\n" +
                "               <div class=\"text-gray-500\">" + informationTeam[id]['email'] + "</div>\n" +
                "           </div>\n" +
                "       </div>\n" +
                "   </td>\n" +
                "   <td class=\"hidden sm:block whitespace-nowrap px-3 py-7 text-sm text-gray-500\">" + informationTeam[id]['country'] + "</td>\n" +
                "\n" +
                "   <td class=\"relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium\">\n" +
                "       <button type=\"button\" id=\"button-select-employee" + id + "\" class=\"inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30\">Delete<span class=\"sr-only\">, Hobby</span></button>\n" +
                "   </td>"
        }
    }
}

function validate(er)
{
    if (er['emailEmployee']) {
        console.log(er['emailEmployee']);
        document.getElementById('add-employee-in-team-email-error').textContent = er['emailEmployee'];
        document.getElementById('add-employee-in-team-email-error').classList.add('active');
    }
}
