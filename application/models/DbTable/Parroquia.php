<?php

class Application_Model_DbTable_Parroquia extends Zend_Db_Table_Abstract
{

    protected $_name = 'parroquia';

    public function listar_parroquia()
    {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        $select = "SELECT pq.id_parroquia, pr.nombre_provincia, ca.nombre_canton, pq.nombre_parroquia, pq.tipo_parroquia
                  FROM parroquia AS pq, canton AS ca
                  INNER JOIN provincia AS pr ON (pr.id_provincia = ca.id_provincia)
                  WHERE pq.id_canton = ca.id_canton
                  GROUP BY pq.id_parroquia, pr.nombre_provincia, ca.nombre_canton, pq.nombre_parroquia, pq.tipo_parroquia";
        return $db->fetchAll($select);
    }

    public function listar_parroquias($idCanton)
    {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        return $db->fetchAll("SELECT id_parroquia, nombre_parroquia FROM parroquia WHERE id_canton= ".$idCanton);
    }

    public function agregar_parroquia($idParroquia, $idCanton, $nombreParroquia, $tipoParroquia)
    {
        $parroquia = array('id_canton' => $idCanton, 'nombre_parroquia' => $nombreParroquia, 'tipo_parroquia' => $tipoParroquia);

        $this->insert($parroquia);
    }
}

