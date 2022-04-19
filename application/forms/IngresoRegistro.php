<?php

class Application_Form_IngresoRegistro extends Zend_Form
{

    public function init()
    {
         $this->setName('upload');
        $this->setAttrib('enctype', 'multipart/form-data');
        $fichero = new Zend_Form_Element_File('fichero');
        $fichero->setLabel('Ubicacion del Archivo')
                 ->setRequired(true)
                 ->addValidator('Extension',false,'txt')
                 ->addValidator('Size',false,'10024000');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Ingresar');
        $this->addElements(array($fichero, $submit));
    }


}

