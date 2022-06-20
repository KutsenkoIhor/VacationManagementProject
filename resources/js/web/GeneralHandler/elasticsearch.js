// listPm must be format id:[email, name]


// export function userSearch(data)
// {
//     const elasticsearchWindow = document.getElementById("elasticsearchListUser");
//     const elementElasticsearchOptionsList = document.getElementById("elasticsearchOptionsList");
//     let searchResults
//
//     let listUser = [];
//     for (let i in data) {
//         listUser['email_' + i] = data[i]['email']
//         listUser['name__' + i] = data[i]['name']
//     }
//     elasticsearchWindow.oninput = function(){
//         searchResults = [];
//         elementElasticsearchOptionsList.innerHTML = '';
//         let strSearch = this.value.trim().toLowerCase(); //remove the space and change everything to lowercase
//         if (strSearch !== '') {
//             for (let i in listUser){
//                 let letterLover = listUser[i].toLowerCase();
//                 if (letterLover.search(strSearch) !== -1){
//                     searchResults[i] = i;
//                     let li = document.createElement('li');
//                     li.textContent = listUser[i];
//                     li.classList.add('cursor-default', 'select-none', 'px-4', 'py-2', 'hover:bg-gray-50');
//                     li.id = i;
//                     elementElasticsearchOptionsList.appendChild(li);
//                     elementElasticsearchOptionsList.classList.add("active");
//                 }
//             }
//         }
//     }
//     console.log('testt')
//     console.log(searchResults)
//
//
//     elasticsearchWindow.addEventListener('keypress', function (e){
//         if(e.which === 13) {
//             e.preventDefault();
//             console.log(searchResults)
//         }
//     });
// }
