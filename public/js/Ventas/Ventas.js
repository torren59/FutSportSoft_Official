// Preadición producto frond
$('#Descuento_On_Confirm').on('change',addConfirmation);
const { post } = require("jquery");
const { toInteger, concat } = require("lodash");



function blockSpan() {
    let entorno = document.getElementById('Products_Zone');
    let state = entorno.classList.contains('pointer_disable');

    if (state == false) {
        entorno.classList.add('pointer_disable');
    }
}

function unblockSpan() {
    let entorno = document.getElementById('Products_Zone');
    let state = entorno.classList.contains('pointer_disable');

    if (state == true) {
        entorno.classList.remove('pointer_disable');
    }
}

function openModal(idadicionobj) {
    let adicion = document.getElementById(idadicionobj);
    estado = adicion.classList.contains('adicion_off');

    if (estado == true) {
        adicion.classList.remove('adicion_off');
        adicion.classList.add('floatmodal');
    }
}

function closeModal(idadicionobj) {
    let adicion = document.getElementById(idadicionobj);
    estado = adicion.classList.contains('adicion_off');
    $('#Orden').prop('value', null);

    if (estado == false) {
        adicion.classList.remove('floatmodal');
        adicion.classList.add('adicion_off');
    }
}

function pushDataToOrder(ProductoId, Nombre, Cantidad) {
    $('#ProductoId').prop('value', ProductoId);
    $('#Product_Name_Camp').prop('value', Nombre);
    $('#Product_Cantidad_Camp').prop('value', Cantidad);
}

function addProduct(ProductoId, NombreProducto, Cantidad) {

    if (isAdded(ProductoId)) {
        return;
    }

    pushDataToOrder(ProductoId, NombreProducto, Cantidad);
    blockSpan();
    openModal('OrderProduct');
}

function cancelAddProduct() {
    closeModal('OrderProduct');
    unblockSpan();
}
// Inserción de facturación en confirmación

async function openConfirmationModal(IdModal){
    Info = await getFacturacion();
    if(!Info){
        return;
    }
    $('#Total_On_Confirm').prop('value', Info[0]['VentaData']['Total']);
    let Iva =  parseInt(Info[0]['VentaData']['Total']) - parseInt(Info[0]['VentaData']['SubTotal']);
    $('#Iva_On_Confirm').prop('value', Iva);
    $('#SubTotal_On_Confirm').prop('value', Info[0]['VentaData']['SubTotal']);
    openModal(IdModal);
}

function getDescuento(){
    let Descuento = $('#Descuento_On_Confirm').val();
    console.log('Descuento: '+Descuento);
    if(Descuento.length < 1){
        Descuento = 0;
    }

    $('#Descuento').prop('value', Descuento);
    return Descuento;
}

function validateDescuento(Info, Descuento){    
    if(Descuento == 0){
        return true;
    }
    if(parseInt(Descuento) < 0){
        return 0;
    }
    let Total = parseInt(Info[0]['VentaData']['Total']);
    if(parseInt(Descuento) > parseInt(Total)){
        return 1;
    }
    else{
        return true;
    }
}

function getErrorMessage_Confirmation(ValidatedInput){
    if(ValidatedInput === true){
        return true;
    }
    if(ValidatedInput === 0){
        let Message = 'El descuento debe ser un valor positivo';
        $('#ConfirmationError').html(Message);
        return false;
    }
    if(ValidatedInput === 1){
        let Message = 'El descuento No puede ser mayor al total de compra';
        $('#ConfirmationError').html(Message);
        return false;
    }
}

function printFinalTotal(data, Descuento){
    let Info = data;

    if(Descuento == 0 || Descuento == null ){
        $('#Total_On_Confirm').prop('value', Info[0]['VentaData']['Total']);
        return;
    }

    let NewTotal = parseInt(Info[0]['VentaData']['Total']) - Descuento;
    $('#Total_On_Confirm').prop('value', NewTotal);
}

function printFinalIva(data, Descuento){
    let Info = data;
    let Iva =  parseInt(Info[0]['VentaData']['Total']) - parseInt(Info[0]['VentaData']['SubTotal']);
    $('#Iva_On_Confirm').prop('value', Iva);
}

function printFinalSubTotal(data, Descuento){
    let Info = data;

    if(Descuento == 0  || Descuento == null ){
        $('#SubTotal_On_Confirm').prop('value', Info[0]['VentaData']['SubTotal']);
        return;
    }

    let NewSubTotal = parseInt(Info[0]['VentaData']['SubTotal']) - Descuento;
    $('#SubTotal_On_Confirm').prop('value', NewSubTotal);
}

async function addConfirmation(){
    let Info = await getFacturacion();
    if(Info == 0){
        return 0;
    }
    let Descuento = parseInt(getDescuento());
    let Confirmation = getErrorMessage_Confirmation(validateDescuento(Info, Descuento));
    console.log(Confirmation);
    console.log(validateDescuento(Info, Descuento));
    if(!Confirmation){
        return 0;
    }

    printFinalTotal(Info, Descuento);
    printFinalIva(Info, Descuento);
    printFinalSubTotal(Info, Descuento);

    return 1;
}

async function openSendButton(){
    let Confirmacion = await addConfirmation();

    if(Confirmacion == 0){
        return;
    }

    closeModal('ConfirmationModal');
    openModal('SendButton');
}


