function getArray() {

    $.ajax({
        type: 'get',
        url: '/venta/getArray/',
        dataType: 'json',
        data: { 'numero': JSON.stringify(1) },

        success: function (data) {
            numero = Object.entries(data);
            console.log(numero);
        },

        error: function (data) {
            alert('Error ' + data);
        }

    });
}