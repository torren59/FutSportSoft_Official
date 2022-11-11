$(".productcheck").on("change", calcular);
$(".Cantidad").on("blur", calcular);
$(".ValorUnitario").on("blur", calcular);
$(".Descuento").on("blur", calcular);
$(".deporte_select").on("change", push_categorias);
$(".categoria_select").on("change", push_grupos);

function listar() {
    let checks = $(".lista_productos").find(".productcheck");
    let arr = new Array();
    arr = checks.toArray();
    let Seleccionados = new Array();

    arr.forEach((element) => {
        if ($(element).prop("checked")) {
            Seleccionados.push($(element).val());
        }
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "post",
        url: "/compras/listaseleccionados",
        dataType: "json",
        data: { seleccionados: JSON.stringify(Seleccionados) },
        success: function (data) {
            let lista_selects = "";

            data.forEach((element) => {
                let Comprados = $("#Cantidad" + element.ProductoId).val();
                let Valor = $("#ValorUnitario" + element.ProductoId).val();

                lista_selects +=
                    '<div class="col-md-6 btn btn-primary" style="width:100%;height:170px;margin-bottom:5px;">' +
                    element.NombreProducto +
                    "<br>" +
                    "Tipo " +
                    element.TipoProducto +
                    "  Talla " +
                    element.Talla +
                    "<br>" +
                    "Existencias " +
                    element.Cantidad +
                    "<br>" +
                    "Cantidad Comprada " +
                    Comprados +
                    "<br>" +
                    "Valor Unitario " +
                    Valor +
                    "</div>";
                console.log(
                    element.NombreProducto,
                    element.TipoProducto,
                    element.Talla,
                    element.Cantidad
                );
            });

            $(".lista_selects").html(lista_selects);
        },
        error: function (data) {
            alert("Error " + data);
        },
    });
}


function listarDeportistas() {
    let checks = $(".lista_productos").find(".productcheck");
    let arr = new Array();
    arr = checks.toArray();
    let Seleccionados = new Array();

    arr.forEach((element) => {
        if ($(element).prop("checked")) {
            Seleccionados.push($(element).val());
        }
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "post",
        url: "/grupos/listaseleccionados",
        dataType: "json",
        data: { seleccionados: JSON.stringify(Seleccionados) },
        success: function (data) {
            let lista_selects = "";

            data.forEach((element) => {

                lista_selects +=
                    '<div class="col-md-6 btn btn-primary" style="width:100%;height:170px;margin-bottom:5px;">' +
                    element.Nombre +
                    "<br>" +
                    "Documento " +
                    element.Documento +
                    "</div>";
                console.log(
                    element.Nombre,
                    element.Documento,
                );
            });

            $(".lista_selects").html(lista_selects);
        },
        error: function (data) {
            alert("Error " + data);
        },
    });
}

function push_categorias() {
    let DeporteId = parseInt($(".deporte_select").val());
    console.log(DeporteId);
    categoria_select = "<option value=''>Selecciona categoria</option>";

    $.ajax({
        type: "get",
        url: "/select/getcategoria/",
        dataType: "json",
        data: { DeporteId: JSON.stringify(DeporteId) },

        success: function (data) {
            categorias = Object.entries(data);
            categorias.forEach((element) => {
                categoria_select +=
                    "<option value='" +
                    element[1]["CategoriaId"] +
                    "'>" +
                    element[1]["NombreCategoria"] +
                    "</option>";
            });
            $(".categoria_select").html(categoria_select);
        },

        error: function (data) {
            alert("Error " + data);
        },
    });
}

function push_grupos() {
    let CategoriaId = parseInt($(".categoria_select").val());
    console.log(CategoriaId);
    grupo_select = "<option value=''>Selecciona grupo</option>";

    $.ajax({
        type: "get",
        url: "/select/getgrupo/",
        dataType: "json",
        data: { CategoriaId: JSON.stringify(CategoriaId) },

        success: function (data) {
            grupos = Object.entries(data);
            grupos.forEach((element) => {
                grupo_select +=
                    "<option value='" +
                    element[1]["GrupoId"] +
                    "'>" +
                    element[1]["NombreGrupo"] +
                    "</option>";
            });
            $(".grupo_select").html(grupo_select);
        },

        error: function (data) {
            alert("Error " + data);
        },
    });
}

function changeState(Nombre, Id) {
    swal.fire({
        title: "Guardado",
        icon: "success",
        text: "Deseas desactivar " + Nombre + "Con ID" + Id,
    });
}

