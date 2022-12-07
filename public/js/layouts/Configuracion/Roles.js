function changeState2(id){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/roles/cambiarEstado',
        dataType: 'json',
        data: {
            'id': JSON.stringify(id),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}
