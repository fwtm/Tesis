<?php

class TituloPostgradoController extends Zend_Controller_Action
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

    public function ingresarPostgradoAction()
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

        if($this->_request->getPost())
        {
             $cedulaIdentidad = $defaultNamespace->cedula_identidad;
             $nombrePostgrado = $this->getRequest()->getParam('nombre_postgrado');
             $institucionPostgrado = $this->getRequest()->getParam('institucion_postgrado');
             $tituloObtenido = $this->getRequest()->getParam('titulo_obtenido');
             $registroConesup = $this->getRequest()->getParam('registro_conesup');
             $fechaGraduacion = $this->getRequest()->getParam('fecha_graduacion');
             $verificarPostgrado = $this->getRequest()->getParam('verificar_postgrado');

             $postgrado = new Application_Model_DbTable_TituloPostgrado();
             $postgrado->agregar_postgrado('', $cedulaIdentidad, $nombrePostgrado, $institucionPostgrado,
                               $tituloObtenido, $registroConesup, $fechaGraduacion, $verificarPostgrado);             
        }

        $table = new Application_Model_DbTable_TituloPostgrado();
        $this->view->cedula = $defaultNamespace->cedula_identidad;
        $cedulaIdentidad = $defaultNamespace->cedula_identidad;
        $this->view->postgrado = $table->listar_postgrado_cedula($cedulaIdentidad);
    }


}



