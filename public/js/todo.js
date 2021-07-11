$( document ).ready(function() {
   getToLoLists()
});

$( "#createListForm" ).submit(function( event ) {
    event.preventDefault();
    jQuery.ajax({
        url: 'api/to-do-list',
        type: 'POST',
        dataType: "json",
        data:{
           name:document.getElementById('name').value
        },
        error: function (response) {

        },
        success: function (response) {
            getToLoLists();
            document.getElementById('nemToListModelClouseButton').click();
        }

    })
});


function getToLoLists(){
    jQuery.ajax({
        url: 'api/to-do-list',
        type: 'GET',
        dataType: "json",
        error: function (response) {

        },
        success: function (response) {
            let responseData=response;
            console.log(responseData)

            let html="";

            for (let i = 0; i < responseData.length; i++) {

                let items=responseData[i].item;

                let itemHtml="";

                for (let j=0;j<items.length;j++){
                    itemHtml+="<br><b>"+items[j].name+"</b>"
                    itemHtml+="<br>"+items[j].description+""
                    if(!items[j].image) {
                        itemHtml += "<br><img width='40px' src='" + items[j].image + "'>"
                    }
                }


                html+="<div class=\"card\" style=\"width: 18rem;\">\n" + responseData[i].name+

                    "  <div class=\"card-body\">\n" +
                    "            <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" onclick='setListItem("+responseData[i].id+")' data-target=\"#createToDoListItemModal\">\n" +                    "                Создать элемент списка\n" +
                    "            </button>"

                     +itemHtml+

                    "  </div>\n" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }

            document.getElementById('toDoListList').innerHTML=html;

        }

    })
}

function setListItem(id){
    document.getElementById("list_id").value=id;
}

$( "form#createListItemForm" ).on("submit",function( event ) {
    event.preventDefault();
    event.preventDefault();
    var formData = new FormData(this);


    jQuery.ajax({
        url: 'api/to-do-list-item',
        type: 'POST',
        data: formData,
        processData: false,
        error: function (response) {

        },
        success: function (response) {
            getToLoLists();
            document.getElementById('nemToDoItemModelClouseButton').click();
        }

    })
});
