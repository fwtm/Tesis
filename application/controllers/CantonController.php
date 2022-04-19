<?php

class CantonController extends Zend_Controller_Action
{

    public function init()
    {
         /* Initialize action controller here */
        $this->initView();
        $this->view->baseUrl = $this->_request->getBaseUrl();
        //librerias
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
    }

    public function indexAction()
    {
        // action body
    }

    public function ingresarCantonAction()
    {
         $table = new Application_Model_DbTable_Provincia();
        $this->view->provincia = $table->listar_provincias();


         if ($this->getRequest()->isPost())
        {
                $provincia = $this->getRequest()->getParam('id_provincia');
                $nombreCanton = $this->getRequest()->getParam('nombre_canton');


                $canton = new Application_Model_DbTable_Canton();
                $canton->agregar_canton('', $provincia, $nombreCanton);
        }

        $cantones = new Application_Model_DbTable_Canton();
        $this->view->canton = $cantones->listar_canton();
    }


}