function detalleCompras(NumeroFactura, IdModal, IdDiv) {
    Contenido = "";

    $.ajax({
        type: "get",
        url: "/compras/getDetalle/",
        dataType: "json",
        data: { NumeroFactura: JSON.stringify(NumeroFactura) },

        success: function (data) {
            compraTotalData = Object.entries(data);

            // Las variables contiene la info de compra y los artículos de la misma respectivamente
            Compra = compraTotalData[0][1][0];
            Articulos = compraTotalData[1][1];

            // Llenado de variable con html, cambiar diseño o estructura HTML desde aquí
            Contenido +=
                "<div>Factura N°: " + Compra["NumeroFactura"] + "</div>";
            Contenido +=
                "<div>Proveedor: " + Compra["NombreEmpresa"] + "</div>";
            Contenido +=
                "<div>Fecha de compra: " + Compra["FechaCompra"] + "</div>";
            Contenido +=
                "<div>Valor total: " + Compra["ValorCompra"] + "</div>";
            Contenido += "<div>Sub total: " + Compra["SubTotal"] + "</div>";
            Contenido += "<div>Iva: " + Compra["Iva"] + "</div>";
            Contenido += "<div>Descuento: " + Compra["Descuento"] + "</div>";
            Contenido +=
                "<center><h6><div><h1>Articulos Comprados</h1></div><h6></center>";
            Contenido += "<hr/>";
            Articulos.forEach((element) => {
                Contenido +=
                    "<div>Producto: " + element["NombreProducto"] + "</div>";
                Contenido += "<div>Talla: " + element["Talla"] + "</div>";
                Contenido += "<div>Cantidad: " + element["Cantidad"] + "</div>";
                Contenido +=
                    "<div>Precio Unitario: " +
                    element["PrecioCompra"] +
                    "</div>";
                Contenido += "<hr/>";
            });

            // NumeroFactura
            // NombreEmpresa
            // FechaCompra
            // NombreProducto
            // Talla
            // Cantidad
            // Precio Unitario

            // Inyección de info en el documento y llamado al modal
            $("#" + IdDiv).html(Contenido);
            switchadicion2(IdModal);
            console.log(Compra["NombreEmpresa"]);
        },

        error: function (data) {
            alert("Error " + data);
        },
    });
}

function detalleUsuario(id, IdModal, IdDiv) {
    Contenido = "";

    $.ajax({
        type: "get",
        url: "/usuario/getDetalle/",
        dataType: "json",
        data: { id: JSON.stringify(id) },

        success: function (data) {
            TotalData = Object.entries(data);

            // Las variables contiene la info de compra y los artículos de la misma respectivamente
             Usuario = TotalData[0][1];


            // // Llenado de variable con html, cambiar diseño o estructura HTML desde aquí
             Contenido +=
                 "<div>Documento: " + Usuario["Documento"] + "</div>";
             Contenido +=
                 "<div>Nombre: " + Usuario["Nombre"] + "</div>";
             Contenido +=
                 "<div>Rol: " + Usuario["name"] + "</div>";
             Contenido += "<div>N° Contacto: " + Usuario["Celular"] + "</div>";
             Contenido += "<div>Correo electrónico: " + Usuario["email"] + "</div>";
             Contenido += "<div>Fecha de nacimiento: " + Usuario["FechaNacimiento"] + "</div>";
             Contenido += "<div>Dirección: " + Usuario["Direccion"] + "</div>";


            // Inyección de info en el documento y llamado al modal
            $("#" + IdDiv).html(Contenido);
            switchadicion2(IdModal);
            // console.log(TotalData);

        },

        error: function (data) {
            alert("Error " + data);
        },
    });
}

function switchadicion2(idadicionobj) {
    let adicion = document.getElementById(idadicionobj);
    estado = adicion.classList.contains("adicion_off");

    if (estado == true) {
        adicion.classList.remove("adicion_off");
        adicion.classList.add("floatmodal");
    } else {
        adicion.classList.add("adicion_off");
        adicion.classList.remove("floatmodal");
    }
}

function calcular() {
    listar();
    let checks = $(".lista_productos").find(".productcheck");
    let arr = new Array();
    arr = checks.toArray();
    let Seleccionados = new Array();
    let SubTotal = 0;
    let PrecioTotal = 0;
    let Iva = 0;
    let Descuento = $("#Descuento").val();

    arr.forEach((element) => {
        if ($(element).prop("checked")) {
            Seleccionados.push($(element).val());
        }
    });

    Seleccionados.forEach((element) => {
        let Cantidad = $("#Cantidad" + element).val();
        let ValorUnitario = $("#ValorUnitario" + element).val();
        PrecioTotal += Cantidad * ValorUnitario;
    });

    Iva = PrecioTotal * 0.19;

    if (Descuento != null) {
        PrecioTotal = PrecioTotal - Descuento;
    }

    SubTotal = PrecioTotal - Iva;

    $("#PrecioTotal").prop("value", PrecioTotal);
    $("#SubTotal").prop("value", SubTotal);
    $("#Iva").prop("value", Iva);
    $("#Descuento").prop("value", Descuento);
    console.log("Se adjunta el iva");
}

function modalproveedor(){

}



