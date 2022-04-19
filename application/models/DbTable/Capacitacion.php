<?php

class Application_Model_DbTable_Capacitacion extends Zend_Db_Table_Abstract
{

    protected $_name = 'capacitacion';

    public function agregar_capacitacion($idCapacitacion, $cedulaIdentidad, $nombreEvento, $institucionCapacitacion, $fechaCapacitacion,
             $totalHoras, $lugar, $verificarCapacitacion)
    {
        $capacitacion = array('cedula_identidad' => $cedulaIdentidad, 'nombre_evento' => $nombreEvento, 'institucion_capacitacion' => $institucionCapacitacion,
            'fecha_capacitacion' => $fechaCapacitacion, 'total_horas' => $totalHoras, 'lugar' => $lugar, 'verificar_capacitacion' => $verificarCapacitacion);

        $this->insert($capacitacion);
    }

     public function listar_capacitacion_cedula($cedulaIdentidad)
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $listar_capacitacion = "SELECT id_capacitacion, cedula_identidad, nombre_evento, institucion_capacitacion,
                             fecha_capacitacion, total_horas, lugar, verificar_capacitacion
                             FROM capacitacion
                             WHERE cedula_identidad =".$cedulaIdentidad;
        return $db->fetchAll($listar_capacitacion);
    }

    public function extraer_capacitacion($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT nombre_evento, institucion_capacitacion, fecha_capacitacion,
             total_horas, lugar, verificar_capacitacion
             FROM capacitacion
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

