function changeState(Nit){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/proveedor/cambiarEstado',
        dataType: 'json',
        data: {
            'Nit': JSON.stringify(Nit),
        },
        success: function (data) {
        },
        error: function (error) {
            alert(error);
        }
    });
}
