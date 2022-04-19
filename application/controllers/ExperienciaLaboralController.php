<?php

class ExperienciaLaboralController extends Zend_Controller_Action
{

    public function init()
    {
        $this->initView();
        $this->view->baseUrl = $this->_request->getBaseUrl();
    }

    public function indexAction()
    {
        // action body
    }

    public function ingresarExperienciaAction()
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

        //Para extraer la Provincia de la Base de Datos
        $provincia = new Application_Model_DbTable_Provincia();
        $this->view->provincia = $provincia->listar_provincias();

        //Recupero de las variables de session los datos principales del paciente//
              $defaultNamespace = new Zend_Session_Namespace('Default');
              //Envio los datos del paciente a la vista
              $this->view->cedula = $defaultNamespace->cedula_identidad;
              $this->view->nombre = $defaultNamespace->nombre_empleado;
              $this->view->codigo = $defaultNamespace->codigo_personal;
              if($this->getRequest()->getPost())
              {
                  $cedulaIdentidad = $defaultNamespace->cedula_identidad;
                  $institucionEmpresa = $this->getRequest()->getParam('institucion_empresa');
                  $puestoCargo = $this->getRequest()->getParam('puesto_cargo');
                  $fechaEntrada = $this->getRequest()->getParam('fecha_entrada');
                  $fechaSalida = $this->getRequest()->getParam('fecha_salida');
                  $ciudad = $this->getRequest()->getParam('id_canton');
                  $verificarExperiencia = $this->getRequest()->getParam('verificar_experiencia');

                  $laboral = new Application_Model_DbTable_ExperienciaLaboral();
                  $laboral->agregar_experiencia('', $cedulaIdentidad, $institucionEmpresa, $puestoCargo,
                                                $fechaEntrada, $fechaSalida, $ciudad, $verificarExperiencia);
              }

              $table = new Application_Model_DbTable_ExperienciaLaboral();
              $cedulaIdentidad = $defaultNamespace->cedula_identidad;
              $this->view->experiencia = $table->listar_experiencia_cedula($cedulaIdentidad);


    }


}



