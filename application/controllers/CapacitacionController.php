<?php

class CapacitacionController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->initView();
        $this->view->baseUrl = $this->_request->getBaseUrl();
    }

    public function indexAction()
    {
        // action body
    }

    public function ingresarCapacitacionAction()
    {
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jquery/jquery-1.5.1.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validation/js/jquery.validationEngine-es.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/validation/js/jquery.validationEngine.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/ListasAnidadas.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/HabilitarFormulario.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqueryui/js/jquery-ui-1.8.11.custom.min.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqueryui/js/jquery.ui.datepicker-es.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqtable/js/jquery.dataTables.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqtable/js/jquery.dataTables.min.js'));

        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/validationEngine.jquery.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/template.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/botones.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqueryui/css/cupertino/jquery-ui-1.8.11.custom.css'));

        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_page.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_table.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/format_table.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqtable/css/demo_table_jui.css'));

        //Recupero de las variables de session los datos principales del paciente//
              $defaultNamespace = new Zend_Session_Namespace('Default');
              //Envio los datos del paciente a la vista
              $this->view->cedula = $defaultNamespace->cedula_identidad;
              $this->view->nombre = $defaultNamespace->nombre_empleado;
              $this->view->codigo = $defaultNamespace->codigo_personal;
              if($this->getRequest()->getPost())
              {
                    $cedulaIdentidad = $defaultNamespace->cedula_identidad;
                    $nombreEvento = $this->getRequest()->getParam('nombre_evento');
                    $institucionCapacitacion = $this->getRequest()->getParam('institucion_capacitacion');
                    $fechaCapacitacion = $this->getRequest()->getParam('fecha_capacitacion');
                    $totalHoras = $this->getRequest()->getParam('total_horas');
                    $lugar = $this->getRequest()->getParam('lugar');
                    $verificarCapacitacion = $this->getRequest()->getParam('verificar_capacitacion');

                    $capacitacion = new Application_Model_DbTable_Capacitacion();
                    $capacitacion->agregar_capacitacion('', $cedulaIdentidad, $nombreEvento, $institucionCapacitacion,
                                                     $fechaCapacitacion, $totalHoras, $lugar, $verificarCapacitacion);
              }

              $table = new Application_Model_DbTable_Capacitacion();
              $cedulaIdentidad = $defaultNamespace->cedula_identidad;
              $this->view->capacitacion = $table->listar_capacitacion_cedula($cedulaIdentidad);
    }


}



