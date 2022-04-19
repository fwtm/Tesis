<?php

class RegistroIngresoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->initView();
        $this->view->baseUrl = $this->_request->getBaseUrl();
    }

    public function indexAction()
    {
        $form = new Application_Form_IngresoRegistro();
        $this->view->assign('form', $form);
        if ( $this->getRequest()->isPost() ) {
            $fichero = $form->fichero;
            if( $form->isValid($this->getRequest()->getParams()) )
              { //Si se envían los datos, los recuperamos del formulario
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)){ //Validamos que los datos recibidos sean correctos
                //Asignamos los valores recuperados a variables
                    $archivo = $form->getValue('fichero');
                    $location =  $fichero->getFileName('fichero');
                    echo $archivo; ///imprimo la locacion
                    echo $location;
                    $table = new Application_Model_DbTable_RegistroIngreso();
                    $verdad = $table->ingresar_registros($archivo);
                                if($verdad)
                                    {
                                      $this->_helper->redirector('index', 'index');
                                    }
                                    else
                                    echo "Error en Archivo";
                             }
                        }
                       $this->view->form = $form;
                    }
              }
}