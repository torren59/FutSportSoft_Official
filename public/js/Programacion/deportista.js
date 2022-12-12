function changeState(Documento){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/deportista/cambiarEstado',
        dataType: 'json',
        data: {
            'Documento': JSON.stringify(Documento),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}

function hideAccTab(){
    let resources = ['newAccTab','noAccTab','choiceAccTab'];
    let seleccionado = $("input[name='howAcc']:checked").val();

    resources.forEach((element) => {
        if(element != seleccionado){
            let noChecked = document.getElementById(element);
            let estado = noChecked.classList.contains('oneOptionHide');
            if(!estado){
                noChecked.classList.remove('oneOptionShow');
                noChecked.classList.add('oneOptionHide');
            }
        }
    });

    let checkedItem = document.getElementById(seleccionado);
    checkedItem.classList.remove('oneOptionHide');
    checkedItem.classList.add('oneOptionShow');
}

function hideAccTab2(){
    let resources = ['newAccTab','choiceAccTab'];
    let seleccionado = $("input[name='howAcc']:checked").val();

    resources.forEach((element) => {
        if(element != seleccionado){
            let noChecked = document.getElementById(element);
            let estado = noChecked.classList.contains('oneOptionHide');
            if(!estado){
                noChecked.classList.remove('oneOptionShow');
                noChecked.classList.add('oneOptionHide');
            }
        }
    });

    let checkedItem = document.getElementById(seleccionado);
    checkedItem.classList.remove('oneOptionHide');
    checkedItem.classList.add('oneOptionShow');
}