// // set the background of the sidebar button
// document.getElementById("sideBar_vacations_requests").classList.add("active");
// // set the background of the sidebar svg
// document.getElementById("sideBar_vacations_requests_svg").classList.add("active");
if (window.location.pathname === '/vacations/requests') {
    const modalWindowEditVacationRequest = document.getElementById("edit_vacation_request_modal");
    const buttonUpdateVacationRequest = document.getElementById("button-updateVacationRequest");
    const buttonCloseModalWindowEditVacationRequest = document.getElementById("close-modal-window-edit-vacation-request");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    checkClick();

    function checkClick() {
        buttonCloseModalWindowEditVacationRequest.addEventListener('click', function (e) {
            e.preventDefault();
            modalWindowEditVacationRequest.classList.remove('active');
        })

        buttonUpdateVacationRequest.addEventListener('click', function (e) {
            e.preventDefault();
            updateVacationRequestDetails();
        })
    }


    function checkButtonsEditVacationRequest() {
        const checkButtonEditVacationRequest = document.getElementsByClassName('button-vacationRequest-edit');

        for (let i in checkButtonEditVacationRequest) {
            let idButton = "button-editVacationRequest-" + checkButtonEditVacationRequest[i]['value'];
            if (idButton !== 'button-editVacationRequest-undefined') {
                let elementButtonEditVacationRequest = document.getElementById(idButton);
                elementButtonEditVacationRequest.addEventListener('click', function (e) {
                    e.preventDefault();
                    showModalWindow(checkButtonEditVacationRequest[i]['value'])
                });
            }
        }
    }

    checkButtonsEditVacationRequest();

    function showModalWindow(vacationRequestId) {
        modalWindowEditVacationRequest.classList.add('active')

        getVacationRequest(vacationRequestId);
    }

    function getVacationRequest(vacationRequestId) {
        $.ajax({
            method: "GET",
            url: "/api/vacationRequests/" + vacationRequestId,
            success: function (data) {
                document.getElementById('vacation_request_id').value = vacationRequestId;
                document.getElementById('user_email').value = data['user']['email'];
                document.getElementById('edit_start_date').value = data['start_date'];
                document.getElementById('edit_end_date').value = data['end_date'];
                document.getElementById('edit_type').value = data['type'];
            },
            error: function () {
                alert('Error');
            }
        });
    }

    function updateVacationRequestDetails() {
        let vacationRequestId = document.getElementById('vacation_request_id').value;
        let startDate = document.getElementById('edit_start_date').value;
        let endDate = document.getElementById('edit_end_date').value;
        let type = document.getElementById("edit_type").value;

        $.ajax({
            method: "POST",
            url: "/api/vacationRequests/" + vacationRequestId + "/updateVacationRequest",
            dataType: "json",
            data: {
                "start_date": startDate,
                "end_date": endDate,
                "type": type
            },
            success: function (data) {
                window.location.reload();
            },
            error: function () {
                alert('Error');
            }
        });
    }
}
