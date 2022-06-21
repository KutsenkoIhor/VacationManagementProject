let idHR;

export function powersOfHr(idHr)
{
    $.ajax({
        method: "POST",
        url: "/managementHR/powersOfHr",
        dataType: "json",
        data: {
            "hrId" : idHr,
        },
        success: function(data) {
            console.log(data);
            // createBlocPm(data['pm']);
            // createBlocTeam(data['team'])
            idHR = idHr;
            // checkButtonsDeleteEmployee(data['team'])
        },
        error: function(er) {
            console.log(er);
        }
    });
}
