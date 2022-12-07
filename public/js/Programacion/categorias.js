/**
 * @param {int} categoriaId
 * @return boolean Estado
 */
 function changeNow(categoriaId){
    let Estado = $('#check_'+categoriaId).prop('checked');
    return Estado;
}

/**
 * @param {int} CategoriaId
 * @return {string} Msg
 */
 async function getRows(categoriaId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let categorias = await $.ajax({
        type: 'post',
        url: '/categoria/puedeCambiar',
        dataType: 'json',
        data: { 'CategoriaId': JSON.stringify(categoriaId) },
        success: function (data) {
        },
        error: function (data) {
            alert('Error ' + data);
        }
    });

    console.log('rows');
    console.log(categorias);

    return categorias;
}


/**
 * @param {array} categorias
 * @return boolean Permission
 */
 function canChange(categorias){
    if(categorias.length > 0){
        return false;
    }
    else{
        return true;
    }
}

/**
 * @param {int} categoriaId
 */
function cancelUncheck(categoriaId){
    $('#check_'+categoriaId).prop('checked',true);
}

/**
 * @param {Array} categorias
 */
function setMsg(categorias){
    let msg = "";
    let rows = categorias.length;
    msg += 'Categoria '+ categorias[0].NombreCategoria +' vinculada al grupo con id ';
    msg += categorias[0].GrupoId+' <br> Total grupos vinculados: '+(rows);

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
 * @param {int} categoriaId
 */
async function changeState(categoriaId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/categoria/cambiarEstado',
        dataType: 'json',
        data: {
            'CategoriaId': JSON.stringify(categoriaId),
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
 * @param {int} categoriaId
 * @param {string} modalId
 */
async function tryChange(categoriaId, modalId){
    if(changeNow(categoriaId)){
        changeState(categoriaId);
        return;
    }

    let categorias = await getRows(categoriaId);

    if(!canChange(categorias)){
        cancelUncheck(categoriaId);
        setMsg(categorias);
        alterModal(modalId);
        return;
    }

    changeState(categoriaId);
}
