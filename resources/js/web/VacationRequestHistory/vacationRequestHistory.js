// set the background of the sidebar button
document.getElementById("sideBar_vacations_history").classList.add("active");
// set the background of the sidebar svg
document.getElementById("sideBar_vacations_history_svg").classList.add("active");

import '../VacationRequestCreation/vacationRequestCreation.js';

function cancelVacationRequest() {
    $(document).ready(function () {
        $(".cancelButton").click(function () {
            const cancelConfirm = confirm("Are you sure?");
            if (cancelConfirm) {
                const data = {};
                const vacation_request_id = $(this).attr("vacation-request-id");
                $.ajax({
                    url: '/api/vacationRequests/' + vacation_request_id + '/cancelVacationRequest',
                    type: 'POST',
                    data: data,
                    success: function () {
                        alert('Successfully cancelled!');
                        window.location.reload();
                    },
                    error: function () {
                        alert('Error');
                    }
                });
            }
        });
    });
}

cancelVacationRequest();
