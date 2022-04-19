<?php

class DocenciaUniversitariaController extends Zend_Controller_Action
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

    public function ingresarDocenciaAction()
    {
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jquery/jquery-1.5.1.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validation/js/jquery.validationEngine-es.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/validation/js/jquery.validationEngine.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/HabilitarFormulario.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqtable/js/jquery.dataTables.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqtable/js/jquery.dataTables.min.js'));

        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/validationEngine.jquery.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/template.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/botones.css'));

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
            $institucionDocencia = $this->getRequest()->getParam('institucion_docencia');
            $tipoContrato = $this->getRequest()->getParam('tipo_contrato');
            $catedra = $this->getRequest()->getParam('catedra');
            $horasSemana = $this->getRequest()->getParam('horas_semana');
            $estaActivo = $this->getRequest()->getParam('esta_activo');

            $docencia = new Application_Model_DbTable_DocenciaUniversitaria();
            $docencia->agregar_docencia('', $cedulaIdentidad, $institucionDocencia,
                    $tipoContrato, $catedra, $horasSemana, $estaActivo);            
        }
        $table = new Application_Model_DbTable_DocenciaUniversitaria();
        $cedulaIdentidad = $defaultNamespace->cedula_identidad;
        $this->view->docencia = $table->listar_docencia_cedula($cedulaIdentidad);
    }


}



