$('.productcheck').on('change', listar);
$('.deporte_select').on('change',push_categorias);
$('.categoria_select').on('change',push_grupos);


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


function push_categorias(){
    let DeporteId = parseInt($('.deporte_select').val());
    console.log(DeporteId);
    categoria_select = "<option value=''>Selecciona categoria</option>";

    $.ajax({
        type: 'get',
        url: '/select/getcategoria/',
        dataType: 'json',
        data: {'DeporteId': JSON.stringify(DeporteId)},

        success: function(data) {
            categorias = Object.entries(data);
            categorias.forEach(element => {
                categoria_select += "<option value='"+element[1]['CategoriaId']+"'>"+ element[1]['NombreCategoria'] +"</option>"
            });
            $('.categoria_select').html(categoria_select);
        },

        error: function(data) {
          alert('Error '+data);
        }

    });
}


function push_grupos(){
    let CategoriaId = parseInt($('.categoria_select').val());
    console.log(CategoriaId);
    grupo_select = "<option value=''>Selecciona grupo</option>";

    $.ajax({
        type: 'get',
        url: '/select/getgrupo/',
        dataType: 'json',
        data: {'CategoriaId': JSON.stringify(CategoriaId)},

        success: function(data) {
            grupos = Object.entries(data);
            grupos.forEach(element => {
                grupo_select += "<option value='"+element[1]['GrupoId']+"'>"+ element[1]['NombreGrupo'] +"</option>"
            });
            $('.grupo_select').html(grupo_select);
        },

        error: function(data) {
          alert('Error '+data);
        }

    });
}

function changeState(Nombre, Id){
    swal.fire(
        {title: 'Guardado',
        icon: 'success',
        text: 'Deseas desactivar '+Nombre+'Con ID'+Id,
    }
    )
}

function detalleCompras(NumeroFactura, IdModal){
    $.ajax({
        type: 'get',
        url: '/compras/getdetalle/',
        dataType: 'json',
        data: {'NumeroFactura': JSON.stringify(NumeroFactura)},

        success: function(data) {
            compras = Object.entries(data);
            console.log(compras);
        },

        error: function(data) {
          alert('Error '+data);
        }

    });
}


