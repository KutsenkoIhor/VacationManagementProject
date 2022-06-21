import {powersOfHr} from "./powersOfHR";

document.getElementById("bloc-manage-HR").classList.add('active');


let lastPage;
let currentPage;
let arrUsersId = [];
let searchResults = [];

startAjax();


function startAjax(page = 1) {
    $.ajax({
        method: "GET",
        url: "/managementHR/listHr?page=" + page,
        dataType: "json",
        data: {
            "userId" : JSON.stringify(arrUsersId),
        },
        success: function(data) {
            lastPage = data['dataForPagination']['last_page'];
            currentPage = data['dataForPagination']['current_page'];
            createTablePm(data['dataForCreateTable']);
            createPaginationDescription();
            checkBlocTeam(data['dataForCreateTable']);
            startElasticsearch(data['dataForElasticsearch']);
        },
        error: function(er) {
        }
    });
}

checkButtons()

function checkButtons()
{
    document.getElementById("elasticsearchListUser").addEventListener('keypress', function (e){
        if(e.which === 13) {
            e.preventDefault();
            arrUsersId = searchResults;
            startAjax()
        }
    });

    $(document).click( function(e){
        if ( !$(e.target).closest('.box-elasticsearchUser').length ) {
            document.getElementById("elasticsearchOptionsList").classList.remove("active");
            document.getElementById("elasticsearchNotFound").classList.remove("active");
            // document.getElementById("elasticsearchListUser").value = '';
        }
    });

    document.getElementById('button-clear-search').addEventListener('click', function (e){
        e.preventDefault();
        arrUsersId = [];
        document.getElementById("elasticsearchOptionsList").classList.remove("active");
        document.getElementById("elasticsearchNotFound").classList.remove("active");
        document.getElementById("elasticsearchListUser").value = '';
        startAjax()
    });

    document.getElementById('first-page-table-user').addEventListener('click', function (e){
        e.preventDefault();
        startAjax(1);
    });

    document.getElementById('next-page-table-user').addEventListener('click', function (e){
        e.preventDefault();
        if (currentPage < lastPage){
            startAjax(currentPage + 1);
        }
    });

    document.getElementById('previous-page-table-user').addEventListener('click', function (e){
        e.preventDefault();
        if (currentPage > 1){
            startAjax(currentPage - 1);
        }
    });

    document.getElementById('last-page-table-user').addEventListener('click', function (e){
        e.preventDefault();
        startAjax(lastPage);
    });
}

function checkBlocTeam(arrPmInformation)
{
    for (let id in arrPmInformation) {
        document.getElementById("button-select-HR" + id).addEventListener('click', function (e){
            e.preventDefault();
            document.getElementById("bloc-manage-HR").classList.remove('active');
            document.getElementById("bloc-team-HR").classList.add('active');
            powersOfHr(id);
        });
    }
}

function createTablePm(arrHrInformation)
{
    document.getElementById("table-HR").innerHTML = "";
    for (let id in arrHrInformation) {

        let divMain = document.createElement('div');
        divMain.id = "button-select-HR" + id;
        divMain.classList.add('relative', 'rounded-lg', 'border', 'border-gray-300', 'bg-white', 'px-6', 'py-5', 'shadow-sm', 'flex', 'items-center', 'space-x-3', 'hover:ring-2', 'hover:ring-offset-2', 'hover:ring-indigo-500');
        document.getElementById("table-HR").appendChild(divMain);

        let div1 = document.createElement('div');
        div1.classList.add('flex-shrink-0');
        divMain.appendChild(div1);

        let imgHr = document.createElement('img');
        imgHr.classList.add('h-10', 'w-10', 'rounded-full');
        if (arrHrInformation[id]['googleAvatar'] !== null) {
            imgHr.src = arrHrInformation[id]['googleAvatar'];
        } else {
            imgHr.src = 'image/AvatarsWithPlaceholderIcon.png';
        }
        div1.appendChild(imgHr);

        let div2 = document.createElement('div');
        div2.classList.add('flex-1', 'min-w-0');
        divMain.appendChild(div2);

        div2.innerHTML =
            "<a href=\"#\" class=\"focus:outline-none\">\n" +
            "   <span class=\"absolute inset-0\" aria-hidden=\"true\"></span>\n" +
            "   <p class=\"text-sm font-medium text-gray-900\">" + arrHrInformation[id]['name'] + "</p>\n" +
            "   <p class=\"text-sm text-gray-500 truncate\">" + arrHrInformation[id]['email'] + "</p>\n" +
            "</a>\n";
    }
}

function createPaginationDescription()
{
    document.getElementById("text-number-page").textContent = currentPage + '/' + lastPage;
}

function startElasticsearch(data)
{
    const elasticsearchWindow = document.getElementById("elasticsearchListUser");
    const elementElasticsearchOptionsList = document.getElementById("elasticsearchOptionsList");
    const elementElasticsearchNotFound = document.getElementById("elasticsearchNotFound");

    let listUser = [];
    for (let i in data) {
        listUser['email_' + i] = data[i]['email']
        listUser['name__' + i] = data[i]['name']
    }
    elasticsearchWindow.oninput = function(){
        searchResults = [];
        let checkNotFound = true;
        elementElasticsearchOptionsList.innerHTML = '';
        let strSearch = this.value.trim().toLowerCase(); //remove the space and change everything to lowercase
        if (strSearch !== '') {
            for (let i in listUser){
                let letterLover = listUser[i].toLowerCase();
                if (letterLover.search(strSearch) !== -1){
                    checkNotFound = false;
                    searchResults[i.slice(6)] = i.slice(6);

                    let li = document.createElement('li');
                    li.textContent = listUser[i];
                    li.classList.add('cursor-default', 'select-none', 'px-4', 'py-2', 'hover:bg-gray-100');
                    li.id = i;
                    elementElasticsearchOptionsList.appendChild(li);
                    elementElasticsearchOptionsList.classList.add("active");
                }
            }
            if (checkNotFound) {
                elementElasticsearchOptionsList.classList.remove("active");
                elementElasticsearchNotFound.classList.add("active")
            }
        } else {
            elementElasticsearchOptionsList.classList.remove("active");
            elementElasticsearchNotFound.classList.remove("active")
        }
    }
}
