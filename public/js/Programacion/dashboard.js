$('#A').on('load',setFirstInterval());
// $('#queryButton').on('click',setNewInterval());

function setFirstInterval(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/dashboard/getInitialIntervals',
        dataType: 'json',
        data: {
            'Estado': JSON.stringify(true),
            
        },
        success: function (data) {
            console.log(data);
            showDash(data);
        },
        error: function (error) {
            alert(error);
        }
    });
}

function setNewInterval(){
    let inferiorMonth = $('#inferiorMonth').val();
    console.log(inferiorMonth);
    let inferiorYear = $('#inferiorYear').val();
    console.log(inferiorYear);
    let superiorMonth = $('#superiorMonth').val();
    console.log(superiorMonth);
    let superiorYear = $('#superiorYear').val();
    console.log(superiorYear);


    if(inferiorYear > superiorYear){
        let Message = 'Seleccione una fecha final superior a la fecha inicial';
        $('#ConfirmationError').html(Message);        
        return;
    }
    else if(inferiorYear == superiorYear &&  parseInt(inferiorMonth) > parseInt(superiorMonth)){
        console.log('Organice los meses');
        console.log(inferiorMonth+' '+superiorMonth);
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    $.ajax({
        type: 'post',
        url: '/dashboard/getNewIntervals',
        dataType: 'json',
        data: {
            'inferiorMonth': JSON.stringify(inferiorMonth),
            'inferiorYear': JSON.stringify(inferiorYear),
            'superiorMonth': JSON.stringify(superiorMonth),
            'superiorYear': JSON.stringify(superiorYear),
        },
        success: function (data) {
            window.ctx.destroy();
            console.log('Aqui'); 
            console.log(data);
            showDash(data);
        },
        error: function (error) {
            alert(error);
        }
    });
}


function showDash(data){

    window.ctx = new Chart(document.getElementById('myChart'), {
      type: 'bar',
      data: {
        labels: data['meses'],
        datasets: [{
          label: 'Deportistas inscritos',
          data: data['inscritos'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
}