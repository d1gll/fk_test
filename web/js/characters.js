const table_char = document.getElementById("character-container");
$('#form-char').on('beforeSubmit', function(){
    var form = $(this),
        data = $(this).serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: data,
        success: function(data){
            form[0].reset();
            table_char.innerHTML = '';
            for (var i = 0; i < data.length; i++) {
                $(table_char).append('<div class="col-3">' + data[i]['character'] + '</div>');
                $(table_char).append(' <div class="col-7"> ' +
                    '<a class="btn btn-outline-danger btn-sm" ' +
                    'href="/basic/web/index.php?r=players%2Fdelchar" data-method="post" ' +
                    'data-params="{&quot;id_char&quot;:'+ data[i]['id_char'] +'}">' +
                    'Удалить</a>' +
                    '</div>');
            }
        },
        error: function(){
            alert('Error!');
        }
    });
    return false;
}).on('submit', function(e){
    e.preventDefault();
});