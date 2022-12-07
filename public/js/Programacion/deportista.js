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