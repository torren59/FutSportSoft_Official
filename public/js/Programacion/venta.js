function changeState(VentaId){

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
            'VentaId': JSON.stringify(VentaId),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}