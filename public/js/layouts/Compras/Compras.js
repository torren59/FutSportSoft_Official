function changeState2(NumeroFactura){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/compras/cambiarEstado',
        dataType: 'json',
        data: {
            'NumeroFactura': JSON.stringify(NumeroFactura),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}
