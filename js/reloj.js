function mueveReloj(){
    momentoActual = new Date();
    hora = momentoActual.getHours();
    minuto = (momentoActual.getMinutes()<10)?"0"+momentoActual.getMinutes():momentoActual.getMinutes();
    segundo = (momentoActual.getSeconds()<10)?"0"+momentoActual.getSeconds():momentoActual.getSeconds();

    horaImprimible = hora + " : " + minuto + " : " + segundo;

    document.getElementById("reloj").innerHTML = horaImprimible;
    
    setTimeout("mueveReloj()",1000);
}