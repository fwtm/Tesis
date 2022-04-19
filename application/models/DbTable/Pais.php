<?php

class Application_Model_DbTable_Pais extends Zend_Db_Table_Abstract
{

    protected $_name = 'pais';

    public function ingresar_pais($idPais, $nombrePais)
    {
        $pais = array('nombre_pais' => $nombrePais);
        $this->insert($pais); 
    }

    public function listar_pais()
    {
        return $this->fetchAll();
    }
}

