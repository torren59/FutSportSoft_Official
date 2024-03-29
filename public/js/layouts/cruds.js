

function switchadicion(idadicionobj){
    let adicion = document.getElementById(idadicionobj);
    estado=adicion.classList.contains('adicion_off');

    if(estado==true){
        adicion.classList.remove('adicion_off');
    }
    else{
        adicion.classList.add('adicion_off');
    }

}

function switchadicion2(idadicionobj){
    let adicion = document.getElementById(idadicionobj);
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

function switchcategory(iddashobj1,iddashobj2){
    let dash1 = document.getElementById(iddashobj1);
    let dash2 = document.getElementById(iddashobj2)
    estado=dash1.classList.contains('dash_hide');

    if(estado==true){
        dash1.classList.remove('dash_hide');
        dash2.classList.add('dash_hide');
    }
    else{
        dash1.classList.add('dash_hide');
        dash2.classList.remove('dash_hide');

    }

}

function hide(clase){
  var elemento = document.getElementById(clase);
  elemento.style.visibility = 'hidden';
}

function swal_saveedition(){
    swal.fire({  
        title: 'Guardado',
        text: 'Edición exitosa',
        icon: 'success',
        html: '<div class="textloco">Edición exitosa'+
        '</div>',
    });
}

function swal_warning(Alerta){
    swal.fire({
        title: 'Alerta',
        text: Alerta,
        icon: 'warning',
        
    });
}

function swal_savecreation(){
    swal.fire({  
        title: 'Guardado',
        text: 'Creación exitosa',
        icon: 'success',
        html: '<div class="textloco">Creacion exitosa'+
        '</div>',
    });
}

function updateservdeptime(dia){
    Swal.fire({
        title: 'Actualizado',
        text: 'Se ha actualizado el día '+dia,
        icon: 'success',
    });
}

function updateservdepall(){
    Swal.fire({
        title: 'Actualizado',
        text: 'Se han actualizado todos los días',
        icon: 'info',
    });
}

function swal_eliminacion(){
    Swal.fire({
        title: 'Eliminado',
        text: 'Eliminacion exitosa',
        icon: 'warning',
    });
}

function swal_warning(msg){
    Swal.fire({
        title: 'Alerta',
        icon: 'warning',
        text: msg,
    });
}

function swal_setAll(title,msg,type){
    Swal.fire({
        title: title,
        text: msg,
        icon: type,
    });
}