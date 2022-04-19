<?php

class ProvinciaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->initView();
        $this->view->baseUrl = $this->_request->getBaseUrl();
        //librerias
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jquery/jquery-1.5.1.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/HabilitarFormulario.js'));
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

    public function ingresarProvinciaAction()
    {
        $table = new Application_Model_DbTable_Pais();
        $this->view->pais = $table->listar_pais();

        if($this->getRequest()->getPost())
        {
            $idPais = $this->getRequest()->getParam('id_pais');
            $nombreProvincia = $this->getRequest()->getParam('nombre_provincia');

            $table = new Application_Model_DbTable_Provincia();
            $table->agregar_provincia('', $idPais, $nombreProvincia);

            
        }
        $provincias = new Application_Model_DbTable_Provincia();
        $this->view->provincias = $provincias->listar_provincias();        
    }


}



