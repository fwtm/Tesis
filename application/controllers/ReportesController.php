<?php

class ReportesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->initView();
        $this->view->baseUrl = $this->_request->getBaseUrl();
        //librerias
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/MostrarDatos.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jquery/jquery-1.5.1.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validation/js/jquery.validationEngine-es.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/validation/js/jquery.validationEngine.js'));       
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqtable/js/jquery.dataTables.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqtable/js/jquery.dataTables.min.js'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/validationEngine.jquery.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/template.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/botones.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_page.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_table.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/format_table.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_table_jui.css'));

    }

    public function indexAction()
    {
        // action body
    }

    public function buscarPersonaAction()
    {
        // Añado las archivos css y javascript necesarios para el funcionamiento de la vista
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/MostrarDatos.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jquery/jquery-1.5.1.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validation/js/jquery.validationEngine-es.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/validation/js/jquery.validationEngine.js'));     
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqtable/js/jquery.dataTables.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqtable/js/jquery.dataTables.min.js'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/validationEngine.jquery.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/template.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/botones.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_page.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_table.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/format_table.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_table_jui.css'));

             //los formularios envian sus datos a traves de POST
             //si vienen datos de post, es que el usuario ha enviado el formulario
                 if ($this->getRequest()->isPost())
                 {
                   //extrae un arreglo con los datos recibidos por POST
//                   //es decir, los datos clave=>valor del formulario
//                   $formData = $this->getRequest()->getPost();
//                   echo $formData;
//
//                   //Se extrae el valor de la historia clínica enviada y se almacenan en variables
//                   // de sesion para realizar las transacciones que el paciente requiera
//
//                   $consulta = $this->getRequest()->getParam('instancia');
//
//                   $defaultNamespace = new Zend_Session_Namespace('Default'); //creo una variable del namespace por  defecto
//                   $defaultNamespace->historia_p = $consulta;
                 }
                 
    }

    public function busquedaAjaxAction()
    {
        // action body
         $this->_helper->viewRenderer->setNoRender(); //No necesitamos el render de la vista en una llamada ajax.
         $this->_helper->layout->disableLayout(); // Solo si estas usando Zend_Layout
          if ($this->getRequest()->isXmlHttpRequest())//Detectamos si es una llamada AJAX
              {
                 //Configuracion de datos para paginación de la consulta
                 // obtenemos la página actual
                 $page = $this->_request->getParam('page', 1);
                 // número de registros a mostrar por página
                 $registros_pagina = 7;
                 // número máximo de páginas a mostrar en el paginador
                 $rango_paginas = 10;

                 // Creo un objeto de la tabla paciente y llamo al método buscar_paciente
                 // enviandole como parametro  el texto ingresado en el input text "consulta2 de la vista
                 $table = new Application_Model_DbTable_RegistroIngreso();
                 $cedulaIdentidad = $this->_request->getPost('consulta');
                 $datospacientes = $table->listar_horas_por_cedula($cedulaIdentidad);
                 $Listapacientes='';

                 if(!$datospacientes){

                        $Listapacientes.="<br /><br />
                                             <p class='labelrotulo'> No se han encontrado registros del Empleado</p>
                                           <br /><br />";

                   }else{
                    ///Creo el paginador para la consulta y le asigno las configuraciones
                    $paginador = Zend_Paginator::factory($datospacientes);
                    $paginador->setItemCountPerPage($registros_pagina)
                              ->setCurrentPageNumber($page)
                              ->setPageRange($rango_paginas);

                    $Listapacientes=''.$this->view->paginationControl($paginador,'Jumping','/reportes/paginador-reportes.phtml');
                    $Listapacientes.= '<center> <table id="tabla_reportes"  class="table" cellpadding="0" cellspacing="0">
                                               <tr>
                                                    <th style="width:150px;">Nombres Empleado </th>
                                                    <th style="width:150px;">Apellidos Empleado </th>
                                                    <th style="width:85px;">Codigo Personal </th>
                                                    <th style="width:90px;">Fecha Registro </th>
                                                    <th style="width:50px;">Hora Registro </th>
                                               </tr>';

                      foreach($paginador as $item):
                         //$pagina= (string)$this->view->url(array('controller' => 'paciente', 'action' => 'mostrarpaciente', 'id' => $item->hc_digital),'',false);
                              $Listapacientes.= " <td style='text-align: center';>".$item->nombre_empleado."</td>
                                                  <td style='text-align: center'>".$item->apellido_empleado."</td>
                                                  <td style='text-align: center';>".$item->codigo_personal."</td>
                                                  <td style='text-align: center';>".$item->fecha_registro."</td>
                                                  <td style='text-align: center';>".$item->hora_registro."</td>
                                                   </tr>";

                       endforeach;
                       $Listapacientes.= "</table></center>";
                    }

                       echo $Listapacientes; //Devolvemos las opciones de la lista pacientes.
              }
              
    }

    public function paginadorReportesAction()
    {
        // action body
    }


}







