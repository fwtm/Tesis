<?php

class FuncionController extends Zend_Controller_Action
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

    public function ingresarFuncionAction()
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

//        /Recupero de las variables de session los datos principales del paciente//
              $defaultNamespace = new Zend_Session_Namespace('Default');
              //Envio los datos del paciente a la vista
              $this->view->cedula = $defaultNamespace->cedula_identidad;
              $this->view->nombre = $defaultNamespace->nombre_empleado;

              $puesto = new Application_Model_DbTable_PuestoInstitucional();
              $this->view->puestos = $puesto->listar_puesto();

              $especialidad = new Application_Model_DbTable_Especialidad();
              $this->view->especialidades = $especialidad->listar_especialidad();

              $table_p = new Application_Model_DbTable_Funcion();
              $new_id = $table_p->consultar_ultimo_id();
              $this->view->id_funcion = ((int)$new_id->ultm_id) + 1;

        if($this->getRequest()->getPost())
        {
            $idFuncion = $this->getRequest()->getParam('id_funcion');
            $cedulaIdentidad = $defaultNamespace->cedula_identidad;
            $cargo = $this->getRequest()->getParam('cargo');
            $idPuesto = $this->getRequest()->getParam('id_puesto');
            $idEspecialidad = $this->getRequest()->getParam('id_especialidad');
            $departamento = $this->getRequest()->getParam('departamento');
            $oficinaConsultorio = $this->getRequest()->getParam('oficina_consultorio');

            $funciones = new Application_Model_DbTable_Funcion();
            $funciones->ingresar_funcion($idFuncion, $cedulaIdentidad, $cargo, $idPuesto, $idEspecialidad, $departamento, $oficinaConsultorio);
        }

            $table = new Application_Model_DbTable_Funcion();
            $cedulaIdentidad = $defaultNamespace->cedula_identidad;
            $this->view->funciones = $table->listar_funciones_cedula($cedulaIdentidad);
    }


}



