if (window.location.pathname === '/vacations/requests') {

    const editModalWindow = document.getElementById("edit_vacation_request_modal");
    const updateVacationRequestButton = document.getElementById("button-updateVacationRequest");
    const closeModalButton = document.getElementById("close-edit-modal-window");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    checkClick();

    function checkClick() {
        closeModalButton.addEventListener('click', function (e) {
            e.preventDefault();
            editModalWindow.classList.remove('active');
        })

        updateVacationRequestButton.addEventListener('click', function (e) {
            e.preventDefault();
            updateVacationRequest();
        })
    }


    function checkEditButtons() {
        const checkEditButton = document.getElementsByClassName('button-vacationRequest-edit');

        for (let i in checkEditButton) {
            let idButton = "button-editVacationRequest-" + checkEditButton[i]['value'];

            if (idButton !== 'button-editVacationRequest-undefined') {
                let elementButtonEditVacationRequest = document.getElementById(idButton);

                elementButtonEditVacationRequest.addEventListener('click', function (e) {
                    e.preventDefault();
                    showModalWindow(checkEditButton[i]['value'])
                });
            }
        }
    }

    checkEditButtons();

    function showModalWindow(vacationRequestId) {
        editModalWindow.classList.add('active')

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

    function updateVacationRequest() {
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


    function changeStatus() {
        $(document).ready(function () {
            $(".changeStatusButton").click(function () {
                const data = {};
                const vacation_request_id = $(this).attr("vacation-request-id");
                data.is_approved = $(this).val();
                $.ajax({
                    url: '/api/vacationRequests/' + vacation_request_id + '/createVacationRequestApproval',
                    type: 'POST',
                    data: data,
                    success: function () {
                        alert('Successfully changed!');
                        window.location.reload();
                    },
                    error: function () {
                        alert('Error');
                    }
                });
            });
        });
    }
    changeStatus();

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
}
