$(document).ready(function () {
    getToLoLists()
});


function getToLoLists() {
    jQuery.ajax({
        url: 'api/to-do-list',
        type: 'GET',
        dataType: "json",
        error: function (response) {

        },
        success: function (response) {
            let responseData = response;
            console.log(responseData)

            let html = "";

            for (let i = 0; i < responseData.length; i++) {

                let items = responseData[i].item;

                let itemHtml = "";

                for (let j = 0; j < items.length; j++) {
                    itemHtml += "<br><b>" + items[j].name + "</b>"
                    itemHtml += "<br>" + items[j].description + ""
                    itemHtml += "<br><img width='40px' src='" + items[j].image + "'>"
                }


                html += "<div class=\"card\" style=\"width: 18rem;\">\n" + responseData[i].name +

                    "  <div class=\"card-body\">\n" +
                    "            <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" onclick='setListItem(" + responseData[i].id + ")' data-target=\"#createToDoListItemModal\">\n" + " Создать элемент списка\n" +
                    "            </button>"

                    + itemHtml +

                    "  </div>\n" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }

            document.getElementById('toDoListList').innerHTML = html;

        }

    })
}

function setListItem(id) {
    document.getElementById("list_id").value = id;
    /* получаем список тегов */
    jQuery.ajax({
        url: 'api/tag',
        type: 'GET',
        dataType: "json",
        error: function (response) {

        },
        success: function (response) {
            let tags=response;
            console.log(tags)

            let tagsSpan=document.getElementById('tags-span')
             let innerHTML="";
            for (let i=0;i<tags.length;i++){
               innerHTML+="<br>"
               innerHTML+=' <input type="checkbox" id="tag-'+tags[i].id+'" name="tag[]" value="'+tags[i].id+'">'+tags[i].name;

            }
            tagsSpan.innerHTML=innerHTML;
        }

    })


    /*
    * получаем список доступных тегов
    * */
}

$("#createListForm").submit(function (event) {
    event.preventDefault();
    jQuery.ajax({
        url: 'api/to-do-list',
        type: 'POST',
        dataType: "json",
        data: {
            name: document.getElementById('name').value
        },
        error: function (response) {

        },
        success: function (response) {
            getToLoLists()
        }

    })
});


$("#createListItemForm").submit(function (event) {
    event.preventDefault();

    var datastring = $("#contactForm").serialize();
    jQuery.ajax({
        url: 'api/to-do-list-item',
        type: 'POST',
        dataType: 'form',
        processData: false,
        contentType: false,
        data: new FormData(this),
        error: function (response) {

        },
        success: function (response) {
            document.getElementById('close-create-list-item-button').click()
            getToLoLists()
        }

    })
});

