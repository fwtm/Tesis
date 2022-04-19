<?php

class Application_Model_DbTable_Nominal extends Zend_Db_Table_Abstract
{

    protected $_name = 'nominal';

    public function listar_nominal()
    {
        return $this->fetchAll();
    }

    public function agregar_nominal($idNominal, $grupoOcupacional, $gradoOcupacional, $remuneracionMensual, $estaActivo)
    {
        $nominal = array('grupo_ocupacional' => $grupoOcupacional, 'grado_ocupacional' => $gradoOcupacional, 'remuneracion_mensual' => $remuneracionMensual,
             'esta_activo' => $estaActivo);
        //$this->insert inserta nueva discapacidad
        $this->insert($nominal);
    }

    public function mostrar_sueldo($idNominal)
    {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        return $db->fetchAll("SELECT grado_ocupacional, remuneracion_mensual FROM nominal WHERE id_nominal= ".$idNominal);
    }
    
}

