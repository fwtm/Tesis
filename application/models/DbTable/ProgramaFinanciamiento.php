<?php

class Application_Model_DbTable_ProgramaFinanciamiento extends Zend_Db_Table_Abstract
{

    protected $_name = 'programa_financiamiento';

    public function listar_programa()
    {
        return $this->fetchAll();
    }

    public function agregar_programa($idPrograma, $programaFinanciamiento, $siglasPrograma, $estaActivo)
    {
        $financia = array('programa_financiamiento' => $programaFinanciamiento, 'siglas_programa' => $siglasPrograma, 'esta_activo' => $estaActivo);

        $this->insert($financia);
    }

}

