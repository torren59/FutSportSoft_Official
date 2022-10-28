

function openOrderModal(ProductoId){
    
}

function getArray() {

    $.ajax({
        type: 'get',
        url: '/venta/getArray/',
        dataType: 'json',
        data: { 'numero': JSON.stringify(1) },

        success: function (data) {
            numero = Object.entries(data);
            numero.forEach(element => {
                
            });
            console.log(numero);
        },

        error: function (data) {
            alert('Error ' + data);
        }

    });
}