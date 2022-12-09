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
                    '<div class=" card p-2 col-md-6" style="width:90%;height:170px;box-shadow: 0px 10px 10px -6px black;margin:5px;">' +
                    "<h3>" +
                    element.NombreProducto +
                    "</h3>" +
                    "<h4>Tipo:  " +
                    element.TipoProducto +
                    "</h4>" +
                    "<h4>Talla:  " +
                    element.Talla +
                    "</h4>" +
                    "<h4>Existencias:  " +
                    element.Cantidad +
                    "</h4>" +
                    "<h4>Cantidad Comprada: " +
                    Comprados +
                    "</h4>" +
                    "<h4>Valor Unitario:  " +
                    Valor +
                    "</h4>" +
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
                '<div class="container" style="text-align:center">' +
                "<p><h4>Factura N°: " +
                Compra["NumeroFactura"] +
                "</h4>" +
                "<h4>Proveedor: " +
                Compra["NombreEmpresa"] +
                "</h4>" +
                "<h4>Fecha de compra: " +
                Compra["FechaCompra"] +
                "</h4>" +
                "<h4>Valor total: " +
                Compra["ValorCompra"] +
                "</h4>" +
                "<h4>Sub total: " +
                Compra["SubTotal"] +
                "</h4>" +
                "<h4>Iva: " +
                Compra["Iva"] +
                "<h4>Descuento: " +
                Compra["Descuento"] +
                "</h4>" +
                "</div>";
            Contenido +=
                "<center><div><h1>Articulos Comprados</h1></div></center>";
            Contenido += "<hr/>";
            Articulos.forEach((element) => {
                Contenido +=
                    '<div class=" card p-2 col-md-6" style="width:90%;height:170px;box-shadow: 0px 10px 10px -6px black;margin:5px;">' +
                    "<h4>Producto: " +
                    element["NombreProducto"] +
                    "</h4>" +
                    "<h4>Talla: " +
                    element["Talla"] +
                    "</h4>" +
                    "<h4>Cantidad: " +
                    element["Cantidad"] +
                    "</h4>" +
                    "<h4>Precio Unitario: " +
                    element["PrecioCompra"] +
                    "</h4>" +
                    "<h4></div>";
                Contenido += "<hr/>";
            });

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

// Detalles para roles
function DetalleRoles(id, IdModal, IdDiv) {
    Contenido = "";

    $.ajax({
        type: "get",
        url: "/roles/getDetalle/",
        dataType: "json",
        data: { id: JSON.stringify(id) },

        success: function (data) {
            PermisosTotalData = Object.entries(data);
            // Las variables contiene la info de compra y los artículos de la misma respectivamente
            Roles = PermisosTotalData[0][1][0];
            Permiso = PermisosTotalData[1][1];

            //  Llenado de variable con html, cambiar diseño o estructura HTML desde aquí
            Contenido +=
                '<div class="container" style="text-align:center">' +
                "<h4>Nombre del Rol: " +
                Roles["name"] +
                "</h4>" +
                "</div>";
            Contenido +=
                "<center><div><h1>Permisos asociados</h1></div></center>";
            Contenido += "<hr/>";
            Permiso.forEach((element) => {
                Contenido +=
                    '<div class=" card p-2 col-md-6" style="width:90%;height:50px;box-shadow: 0px 10px 10px -6px black;margin:5px;">' +
                    "<h4>Producto: " +
                    element["NombrePermiso"] +
                    "</h4>" +
                    "</div>";
                Contenido += "<hr/>";
            });

            // Inyección de info en el documento y llamado al modal
            $("#" + IdDiv).html(Contenido);
            switchadicion2(IdModal);
            console.log(Roles["name"]);
        },

        error: function (data) {
            alert("Error " + data);
        },
    });
}





// Detalles para grupos
function DetalleGrupos(GrupoId, IdModal, IdDiv) {
    Contenido = "";

    $.ajax({
        type: "get",
        url: "/grupos/getDetalle/",
        dataType: "json",
        data: { GrupoId: JSON.stringify(GrupoId) },

        success: function (data) {
            GruposTotalData = Object.entries(data);
            // Las variables contiene la info de compra y los artículos de la misma respectivamente
            Grupo = GruposTotalData[0][1][0];
            Deportista = GruposTotalData[1][1];
            //  Llenado de variable con html, cambiar diseño o estructura HTML desde aquí
            Contenido +=
                '<div class="container" style="text-align:center">' +
                "<h4>Nombre del Grupo: " +
                Grupo["NombreGrupo"] +
                "</h4>" +
                "<h4>Nombre de la categoría: " +
                Grupo["NombreCategoria"] +
                "</h4>" +
                "<h4>Nombre del encargado: " +
                Grupo["Nombre"] +
                "</h4>" +
                "</div>";
            Contenido +=
                "<center><div><h1>Deportistas asociados</h1></div></center>";
            Contenido += "<hr/>";
            Deportista.forEach((element) => {
                Contenido +=
                    '<div class=" card p-2 col-md-6" style="width:90%;height:50px;box-shadow: 0px 10px 10px -6px black;margin:5px;">' +
                    "<h4>Producto: " +
                    element["Nombre"] +
                    "</h4>" +
                    "</div>";
                Contenido += "<hr/>";
            });

            // Inyección de info en el documento y llamado al modal
            $("#" + IdDiv).html(Contenido);
            switchadicion2(IdModal);
            console.log(Grupo["NombreGrupo"]);
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
                '<div class="container" style="text-align:center">' +
                "<h4>Documento: " +
                Usuario["Documento"] +
                "</h4>" +
                "<h4>Nombre: " +
                Usuario["Nombre"] +
                "</h4>" +
                "<h4>Rol: " +
                Usuario["name"] +
                "</h4>" +
                "<h4>N° Contacto: " +
                Usuario["Celular"] +
                "</h4>" +
                "<h4>Correo electrónico: " +
                Usuario["email"] +
                "</h4>" +
                "<h4>Fecha de nacimiento: " +
                Usuario["FechaNacimiento"] +
                "</h4>" +
                "<h4>Dirección: " +
                Usuario["Direccion"] +
                "</h4>" +
                "</div>";

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

function modalproveedor() {}
