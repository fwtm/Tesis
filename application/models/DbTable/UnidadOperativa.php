<?php

class Application_Model_DbTable_UnidadOperativa extends Zend_Db_Table_Abstract
{

    protected $_name = 'unidad_operativa';

    public function listar_unidad()
    {
        return $this->fetchAll();
    }

    public function lista_unidad($idParroquia)
    {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        return $db->fetchAll("SELECT id_unidad, nombre_unidad FROM unidad_operativa WHERE id_parroquia= ".$idParroquia);
    }

    public function agregar_unidad($idUnidad, $idProvincia, $idCanton, $idParroquia, $nombreUnidad, $numeroArea, $direccionUnidad, $telefonoUnidad)
    {
        $unidadOperativa = array('id_provincia' => $idProvincia, 'id_canton' => $idCanton, 'id_parroquia' => $idParroquia, 'nombre_unidad' => $nombreUnidad,
                                 'numero_area' => $numeroArea, 'direccion_unidad' => $direccionUnidad, 'telefono_unidad' => $telefonoUnidad);
        //this->insert inserta nueva Unidad Operativa
        $this->insert($unidadOperativa);
    }

    public function detalles_unidad($idUnidad)
    {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        return $db->fetchAll("SELECT numero_area, direccion_unidad, telefono_unidad FROM unidad_operativa WHERE id_unidad =".$idUnidad);
    }

}

