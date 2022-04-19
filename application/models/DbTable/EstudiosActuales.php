<?php

class Application_Model_DbTable_EstudiosActuales extends Zend_Db_Table_Abstract
{

    protected $_name = 'estudio_actual';

     public function ingresar_estudios($idEstudioActual, $cedulaIdentidad, $establecimiento, $tituloObtener, $nivelActual, $estaActivo)
    {
        $estudios = array('cedula_identidad' => $cedulaIdentidad, 'establecimiento' => $establecimiento, 'titulo_obtener' => $tituloObtener,
            'nivel_actual' => $nivelActual, 'esta_activo' => $estaActivo);
        $this->insert($estudios);
    }

    public function listar_estudios_cedula($cedulaIdentidad)
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $listar_estudios = "SELECT id_estudio_actual, cedula_identidad, establecimiento, titulo_obtener,
                              nivel_actual, esta_activo
                              FROM estudio_actual
                              WHERE cedula_identidad =".$cedulaIdentidad;
        return $db->fetchAll($listar_estudios);
    }

    public function extraer_estudios($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT establecimiento, titulo_obtener, nivel_actual
                              FROM estudio_actual
                              WHERE cedula_identidad =" .$cedula_identidad;

         try {
           $row = $db->fetchRow($select);
             }
            catch (Zend_Exception $e)
         {
           echo "Db error : " . $e->getMessage() . "\n";
         }
         return $row;
    }

}

