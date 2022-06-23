const createModalWindow = document.getElementById("create_vacation_request_modal");
const createVacationRequestButton = document.getElementById("button-createVacationRequest");
const closeModalButton = document.getElementById("close-modal-window-create-vacation-request");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

checkClick();

function checkClick() {
    closeModalButton.addEventListener('click', function (e) {
        e.preventDefault();
        createModalWindow.classList.remove('active');
    })

    createVacationRequestButton.addEventListener('click', function (e) {
        e.preventDefault();
        createVacationRequest();
    })
}


function openCreateModal() {
    const buttonOpenModalCreateVacationRequest = document.getElementsByClassName('button-vacationRequest-open');

    let idButton = "button-openModalCreateVacationRequest";
    let elementButtonOpenModalCreateVacationRequest = document.getElementById(idButton);

    elementButtonOpenModalCreateVacationRequest.addEventListener('click', function (e) {
        e.preventDefault();
        showModalWindow(buttonOpenModalCreateVacationRequest)
    });
}

openCreateModal();

function showModalWindow() {
    createModalWindow.classList.add('active')
}

function createVacationRequest() {
    let startDate = document.getElementById('create_start_date').value;
    let endDate = document.getElementById('create_end_date').value;
    let type = document.getElementById("create_type").value;

    $.ajax({
        method: "POST",
        url: "/api/vacationRequests/createVacationRequest",
        dataType: "json",
        data: {
            "start_date": startDate,
            "end_date": endDate,
            "type": type
        },
        success: function () {
            location.assign('/vacations/requestHistory');
        },
        error: function () {
            alert('Error');
        }
    });
}
