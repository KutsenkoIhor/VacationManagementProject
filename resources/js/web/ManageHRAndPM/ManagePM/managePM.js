
document.getElementById('button-select-PM').addEventListener('click', function (e){
    e.preventDefault();
    document.getElementById("bloc-manage-PM").classList.remove('active');
    document.getElementById("bloc-team-PM").classList.add('active');
})
