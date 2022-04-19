<?php

class DomicilioEmpleadoController extends Zend_Controller_Action
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

    public function ingresarDomicilioAction()
    {
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jquery/jquery-1.5.1.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validation/js/jquery.validationEngine-es.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/validation/js/jquery.validationEngine.js'));   
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/validationEngine.jquery.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/template.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/botones.css'));

        //Recupero de las variables de session los datos principales del paciente//
              $defaultNamespace = new Zend_Session_Namespace('Default');
              //Envio los datos del paciente a la vista
              $this->view->cedula = $defaultNamespace->cedula_identidad;
              $this->view->nombre = $defaultNamespace->nombre_empleado;
              $this->view->codigo = $defaultNamespace->codigo_personal;

              $table_p = new Application_Model_DbTable_DireccionDomicilio();
              $new_id = $table_p->consultar_ultimo_id();
              $this->view->id_domicilio = ((int)$new_id->ultm_id) + 1;

         if ($this->getRequest()->isPost())
         {
             $cedulaIdentidad = $defaultNamespace->cedula_identidad;;
             $avenidaDireccion = $this->getRequest()->getParam('avenida_direccion');
             $calleDireccion = $this->getRequest()->getParam('calle_direccion');
             $manzanaDomicilio = $this->getRequest()->getParam('manzana_domicilio');
             $lugarReferencia = $this->getRequest()->getParam('lugar_referencia');
             $contactoReferencia = $this->getRequest()->getParam('contacto_referencia');
             $telefonoContacto = $this->getRequest()->getParam('telefono_contacto');

             $direccion = new Application_Model_DbTable_DireccionDomicilio();
             $direccion->ingresar_domicilio('', $cedulaIdentidad, $avenidaDireccion, $calleDireccion,
                     $manzanaDomicilio, $lugarReferencia, $contactoReferencia, $telefonoContacto);

             $this->_helper->redirector('ingresar-funcion','Funcion');
         }

    }

    public function visualizarDomicilioAction()
    {
       $defaultNamespace = new Zend_Session_Namespace('Default');
        $cedulaIdentidad= $defaultNamespace->cedula_identidad;

        $personal =  new Application_Model_DbTable_DireccionDomicilio();
        $datos = $personal->extraer_domicilio($cedulaIdentidad);

         if(!$datos){

             $this->view->mensajeError ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->avenida_direccion = $datos->avenida_direccion;
                 $this->view->calle_direccion = $datos->calle_direccion;
                 $this->view->manzana_domicilio = $datos->manzana_domicilio;
                 $this->view->lugar_referencia = $datos->lugar_referencia;
                 $this->view->contacto_referencia = $datos->contacto_referencia;
                 $this->view->telefono_contacto = $datos->telefono_contacto;
             }
    }

    


}





