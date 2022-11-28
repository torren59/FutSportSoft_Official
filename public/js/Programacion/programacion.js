function changeState(progId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/programacion/cambiarEstado',
        dataType: 'json',
        data: {
            'progId': JSON.stringify(progId),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}