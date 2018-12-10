
function horario(){ 
    var tempo = new Date();
    var hr = tempo.getHours();
    var min = tempo.getMinutes();
    var seg = tempo.getSeconds();

    if(hr < 10){ hr = '0'+hr; }
    if(min < 10){ min = '0'+min; }
    if(seg < 10){ seg = '0'+seg; }
  
    document.getElementById("horario").innerHTML=hr+":"+min+":"+seg;   
        
}
    
window.setInterval("horario()",1000);


$(document).ready(function(){

	$("#img").on("click",function(){
		$("#img").toggleClass("img-perfil");
		$("#img").toggleClass("img-menu");
		$(".menu").toggle();
	});
});
