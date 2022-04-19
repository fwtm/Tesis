<?php

class Application_Model_DbTable_Discapacidad extends Zend_Db_Table_Abstract
{

    protected $_name = 'discapacidad';

    public function agregar_discapacidad($idDiscapacidad, $cedulaIdentidad, $tipoDiscapacidad, $porcentajeDiscapacidad, $carnetConadis, $verificarDiscapacidad)
    {
        $discapacidad = array('cedula_identidad' => $cedulaIdentidad, 'tipo_discapacidad' => $tipoDiscapacidad,
                              'porcentaje_discapacidad' => $porcentajeDiscapacidad, 'carnet_conadis' => $carnetConadis,
                              'verificar_discapacidad' => $verificarDiscapacidad);
        //$this->insert inserta nueva discapacidad
        $this->insert($discapacidad);
    }

    public function listar_discapacidad_cedula($cedulaIdentidad)
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $listar_discapacidad = "SELECT id_discapacidad, tipo_discapacidad, porcentaje_discapacidad, carnet_conadis
                                FROM discapacidad
                                WHERE cedula_identidad =".$cedulaIdentidad;
        return $db->fetchAll($listar_discapacidad);
    }

    public function extraer_discapacidad($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT tipo_discapacidad, porcentaje_discapacidad, carnet_conadis
                        FROM discapacidad
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

