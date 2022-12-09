function changeState2(GrupoId){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/grupos/cambiarEstado',
        dataType: 'json',
        data: {
            'GrupoId': JSON.stringify(GrupoId),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}
