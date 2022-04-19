<?php

class Application_Model_DbTable_DocenciaUniversitaria extends Zend_Db_Table_Abstract
{

    protected $_name = 'docencia_universitaria';

    public function agregar_docencia($idDocencia, $cedulaIdentidad, $institucionDocencia, $tipoContrato, $catedra,
             $horasSemana, $estaActivo)
    {
        $docencia = array('cedula_identidad' => $cedulaIdentidad, 'institucion_docencia' => $institucionDocencia, 'tipo_contrato' => $tipoContrato,
            'catedra' => $catedra, 'horas_semana' => $horasSemana, 'esta_activo' => $estaActivo);

        $this->insert($docencia);
    }

    public function listar_docencia_cedula($cedulaIdentidad)
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $listar_docencia = "SELECT id_docencia, cedula_identidad, institucion_docencia, tipo_contrato,
                             catedra, horas_semana, esta_activo
                             FROM docencia_universitaria
                             WHERE cedula_identidad =".$cedulaIdentidad;
        return $db->fetchAll($listar_docencia);
    }

    public function extraer_docencia($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT institucion_docencia, tipo_contrato, catedra, horas_semana
                             FROM docencia_universitaria
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

