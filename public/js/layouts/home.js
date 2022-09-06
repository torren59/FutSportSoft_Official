function sidevar(){
    let sidebar = document.getElementById("sidevar");
    let content = document.getElementById("content-site-block");
    let estado = sidebar.classList.contains("sidevaron");

    if(estado==true){
        sidebar.classList.replace("sidevaron","sidevaroff");
        content.classList.replace("contentsiteblockon","contentsiteblockoff");
    }
    else{
        sidebar.classList.replace("sidevaroff","sidevaron");
        content.classList.replace("contentsiteblockoff","contentsiteblockon");
    }
}

function items(texto){

    let text = document.getElementById(texto);
    let estado = text.classList.contains("main-sidevar-item-links-on");

    if(estado==true){
        text.classList.replace("main-sidevar-item-links-on","main-sidevar-item-links-off");
    }
    else{
        text.classList.replace("main-sidevar-item-links-off","main-sidevar-item-links-on");
    }

}
