//Константа table с ид - player-container
const table = document.getElementById("player-container");
//Если нажата кнопка на форме  ид form-play
$('#form-play').on('beforeSubmit', function(){
    //Добавляем данные с формы в переменную
    var form = $(this),
        data = $(this).serialize();
    //Запускаем ajax - асинхронное обновление
    $.ajax({
        //Берем урл и тип запроса с формы
        url: form.attr("action"),
        type: form.attr("method"),
        data: data,
        //Если сервер все сделал
        success: function(data){
            //Сбрасываем форму
            form[0].reset();
            //Очищаем все внутри блока
            table.innerHTML = '';
            //Добавляем новые полученные данные с помощью цикла и создания новых элементов внутри table
            for (var i = 0; i < data.length; i++) {
                $(table).append('<div class="col-3">' + data[i]['name'] + '</div>');
                $(table).append(' <div class="col-7"> ' +
                    '<a class="btn btn-outline-danger btn-sm" ' +
                    'href="/basic/web/index.php?r=players%2Fdelplayer" data-method="post" ' +
                    'data-params="{&quot;id_name&quot;:'+ data[i]['id_name'] +'}">' +
                    'Удалить</a>' +
                    '</div>');
            }
        },
        //Если ошибка
        error: function(){
            alert('Error!');
        }
    });
    //Отменяем обновление страницы
    return false;
}).on('submit', function(e){
    e.preventDefault();
});