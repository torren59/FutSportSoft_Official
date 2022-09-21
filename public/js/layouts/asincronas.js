$('.productcheck').on('change', Avisad);



function Avisad(){
    let checks = $('.lista_productos').find('.productcheck');
    let arr = new Array();
    arr = checks.toArray();
    let Seleccionados = new Array();

    arr.forEach(element => {
        if($(element).prop('checked')){
            Seleccionados.push($(element).val());
        }
    });

   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        type: 'post',
        url: '/venta/listaseleccionados',
        dataType: 'json',
        data: {'seleccionados': JSON.stringify(Seleccionados)},
        success: function(data) {
            console.log(data);
        },
        error: function(data) {
          alert('Error '+data);
        }
    });
}