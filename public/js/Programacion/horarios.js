/**
 * @param {int} horarioId
 * @return boolean Estado
 */
 function changeNow(horarioId){
    let Estado = $('#check_'+horarioId).prop('checked');
    return Estado;
}

/**
 * @param {int} horarioId
 * @return {string} Msg
 */
 async function getRows(horarioId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let horarios = await $.ajax({
        type: 'post',
        url: '/horario/puedeCambiar',
        dataType: 'json',
        data: { 'HorarioId': JSON.stringify(horarioId) },
        success: function (data) {
        },
        error: function (data) {
            alert('Error ' + data);
        }
    });

    console.log('rows');
    console.log(horarios);

    return horarios;
}


/**
 * @param {array} horarios
 * @return boolean Permission
 */
 function canChange(horarios){
    console.log(horarios);
    if(horarios.length > 0){
        return false;
    }
    else{
        return true;
    }
}

/**
 * @param {int} horarioId
 */
function cancelUncheck(horarioId){
    $('#check_'+horarioId).prop('checked',true);
}

/**
 * @param {Array} horarios
 */
function setMsg(horarios){
    let msg = "";
    let rows = horarios.length;
    msg += '<h3>'+'Horario '+ horarios[0].NombreHorario +'<br>'+' vinculado a la programación con id '+
     horarios[0].ProgramacionId+' <br> Total programaciones vinculadas: '+(rows)+'<h3>';

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
 * @param {int} horarioId
 */
async function changeState(horarioId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/horario/cambiarEstado',
        dataType: 'json',
        data: {
            'HorarioId': JSON.stringify(horarioId),
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
 * @param {int} horarioId
 * @param {string} modalId
 */
async function tryChange(horarioId, modalId){
    if(changeNow(horarioId)){
        changeState(horarioId);
        return;
    }

    let horarios = await getRows(horarioId);

    if(!canChange(horarios)){
        cancelUncheck(horarioId);
        setMsg(horarios);
        alterModal(modalId);
        return;
    }

    changeState(horarioId);
}
