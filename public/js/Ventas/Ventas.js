// Preadición producto frond

const { post } = require("jquery");
const { toInteger } = require("lodash");

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

function validateInput(Orden, Existencia){
 
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
        return true();
    }
}

function saveProduct(){
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