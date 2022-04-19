<?php

class NominalController extends Zend_Controller_Action
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

    public function ingresarNominalAction()
    {
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

        if($this->getRequest()->getPost())
        {
            $grupoOcupacional = $this->getRequest()->getParam('grupo_ocupacional');
            $gradoOcupacional = $this->getRequest()->getParam('grado_ocupacional');
            $remuneracionMensual = $this->getRequest()->getParam('remuneracion_mensual');
            $estaActivo = $this->getRequest()->getParam('esta_activo');

            $nominal = new Application_Model_DbTable_Nominal();
            $nominal->agregar_nominal('', $grupoOcupacional, $gradoOcupacional, $remuneracionMensual, $estaActivo);
        }
        
        $table = new Application_Model_DbTable_Nominal();
        $this->view->nominal = $table->listar_nominal();


    }


}



