<?php

class Application_Model_DbTable_Canton extends Zend_Db_Table_Abstract
{

    protected $_name = 'canton';

    public function listar_canton()
    {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        $select = "SELECT ca.id_canton, pr.nombre_provincia, ca.nombre_canton
                   FROM canton AS ca
                   INNER JOIN provincia AS pr ON (ca.id_provincia = pr.id_provincia)";
        return $db->fetchAll($select);
    }

    public function listar_cantones($idProvincia)
     {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        return $db->fetchAll("SELECT id_canton, nombre_canton FROM canton WHERE id_provincia= ".$idProvincia);
     }

    public function agregar_canton($idCanton, $idProvincia, $nombreCanton )
    {
        $canton = array('id_provincia' => $idProvincia, 'nombre_canton' => $nombreCanton);
        //$this->insert() inserta nuevo canton
        $this->insert($canton);
    }

}

