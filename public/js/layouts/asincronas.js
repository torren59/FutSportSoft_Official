$('.productcheck').on('change', listar);



function listar(){
    let checks = $('.lista_productos').find('.productcheck');
    let arr = new Array();
    arr = checks.toArray();
    let Seleccionados = new Array();

    arr.forEach(element => {
        if($(element).prop('checked')){
            Seleccionados.push($(element).val());
        }
    });

   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        type: 'post',
        url: '/venta/listaseleccionados',
        dataType: 'json',
        data: {'seleccionados': JSON.stringify(Seleccionados)},
        success: function(data) {
            let lista_selects = ""
            // let receptor = JSON.parse(data);
            data.forEach(element => {
                 lista_selects +='<div class="col-md-12 btn btn-success" style="width:100%;height:80px;margin-bottom:5px;">'+
                 element.NombreProducto+'</div>';
                 console.log(element.NombreProducto);
            });
            
            $('.lista_selects').html(lista_selects);
        },
        error: function(data) {
          alert('Error '+data);
        }
    });
}

