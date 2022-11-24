/**
 * @param {int} sedeId
 * @return boolean Estado
 */
function changeNow(sedeId){
    let Estado = $('#check_'+sedeId).prop('checked');
    return Estado;
}

/**
 * @param {int} SedeId
 * @return {string} Msg
 */
 async function getRows(sedeId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let sedes = await $.ajax({
        type: 'post',
        url: '/sede/puedeCambiar',
        dataType: 'json',
        data: { 'SedeId': JSON.stringify(sedeId) },
        success: function (data) {
        },
        error: function (data) {
            alert('Error ' + data);
        }
    });

    return sedes;
}


/**
 * @param {array} sedes
 * @return boolean Permission
 */
 function canChange(sedes){
    if(sedes.length > 0){
        return false;
    }
    else{
        return true;
    }
}

/**
 * @param {int} sedeId
 */
function cancelUncheck(sedeId){
    $('#check_'+sedeId).prop('checked',true);
}

/**
 * @param {Array} sedes 
 */
function setMsg(sedes){
    let msg = "";
    let rows = sedes.length;
    msg += 'Sede vinculada a la programación ';

    sedes.forEach(element => {
        msg += element.ProgramacionId+' y otras '+(rows-1)+' programaciones';
    });

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
 * @param {int} sedeId 
 */
function changeState(sedeId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/sede/cambiarEstado',
        dataType: 'json',
        data: {
            'SedeId': JSON.stringify(sedeId),
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
 * @param {int} sedeId 
 * @param {string} modalId 
 */
function tryChange(sedeId, modalId){
    let sedes = getRows(sedeId);
    if(!canChange(sedes)){

    }
}