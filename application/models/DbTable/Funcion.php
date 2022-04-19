<?php

class Application_Model_DbTable_Funcion extends Zend_Db_Table_Abstract
{

    protected $_name = 'funcion';

    public function listar_funcion()
    {
         return $this->fetchAll();
    }

    public function consultar_ultimo_id()
     {
          $select= $this->select();
          $select->from('funcion',array('ultm_id' => 'max(id_funcion)'));
          return $this->fetchRow($select);
     }

    public function ingresar_funcion($idFuncion, $cedulaIdentidad, $cargo, $idPuesto, $idEspecialidad, $departamento, $oficinaConsultorio)
    {
        $funcion  = array('id_funcion' =>  $idFuncion, 'cedula_identidad' => $cedulaIdentidad, 'cargo' => $cargo, 'id_puesto' => $idPuesto,
                   'id_especialidad' => $idEspecialidad, 'departamento' => $departamento, 'oficina_consultorio' => $oficinaConsultorio);
        $this->insert($funcion);
    }

    public function extraer_funcion($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT cargo, puesto_institucional, tipo_especialidad, departamento, oficina_consultorio
            FROM funcion
            JOIN puesto_institucional ON puesto_institucional.id_puesto = funcion.id_puesto
            JOIN especialidad ON especialidad.id_especialidad = funcion.id_especialidad
            WHERE funcion.cedula_identidad =" .$cedula_identidad;

         try {
           $row = $db->fetchRow($select);
             }
            catch (Zend_Exception $e)
         {
           echo "Db error : " . $e->getMessage() . "\n";
         }
         return $row;
    }

    public function listar_funciones_cedula($cedulaIdentidad)
     {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        $select = "SELECT fn.id_funcion, fn.cedula_identidad, fn.cargo, pi.puesto_institucional, te.tipo_especialidad,
                    departamento, oficina_consultorio
                    FROM funcion AS fn
                    INNER JOIN puesto_institucional AS pi ON (fn.id_puesto = pi.id_puesto)
                    INNER JOIN especialidad AS te ON (fn.id_especialidad = te.id_especialidad)
                    WHERE cedula_identidad = ".$cedulaIdentidad;
        return $db->fetchAll($select);
     }

}

