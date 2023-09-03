//id нам нужен, чтоб понимать, сколько раз добавили новую характеристику
let id = 1;
const myForm = document.getElementById('myForm'); // получаем форму по ее id
const table_stat = document.getElementById("statistic-container");
document.querySelector("#btn_main").onclick = function(){
    let i = 1;
    var char = '';
    var point = '';
    var name = '';
    //Объединяем несколько характеристик и оценок в одно, чтобы отправить на сервер как два инпута
    //с характеристикой и оценкой
    while (i <= id) {
        name = 'clone_'+i;
        var parent = document.getElementById(name);
        for (const child of parent.children) {
            for (const child2 of child.children) {
                for (const child3 of child2.children) {
                    if (child3.id=='char_list'){
                        if (char == '') {
                            char = child3.value;
                        }
                        else{
                            char = char + '&' + child3.value;
                        }
                    }
                    if (child3.id=='point_list'){
                        if (point == '') {
                            point = child3.value;
                        }
                        else{
                            point = point + '&' + child3.value;
                        }
                    }
                }
            }
        }
        i++;
    }

    document.getElementById("char_input").value = char;
    document.getElementById("point_input").value = point;
    var form = $(myForm),
        data = $(myForm).serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: data,
        success: function(data){
            table_stat.innerHTML = '';
            for (var i = 0; i < data.length; i++) {
                $("table.table tbody").append("<tr>" +
                    "<td>" + data[i]['name'] + "</td>" +
                    "<td>" + data[i]['character'] + "</td>" +
                    "<td>" + data[i]['point'] + "</td>" +
                    "</tr>");
            }
        },
        error: function(){
            alert('Error!');
        }
    });
    return false;
};

//Если нажат плюс, то клонируем блок
document.querySelector("#btn_plus").onclick = function(){

    let parent = document.getElementById('block');
    let elem = parent.querySelector('#clone_1');
    let clone = elem.cloneNode(true);

    id++;
    clone.id = 'clone_' + id;
    parent.appendChild(clone);

};