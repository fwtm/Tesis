//funcion que carga las regiones de un pais realizando una llamada ajax
function cargarCantones(obj)
     {
            var idProvincia = $("#id_provincia").val(); //Usando JQUERY, obtengo el value del option seleccionado de la lista paises.
            $.ajax(
            {
                dataType: "html",
                type: "POST",
                url: "/talento_humano/public/DatosPersonales/listar-Canton", // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
                data: "id_provincia=" + idProvincia, //El id del pais seleccionado en la lista paises (si enviarás mas de un parametro los separas con &.
                beforeSend: function(data){
                //$("#id_canton").html('<option>Cargando...</option>');//Usando JQUERY, Mostramos el mensaje cargando en la lista regiones. (un efecto visual)
                //También puedes poner aqui el gif que indica cargando...
                },
                success: function(requestData){ 	//Llamada exitosa
                $("#id_canton").html(requestData);//Usando JQUERY, Cargamos las regiones del pais
                },
                 timeout: 5000,
                            error: function(xhr,err) {
                            alert("HA OCURRIDO UN ERROR\nreadyState: "+xhr.readyState+"\nstatus:"+xhr.status);
                            alert("responseText: "+xhr.responseText);
                             //En caso de error mostraremos un alert
                },
                complete: function(requestData, exito){ //fin de la llamada ajax.
//                cargarUnidades(0);// En caso de usar una gif (cargando...) aqui quitas la imagen
                }
                });
      }

     function cargarParroquias(obj)
     {
            var idCanton = $("#id_canton").val(); //Usando JQUERY, obtengo el value del option seleccionado de la lista paises.
            $.ajax(
            {
                dataType: "html",
                type: "POST",
                url: "/talento_humano/public/DatosPersonales/listar-Parroquia", // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
                data: "id_canton=" + idCanton, //El id del pais seleccionado en la lista paises (si enviarás mas de un parametro los separas con &.
                beforeSend: function(data){
                //$("#id_parroquia").html('<option>Cargando...</option>');//Usando JQUERY, Mostramos el mensaje cargando en la lista regiones. (un efecto visual)
                //También puedes poner aqui el gif que indica cargando...
                },
                success: function(requestData){ 	//Llamada exitosa
                $("#id_parroquia").html(requestData);//Usando JQUERY, Cargamos las regiones del pais
                },
                 timeout: 5000,
                            error: function(xhr,err) {
                            alert("HA OCURRIDO UN ERROR\nreadyState: "+xhr.readyState+"\nstatus:"+xhr.status);
                            alert("responseText: "+xhr.responseText);
                             //En caso de error mostraremos un alert
                },
                complete: function(requestData, exito){ //fin de la llamada ajax.
//                cargarUnidades(0);// En caso de usar una gif (cargando...) aqui quitas la imagen
                }
                });
      }

    function cargarUnidades(obj)
    {
            var idParroquia = $("#id_parroquia").val(); //Usando JQUERY, obtengo el value del option seleccionado de la lista paises.
            $.ajax(
            {
                dataType: "html",
                type: "POST",
                url: "/talento_humano/public/DatosPersonales/listar-Unidad", // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
                data: "id_parroquia=" + idParroquia, //El id del pais seleccionado en la lista paises (si enviarás mas de un parametro los separas con &.
                beforeSend: function(data){
//                $("#unidad").html('<option>Cargando...</option>');//Usando JQUERY, Mostramos el mensaje cargando en la lista regiones. (un efecto visual)
                //También puedes poner aqui el gif que indica cargando...
                },
                success: function(requestData){ 	//Llamada exitosa
                $("#id_unidad").html(requestData);//Usando JQUERY, Cargamos las regiones del pais
                },
                 timeout: 5000,
                            error: function(xhr,err) {
                            alert("HA OCURRIDO UN ERROR\nreadyState: "+xhr.readyState+"\nstatus:"+xhr.status);
                            alert("responseText: "+xhr.responseText);
                             //En caso de error mostraremos un alert
                },
                complete: function(requestData, exito){ //fin de la llamada ajax.
    //            cargarParroquias(0);// En caso de usar una gif (cargando...) aqui quitas la imagen
                }
                });
     }   

    
//Solo si agregaste el jQuery.noConflict();
(function($) {
$(function() {
// El codigo de la funcion cargarRegionesPais()
});
})(jQuery);