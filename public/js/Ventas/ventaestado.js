/**
 * @param {int} ventaId
 * @return boolean Estado
 */
function changeNow(ventaId){
    let Estado = $('#check_'+ventaId).prop('checked');
    return Estado;
}

/**
 * @param {Array} ventas
 */
function setMsg(ventaId){
    let msg = "";
    msg = '<button disabled class="btn btn-danger btn-sm">Cancelada</button>';
    $('#check_'+ventaId).html(msg);
}

/**
 * @param {int} ventaId
 */
async function changeState(ventaId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/venta/cambiarEstado',
        dataType: 'json',
        data: {
            'VentaId': JSON.stringify(ventaId),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });

}

/**
 *
 * @param {int} ventaId
 * @param {string} modalId
 */
async function tryChange(ventaId){

    if(!changeNow(ventaId)){
        changeState(ventaId);
        setMsg(ventaId);
        return;
    }

}
