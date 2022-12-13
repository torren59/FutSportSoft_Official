function changeState2(NumeroFactura){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/compras/cambiarEstado',
        dataType: 'json',
        data: {
            'NumeroFactura': JSON.stringify(NumeroFactura),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}


/**
 * @param {int} modalId
 */
function alterModal(){
    let adicion = document.getElementById('errorsEstado');
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

/**
 * @param {int} compraId
 * @return boolean Estado
 */
function changeNow(compraId){
    let Estado = $('#check_'+compraId).prop('checked');
    return Estado;
}

/**
 * @param {int} CompraId
 * @return {string} Msg
 */
async function getRows(compraId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let compras = await $.ajax({
        type: 'post',
        url: '/compra/puedeCambiar',
        dataType: 'json',
        data: { 'CompraId': JSON.stringify(compraId) },
        success: function (data) {
        },
        error: function (data) {
            alert('Error ' + data);
        }
    });

    console.log('rows');
    console.log(compras);

    return compras;
}


/**
 * @param {array} compras
 * @return boolean Permission
 */
 function canChange(compras){
    if(compras.length > 0){
        return false;
    }
    else{
        return true;
    }
}

/**
 * @param {int} compraId
 */
function cancelUncheck(compraId){
    $('#check_state'+compraId).prop('checked',true);
}

/**
 * @param {Array} ventas
 */
function setMsg(compraId){
    let msg = "";
    msg = '<button disabled class="btn btn-danger btn-sm">Cancelada</button>';
    $('#check_'+compraId).html(msg);
}

/**
 * @param {Array} sedes
 */
function setError(canChange){
    let msg = "";
    let rows = canChange['ausencias'].length;
    msg += '<h3>'+canChange['ausencias'][0].NombreProducto+' y otros '+rows+' productos '+
    'no cuentan con existencias suficientes para realizar la devolución'+'<h3>';

    $('#errorsEstadoMsg').html(msg);

}


/**
 *
 * @param {int} compraId
 * @param {string} modalId
 */
async function tryChange(compraId){

    let canChange = await getRows(compraId);
    if(canChange['Estado'] == true){
        if(!changeNow(compraId)){
            changeState2(compraId);
            setMsg(compraId);
            return;
        }    
    }
    else{
        cancelUncheck(compraId);
        setError(canChange);
        alterModal();
    }
   /* */
}



