<?php

class Application_Model_DbTable_PuestoInstitucional extends Zend_Db_Table_Abstract
{

    protected $_name = 'puesto_institucional';

    public function listar_puesto()
    {
        return $this->fetchAll();
    }
}

