<?php

class Application_Model_DbTable_Provincia extends Zend_Db_Table_Abstract
{

    protected $_name = 'provincia';

    public function listar_provincias()
    {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        $select = "SELECT pr.id_provincia, ps.nombre_pais, pr.nombre_provincia
                  FROM provincia AS pr
                  INNER JOIN pais AS ps ON (pr.id_pais = ps.id_pais)";
        return $db->fetchAll($select);
    }

    public function agregar_provincia($idProvincia, $idPais, $nombreProvincia)
    {
        $provincia = array('id_pais' => $idPais, 'nombre_provincia' => $nombreProvincia);

        $this->insert($provincia);
    }

    public function listar_provincia_pais($idPais)
    {
        //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        $select = "SELECT id_provincia, id_pais, nombre_provincia
                   FROM provincia
                   WHERE id_pais =".$idPais;
        return $db->fetchAll($select);
    }

}

