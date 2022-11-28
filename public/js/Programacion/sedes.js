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

    console.log('rows');
    console.log(sedes);

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
    msg += 'Sede '+ sedes[0].NombreSede +' vinculada a la programación con id ';
    msg += sedes[0].ProgramacionId+' <br> Total programaciones vinculadas: '+(rows);

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
async function changeState(sedeId){

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
async function tryChange(sedeId, modalId){
    if(changeNow(sedeId)){
        changeState(sedeId);
        return;
    }

    let sedes = await getRows(sedeId);

    if(!canChange(sedes)){
        cancelUncheck(sedeId);
        setMsg(sedes);
        alterModal(modalId);
        return;
    }

    changeState(sedeId);
}