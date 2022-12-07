function changeState(ProductoId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/producto/cambiarEstado',
        dataType: 'json',
        data: {
            'ProductoId': JSON.stringify(ProductoId),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}