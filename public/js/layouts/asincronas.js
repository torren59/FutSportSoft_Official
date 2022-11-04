
$('.productcheck').on('change', listar);
$('.deporte_select').on('change', push_categorias);
$('.categoria_select').on('change', push_grupos);


function listar() {
    let checks = $('.lista_productos').find('.productcheck');
    let arr = new Array();
    arr = checks.toArray();
    let Seleccionados = new Array();

    arr.forEach(element => {
        if ($(element).prop('checked')) {
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
        data: { 'seleccionados': JSON.stringify(Seleccionados) },
        success: function (data) {
            let lista_selects = ""

            data.forEach(element => {
                lista_selects += '<div class="col-md-12 btn btn-success" style="width:100%;height:80px;margin-bottom:5px;">' +
                    element.NombreProducto + '</div>';
                console.log(element.NombreProducto);
            });

            $('.lista_selects').html(lista_selects);
        },
        error: function (data) {
            alert('Error ' + data);
        }
    });
}


function push_categorias() {
    let DeporteId = parseInt($('.deporte_select').val());
    console.log(DeporteId);
    categoria_select = "<option value=''>Selecciona categoria</option>";

    $.ajax({
        type: 'get',
        url: '/select/getcategoria/',
        dataType: 'json',
        data: { 'DeporteId': JSON.stringify(DeporteId) },

        success: function (data) {
            categorias = Object.entries(data);
            categorias.forEach(element => {
                categoria_select += "<option value='" + element[1]['CategoriaId'] + "'>" + element[1]['NombreCategoria'] + "</option>"
            });
            $('.categoria_select').html(categoria_select);
        },

        error: function (data) {
            alert('Error ' + data);
        }

    });
}


function push_grupos() {
    let CategoriaId = parseInt($('.categoria_select').val());
    console.log(CategoriaId);
    grupo_select = "<option value=''>Selecciona grupo</option>";

    $.ajax({
        type: 'get',
        url: '/select/getgrupo/',
        dataType: 'json',
        data: { 'CategoriaId': JSON.stringify(CategoriaId) },

        success: function (data) {
            grupos = Object.entries(data);
            grupos.forEach(element => {
                grupo_select += "<option value='" + element[1]['GrupoId'] + "'>" + element[1]['NombreGrupo'] + "</option>"
            });
            $('.grupo_select').html(grupo_select);
        },

        error: function (data) {
            alert('Error ' + data);
        }

    });
}

function changeState(Nombre, Id) {
    swal.fire(
        {
            title: 'Guardado',
            icon: 'success',
            text: 'Deseas desactivar ' + Nombre + 'Con ID' + Id,
        }
    )
}

function detalleCompras(NumeroFactura, IdModal, IdDiv) {
    Contenido = "";

    $.ajax({
        type: 'get',
        url: '/compras/getDetalle/',
        dataType: 'json',
        data: { 'NumeroFactura': JSON.stringify(NumeroFactura) },

        success: function (data) {
            compraTotalData = Object.entries(data);

            // Las variables contiene la info de compra y los artículos de la misma respectivamente
            Compra = compraTotalData[0][1][0];
            Articulos = compraTotalData[1][1];

            // Llenado de variable con html, cambiar diseño o estructura HTML desde aquí
            Contenido += "<div>Factura N°: " + Compra['NumeroFactura'] + "</div>" 
            Contenido += "<div>Proveedor: " + Compra['NombreEmpresa'] + "</div>" 
            Contenido += "<div>Fecha de compra: " + Compra['FechaCompra'] + "</div>" 
            Contenido += "<center><h6><div>Articulos Comprados</div><h6></center>" 
            Contenido += "<hr/>" 
            Articulos.forEach(
                element => {
                    Contenido += "<div>Producto: " + element['NombreProducto'] + "</div>" 
                    Contenido += "<div>Talla: " + element['Talla'] + "</div>" 
                    Contenido += "<div>Cantidad: " + element['Cantidad'] + "</div>" 
                    Contenido += "<div>Precio Unitario: " + element['PrecioCompra'] + "</div>" 
                    Contenido += "<hr/>" 
                }
            );

            // NumeroFactura
            // NombreEmpresa
            // FechaCompra
            // NombreProducto
            // Talla
            // Cantidad 
            // Precio Unitario

            // Inyección de info en el documento y llamado al modal
            $('#'+IdDiv).html(Contenido);
            switchadicion2(IdModal);
            console.log(Compra['NombreEmpresa']);
        },

        error: function (data) {
            alert('Error ' + data);
        }

    });
}

function switchadicion2(idadicionobj){
    let adicion = document.getElementById(idadicionobj);
    estado=adicion.classList.contains('adicion_off');

    if(estado==true){
        adicion.classList.remove('adicion_off');
        adicion.classList.add('floatmodal');
    }
    else{
        adicion.classList.add('adicion_off');
        adicion.classList.remove('floatmodal');
    }

}

