function cargarSueldo()
{
    var indice =document.datospersonales.id_nominal.selectedIndex;
    var consul = document.datospersonales.id_nominal.options[indice].text;
    cargarNominal(consul);
{

//funcion para cargar en el grid los datos de agenda para cada medico
 function cargarNominal(consulta)
 {
     var consul = consulta;
     $.ajax(
       {
            dataType: "html",
            type: "POST",
            url: "/talento_humano/public/DatosPersonales/mostrar-nominal", // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
            data: "consulta=" + consul, //Se añade el parametro de busqueda ya sea por nombre o por especialidad
            beforeSend: function(data){

                },
            success: function(requestData){ 	//Llamada exitosa
              $("#remuneracion_mensual").val(requestData);//Usando JQUERY, Cargamos los datos de los medicos
              },
              error: function(requestData, strError, strTipoError){
              alert("Error " + strTipoError +': ' + strError ); //En caso de error mostraremos un alert
               }
        });
 }

//Solo si agregaste el jQuery.noConflict();
(function($) {
$(function() {
// El codigo de la funcion cargarRegionesPais()
});
})(jQuery);
