


document.getElementById("bloc-manage-HR").classList.add('active');

document.getElementById('button-select-HR').addEventListener('click', function (e){
    e.preventDefault();
    document.getElementById("bloc-manage-HR").classList.remove('active');
    document.getElementById("bloc-team-HR").classList.add('active');
})
