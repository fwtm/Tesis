<?php

class Application_Model_DbTable_Especialidad extends Zend_Db_Table_Abstract
{

    protected $_name = 'especialidad';

    public function listar_especialidad()
    {
        return $this->fetchAll();
    }
}

