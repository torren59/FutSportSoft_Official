// Preadición producto frond

const { post } = require("jquery");
const { toInteger, concat } = require("lodash");



function blockSpan(){
    let entorno = document.getElementById('Products_Zone');
    let state = entorno.classList.contains('pointer_disable');

    if(state == false){
        entorno.classList.add('pointer_disable');
    }
}

function unblockSpan(){
    let entorno = document.getElementById('Products_Zone');
    let state = entorno.classList.contains('pointer_disable');
    
    if(state == true){
        entorno.classList.remove('pointer_disable');
    }
}

function openModal(idadicionobj){
    let adicion = document.getElementById(idadicionobj);
    estado=adicion.classList.contains('adicion_off');

    if(estado==true){
        adicion.classList.remove('adicion_off');
        adicion.classList.add('floatmodal');
    }
}

function closeModal(idadicionobj){
    let adicion = document.getElementById(idadicionobj);
    estado=adicion.classList.contains('adicion_off');
    $('#Orden').prop('value',null);

    if(estado==false){
        adicion.classList.remove('floatmodal');
        adicion.classList.add('adicion_off');
    }
}

function pushDataToOrder(ProductoId, Nombre, Cantidad){
    $('#ProductoId').prop('value',ProductoId);
    $('#Product_Name_Camp').prop('value',Nombre);
    $('#Product_Cantidad_Camp').prop('value',Cantidad);
}

function addProduct(ProductoId, NombreProducto, Cantidad){
    
    if(isAdded(ProductoId)){
        return;
    }

    pushDataToOrder(ProductoId,NombreProducto,Cantidad);
    blockSpan();
    openModal('OrderProduct');
}

function cancelAddProduct(){
    closeModal('OrderProduct');
    unblockSpan();
}

// Agregar Producto Backend

function getOrden(){
    let Orden = $('#Orden').val();
    return Orden;
}

function getExistencia(){
    let Existencia = $('#Product_Cantidad_Camp').val();
    return Existencia;
}

function getProductoId(){
    let ProductoId = $('#ProductoId').val();
    return ProductoId;
}

function validateInput(){
    let Orden = getOrden();
    let Existencia = getExistencia();
    if(Orden == null || Orden == 0){
        return 0;
    }

    Orden = parseInt(Orden);
    Existencia = parseInt(Existencia);

    if(Orden > Existencia){
        return 1;
    }

    return true;
}

function isAdded(ProductoId){
    let Card = document.getElementById('Card_'+parseInt(ProductoId));
    let isAdded = Card.classList.contains('Manual_Card_Selected');
    return isAdded;
}

/**
 * @boolean or @int validatedInput
 * @return boolean
 * 
 * false = Imprimió error
 * true = No imprimió error
 */
function getErrorMessage(ValidatedInput){
    if(ValidatedInput == 0){
        let ContenidoError = 'Evita enviar el campo vacío o con valor de cero';
        $('#OrdenError').html(ContenidoError);
        return false;
    }

    if(ValidatedInput === 1){
        let ContenidoError = 'Cantidad excede el máximo en existencias';
        $('#OrdenError').html(ContenidoError);
        return false;
    }

    if(ValidatedInput === true){
        return true;
    }
}

function saveProduct(){
    if(getErrorMessage(validateInput()) == false){
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
        success: function(data){
            data = Object.entries(data);
            selectCard();
            printOrden();
            selectCardOptions();
            closeModal('OrderProduct');
            unblockSpan();
            console.log(data);
        },
        error: function(error){
            alert(error);
        }
    });
}

//  postAdicion producto frond
function selectCard(){
    let ProductoId = getProductoId();
    let Card = document.getElementById('Card_'+parseInt(ProductoId));
    Card.classList.add('Manual_Card_Selected');
}

function selectCardOptions(){
    let ProductoId = getProductoId();
    let Card = document.getElementById('Card_Options_'+parseInt(ProductoId));
    Card.classList.remove('Card_Options_disable');
    Card.classList.add('Card_Options');
}

function printOrden(){
    let ProductoId = getProductoId();
    let Orden = getOrden();
    let Card = document.getElementById('Card_Orden_'+parseInt(ProductoId));
    $('#Card_Orden_'+parseInt(ProductoId)).html(Orden);
}

// Eliminación producto Frontend

function unselectCard(ProductoId){
    let Card = document.getElementById('Card_'+parseInt(ProductoId));
    Card.classList.remove('Manual_Card_Selected');
}

function unselectCardOptions(){
    let ProductoId = getProductoId();
    let Card = document.getElementById('Card_Options_'+parseInt(ProductoId));
    Card.classList.remove('Card_Options');
    Card.classList.add('Card_Options_disable');
}
//Eliminación producto Backend

function deleteProduct(ProductoId){

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
        success: function(data){
            unselectCard(ProductoId);
            unselectCardOptions(ProductoId);
            data = Object.entries(data);
            console.log(data);
        },
        error: function(error){
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