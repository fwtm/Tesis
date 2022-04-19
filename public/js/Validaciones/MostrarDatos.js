//funcion para cargar en el grid
function cargarReporte(page)
{

     var consul = $("#consulta").val(); //Usando JQUERY, obtengo el value de la consulta a enviarse.
     $.ajax(
       {
            dataType: "html",
            type: "POST",
            url: "/talento_humano/public/Reportes/busqueda-ajax", // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
            data: "consulta=" + consul +"&page="+page, // Asigno el parametro de consulta que se va a enviar
            beforeSend: function(data){

                },
            success: function(requestData){ 	//Llamada exitosa
              $("#tabla").html(requestData);//Usando JQUERY, cargamos los datos del paciente o pacientes encontrados
              },
             timeout: 5000,
                        error: function(xhr,err) {
                        alert("HA OCURRIDO UN ERROR\nreadyState: "+xhr.readyState+"\nstatus:"+xhr.status);
                        alert("responseText: "+xhr.responseText);
                         //En caso de error mostraremos un alert
               },
            complete: function(requestData, exito){ //fin de la llamada ajax.

               }
        });
}

 function consultar(e)
 {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13) cargarReporte();
 }

//Solo si agregaste el jQuery.noConflict();
(function($) {
$(function() {
// El codigo de la funcion cargarRegionesPais()
});
})(jQuery);
