/**
 * @param {int} deporteId
 * @return boolean Estado
 */
 function changeNow(deporteId){
    let Estado = $('#check_'+deporteId).prop('checked');
    return Estado;
}

/**
 * @param {int} deporteId
 * @return {string} Msg
 */
 async function getRows(deporteId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let deportes = await $.ajax({
        type: 'post',
        url: '/deporte/puedeCambiar',
        dataType: 'json',
        data: { 'DeporteId': JSON.stringify(deporteId) },
        success: function (data) {
        },
        error: function (data) {
            alert('Error ' + data);
        }
    });

    console.log('rows');
    console.log(deportes);

    return deportes;
}


/**
 * @param {array} deportes
 * @return boolean Permission
 */
 function canChange(deportes){
    console.log(deportes);
    if(deportes.length > 0){
        return false;
    }
    else{
        return true;
    }
}

/**
 * @param {int} deporteId
 */
function cancelUncheck(deporteId){
    $('#check_'+deporteId).prop('checked',true);
}

/**
 * @param {Array} deportes
 */
function setMsg(deportes){
    let msg = "";
    let rows = deportes.length;
    msg += '<h3>'+'Deporte '+ deportes[0].NombreDeporte +'<br>'+' vinculado a la categoría con id '+
     deportes[0].CategoriaId+' <br> Total programaciones vinculadas: '+(rows)+'</h3>';

    $('#errorsEstadoMsg').html(msg);
}

/**
 * @param {int} modalId
 */
function alterModal(modalId){
    let adicion = document.getElementById(modalId);
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
 * @param {int} deporteId
 */
async function changeState(deporteId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/deporte/cambiarEstado',
        dataType: 'json',
        data: {
            'DeporteId': JSON.stringify(deporteId),
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
 * @param {int} deporteId
 * @param {string} modalId
 */
async function tryChange(deporteId, modalId){
    if(changeNow(deporteId)){
        changeState(deporteId);
        return;
    }

    let deportes = await getRows(deporteId);

    if(!canChange(deportes)){
        cancelUncheck(deporteId);
        setMsg(deportes);
        alterModal(modalId);
        return;
    }

    changeState(deporteId);
}
