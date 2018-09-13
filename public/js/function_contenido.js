$(document).on('click','.ajax-request',function(event){
  event.preventDefault();

  var ruta= $(this).attr("href");

  $("#contenido").load(ruta, function(responseTxt, statusTxt, xhr){
      if(statusTxt == "error"){
        alert("Algo anda mal en la ruta: " + ruta);
      }
  });
});