// Inserción de facturación en frontend

function getFacturacion() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let result = $.ajax({
        type: 'post',
        url: '/venta/getFacturacion',
        dataType: 'json',
        data: {
        },
        success: function (data) {
            // data = Object.entries(data);
            // let Info = data[0][1]['VentaData'];
            // console.log(Info);
            // return Info;
        },
        error: function (error) {
            alert(error);
        }
    });

    return result;
}

function printSubTotal(data) {
    let Info = data;
    console.log(Info);
    if(Info == 0){
        $('#SubTotal').prop('value', 0);
        return
    }

    $('#SubTotal').prop('value', Info[0]['VentaData']['SubTotal']);
}

function printTotal(data) {
    let Info = data;

    if(Info == 0){
        $('#Total').prop('value', 0);
        return
    }

    $('#Total').prop('value', Info[0]['VentaData']['Total']);
}

function printIva(data) {
    let Info = data;

    if(Info == 0){
        $('#Iva').prop('value', 0);
        return
    }

    let Total = Info[0]['VentaData']['Total'];
    let SubTotal = Info[0]['VentaData']['SubTotal'];
    let Iva = parseInt(Total) - parseInt(SubTotal);
    $('#Iva').prop('value', Iva);
}


// Agregar Producto Backend

function getOrden() {
    let Orden = $('#Orden').val();
    return Orden;
}

function getExistencia() {
    let Existencia = $('#Product_Cantidad_Camp').val();
    return Existencia;
}

function getProductoId() {
    let ProductoId = $('#ProductoId').val();
    return ProductoId;
}

function validateInput() {
    let Orden = getOrden();
    let Existencia = getExistencia();
    if (Orden == null || Orden == 0) {
        return 0;
    }

    Orden = parseInt(Orden);
    Existencia = parseInt(Existencia);

    if (Orden > Existencia) {
        return 1;
    }

    return true;
}

function isAdded(ProductoId) {
    let Card = document.getElementById('Card_' + parseInt(ProductoId));
    let isAdded = Card.classList.contains('Manual_Card_Selected');
    return isAdded;
}

function getErrorMessage(ValidatedInput) {
    if (ValidatedInput == 0) {
        let ContenidoError = 'Evita enviar el campo vacío o con valor de cero';
        $('#OrdenError').html(ContenidoError);
        return false;
    }

    if (ValidatedInput === 1) {
        let ContenidoError = 'Cantidad excede el máximo en existencias';
        $('#OrdenError').html(ContenidoError);
        return false;
    }

    if (ValidatedInput === true) {
        return true;
    }
}

function saveProduct() {
    if (getErrorMessage(validateInput()) == false) {
        return;
    }

    let ProductoId = getProductoId();
    let Orden = getOrden();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/venta/addProducto',
        dataType: 'json',
        data: {
            'ProductoId': ProductoId,
            'Orden': Orden
        },
        success: async function (data) {
            data = Object.entries(data);
            selectCard();
            printOrden();
            selectCardOptions();
            closeModal('OrderProduct');
            unblockSpan();
            let datos = await getFacturacion();
            printSubTotal(datos);
            printTotal(datos);
            printIva(datos);
        },
        error: function (error) {
            alert(error);
        }
    });
}

//  postAdicion producto front
function selectCard() {
    let ProductoId = getProductoId();
    let Card = document.getElementById('Card_' + parseInt(ProductoId));
    Card.classList.add('Manual_Card_Selected');
}

function selectCardOptions() {
    let ProductoId = getProductoId();
    let Card = document.getElementById('Card_Options_' + parseInt(ProductoId));
    Card.classList.remove('Card_Options_disable');
    Card.classList.add('Card_Options');
}

function printOrden() {
    let ProductoId = getProductoId();
    let Orden = getOrden();
    let Card = document.getElementById('Card_Orden_' + parseInt(ProductoId));
    $('#Card_Orden_' + parseInt(ProductoId)).html(Orden);
}

// Eliminación producto Frontend

function unselectCard(ProductoId) {
    let Card = document.getElementById('Card_' + parseInt(ProductoId));
    Card.classList.remove('Manual_Card_Selected');
}

function unselectCardOptions(ProductoId) {
    let Card = document.getElementById('Card_Options_' + parseInt(ProductoId));
    Card.classList.remove('Card_Options');
    Card.classList.add('Card_Options_disable');
}

//Eliminación producto Backend
function deleteProduct(ProductoId) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/venta/deleteProducto',
        dataType: 'json',
        data: {
            'ProductoId': ProductoId,
        },
        success: async function (data) {
            unselectCard(ProductoId);
            unselectCardOptions(ProductoId);
            let datos = await getFacturacion();
            console.log(datos);
            printSubTotal(datos);
            printTotal(datos);
            printIva(datos);
        },
        error: function (error) {
            alert(error);
        }
    });
}

function getArray() {
    $.ajax({
        type: 'get',
        url: '/venta/getArray/',
        dataType: 'json',
        data: { 'numero': JSON.stringify(1) },

        success: function (data) {
            numero = Object.entries(data);
            numero.forEach(element => {

            });
            console.log(numero);
        },

        error: function (data) {
            console.log(data);
        }

    });
}