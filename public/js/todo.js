$(document).ready(function () {
    getToLoLists()
});

var tagArray=[];

function reset(){
    tagArray=[];
    this.getToLoLists();
}


function getToLoLists(Tag=null) {

    let url="api/to-do-list";

    let tagSearch=document.getElementById('tag-search');
    let tagSearchHtml="";
    if(Tag){
        tagArray.push(Tag)
        tagSearchHtml+="<b>Поиск по тегам</b>"

    }else {
        tagSearch.innerHTML="";
    }

    if(tagArray.length>0){
        url+="?";
        for(let i=0;i<tagArray.length;i++){
            url+=tagArray[i]+"&";

            tagSearchHtml+=tagArray[i]+",";
        }
        tagSearchHtml+="<br><button onclick='reset()'>Сбросить поиск по тегам</button>"
    }

    tagSearch.innerHTML=tagSearchHtml;

    jQuery.ajax({
        url: url,
        type: 'GET',
        dataType: "json",
        error: function (response) {

        },
        success: function (response) {
            let responseData = response;
            let html = "";

            for (let i = 0; i < responseData.length; i++) {

                let items = responseData[i].items;

                let itemHtml = "";

                for (let j = 0; j < items.length; j++) {
                    itemHtml += "<br><b>" + items[j].name + "</b>"
                    if(items[j].description) {
                        itemHtml += "<br>" + items[j].description + ""
                    }
                    if(items[j].image) {
                        itemHtml += "<br><img width='40px' src='" + items[j].image + "'>"
                    }
                }


                html += "<div class=\"card\" style=\"width: 18rem;\">\n" + responseData[i].name +

                    "  <div class=\"card-body\">\n" +
                    "            <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" onclick='setListItem(" + responseData[i].id + ")' data-target=\"#createToDoListItemModal\">\n" + " Создать элемент списка\n" +
                    "            </button>"

                    + itemHtml +

                    "<button type=\"button\" class=\"btn btn-primary\" onclick='shareLisItem("+ responseData[i].id+")' data-toggle=\"modal\" data-target=\"#shareListItemModal\">\n" +
                    "                Поделиться списком" +
                    "            </button>"

                    "  </div>\n" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            }

            document.getElementById('toDoListList').innerHTML = html;

        }

    })
}

function shareLisItem(id){
    jQuery.ajax({
        url: 'api/share/get_users_to_share',
        type: 'GET',
        dataType: "json",
        data: {
            list_item_id: id
        },
        error: function (response) {

        },
        success: function (response) {
            let users=response.users_to_share;
            let share=response.share;
            let html="";
             html+="Пользователи для кого можно расшарить список"
            for (let i=0;i<users.length;i++){
                html+='<br>';
                if (share.includes(users[i].id)){
                    html += ' <input type="checkbox" id="tag-' + users[i].id + '" name="share[]" value="' + users[i].id + '" checked>' + users[i].name;
                }else {
                    html += ' <input type="checkbox" id="tag-' + users[i].id + '" name="share[]" value="' + users[i].id + '">' + users[i].name;
                }
            }
            html+='<input type="hidden" name="list_id" id="list_id" value="'+id+'">'


            document.getElementById('share-span').innerHTML=html
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
            if(response.status===422){
                console.log("validation fail")
                let errors = response.responseText;

                errors = JSON.parse(errors)
                printErrorMsg(errors);
            }
        },
        success: function (response) {
            document.getElementById('close-create-list-item-button').click()
            getToLoLists()
        }

    })
});

//createTegForm

$("#createTegForm").submit(function (event) {
    event.preventDefault();

    var datastring = $("#contactForm").serialize();
    jQuery.ajax({
        url: 'api/tag',
        type: 'POST',
        dataType: 'form',
        processData: false,
        contentType: false,
        data: new FormData(this),
        error: function (response) {
            alert(response.data.message)
        },
        success: function (response) {


        }

    })
    document.getElementById('close-create-list-item-button').click()
    getTags();
});

$("#shareList").submit(function (event) {
    event.preventDefault();

    var datastring = $("#contactForm").serialize();
    jQuery.ajax({
        url: 'api/share/share_list',
        type: 'POST',
        dataType: 'form',
        processData: false,
        contentType: false,
        data: new FormData(this),
        error: function (response) {
            alert(response.data.message)
        },
        success: function (response) {


        }

    })
    document.getElementById('close-create-list-item-button').click()
    getTags();
});

function getTags() {
    jQuery.ajax({
        url: 'api/tag',
        type: 'GET',
        dataType: "json",
        error: function (response) {

        },
        success: function (response) {
            let responseData = response;
            let html = "";
            console.log(responseData);

            for (let i = 0; i < responseData.length; i++) {


                    html += responseData[i].name
                    html += "<button class='btn btn-danger' onclick='deleteTag(" + responseData[i].id + ")'>Удалить</button>"
                    html += "<br>"


                document.getElementById('tag-list').innerHTML = html;

            }

        }
    })
}

function deleteTag(id){
    let url='api/tag/'+id
    jQuery.ajax({
        url: url,
        type: 'DELETE',
        dataType: "json",
        error: function (response) {
                alert(response.text)
        },
        success: function (response) {
            getTags()
        }
    })
}

function printErrorMsg(msg) {
    let message = ""
    var arr = jQuery.makeArray(msg);

    if (arr[0] !== undefined && arr[0].errors !== undefined) {

        $.each(arr[0].errors, function (key, value) {
            message += value;
            message += "\n"
        });
    }

    alert(message)
}
