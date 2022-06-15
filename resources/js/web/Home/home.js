// set the background of the sidebar button
document.getElementById("sideBar_home").classList.add("active");
// set the background of the sidebar svg
document.getElementById("sideBar_home_svg").classList.add("active");
if (window.location.pathname === '/home') {
    const modalWindowCreateVacationRequest = document.getElementById("create_vacation_request_modal");
    const buttonCreateVacationRequest= document.getElementById("button-createVacationRequest");
    const buttonCloseModalWindowCreateVacationRequest = document.getElementById("close-modal-window-create-vacation-request");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    checkClick();

    function checkClick() {
        buttonCloseModalWindowCreateVacationRequest.addEventListener('click', function (e) {
            e.preventDefault();
            modalWindowCreateVacationRequest.classList.remove('active');
        })

        buttonCreateVacationRequest.addEventListener('click', function (e) {
            e.preventDefault();
            createVacationRequest();
        })
    }


    function checkButtonCreateVacationRequest() {
        const checkButtonCreateVacationRequest = document.getElementsByClassName('button-vacationRequest-create');

        let idButton = "button-createVacationRequest";
        let elementButtonCreateVacationRequest = document.getElementById(idButton);
        elementButtonCreateVacationRequest.addEventListener('click', function (e) {
            e.preventDefault();
            showModalWindow(checkButtonCreateVacationRequest)
        });
    }

    checkButtonCreateVacationRequest();

    function showModalWindow() {
        modalWindowCreateVacationRequest.classList.add('active')
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
            success: function (data) {
                window.location.redirect('/vacations/requestHistory');
            },
            error: function () {
                alert('Error');
            }
        });
    }
}
