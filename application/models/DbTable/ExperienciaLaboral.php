<?php

class Application_Model_DbTable_ExperienciaLaboral extends Zend_Db_Table_Abstract
{

    protected $_name = 'experiencia_laboral';

    public function listar_experiencia()
    {
        return $this->fetchAll();
    }

    public function agregar_experiencia($idExperienciaLaboral, $cedulaIdentidad, $institucionEmpresa, $puestoCargo,
            $fechaEntrada, $fechaSalida, $ciudad, $verificarExperiencia)
    {
        $experiencia = array('cedula_identidad' => $cedulaIdentidad, 'institucion_empresa' => $institucionEmpresa,
                            'puesto_cargo' => $puestoCargo, 'fecha_entrada' => $fechaEntrada,
                            'fecha_salida' => $fechaSalida, 'id_canton' => $ciudad, 'verificar_experiencia' => $verificarExperiencia);

        $this->insert($experiencia);
    }

    public function listar_experiencia_cedula($cedulaIdentidad)
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $listar_experiencia = "SELECT id_experiencia_laboral, cedula_identidad, institucion_empresa,
                                 puesto_cargo, fecha_entrada, fecha_salida, id_canton, verificar_experiencia
                                 FROM experiencia_laboral
                                 WHERE cedula_identidad = ".$cedulaIdentidad;
        return $db->fetchAll($listar_experiencia);
    }

    public function extraer_experiencia($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT institucion_empresa, puesto_cargo, fecha_entrada, fecha_salida,
             id_canton, verificar_experiencia
             FROM experiencia_laboral
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

