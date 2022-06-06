// set the background of the sidebar button
document.getElementById("sideBar_manage_HR_and_PM").classList.add("active");
// set the background of the sidebar svg
document.getElementById("sideBar_manage_HR_and_PM_svg").classList.add("active");

initializeStartBlocManagePM()

document.getElementById('button-Manage-PM').addEventListener('click', function (e){
    e.preventDefault();
    initializeStartBlocManagePM()
})

document.getElementById('button-Manage-HR').addEventListener('click', function (e){
    e.preventDefault();
    initializeStartBlocManageHR()
})


function initializeStartBlocManagePM()
{
    clearBlocManagePMAndHR()
    document.getElementById("bloc-manage-PM").classList.add('active');
    document.getElementById('button-Manage-PM').classList.add('active');
}

function initializeStartBlocManageHR()
{
    clearBlocManagePMAndHR()
    document.getElementById('button-Manage-HR').classList.add('active');
    document.getElementById("bloc-manage-HR").classList.add('active');
}

function clearBlocManagePMAndHR()
{
    document.getElementById("bloc-manage-PM").classList.remove('active');
    document.getElementById("bloc-manage-HR").classList.remove('active');
    document.getElementById('button-Manage-PM').classList.remove('active');
    document.getElementById('button-Manage-HR').classList.remove('active');
}
