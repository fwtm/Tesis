<?php

class Application_Model_DbTable_TituloUniversitario extends Zend_Db_Table_Abstract
{

    protected $_name = 'titulo_universitario';

    public function agregar_titulo($idTituloUniversidad, $cedulaIdentidad, $tituloUniversitario, $universidadInstitucion, $paisUniversidad,
             $ciudadUniversidad, $registroConesup, $fechaGraduacion, $verificarTitulo)
    {
        $titulos = array('cedula_identidad' => $cedulaIdentidad, 'titulo_universitario' => $tituloUniversitario, 'universidad_institucion' => $universidadInstitucion,
            'pais_universidad' => $paisUniversidad, 'ciudad_universidad' => $ciudadUniversidad, 'registro_conesup' => $registroConesup,
            'fecha_graduacion' => $fechaGraduacion, 'verificar_titulo' => $verificarTitulo );
        //$this->insert inserta nueva discapacidad
        $this->insert($titulos);
    }

    public function listar_titulo_cedula($cedulaIdentidad)
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $listar_titulo = "SELECT id_universitario, cedula_identidad, titulo_universitario, universidad_institucion,
                                 pais_universidad, ciudad_universidad, registro_conesup, fecha_graduacion, verificar_titulo
                                 FROM titulo_universitario
                                 WHERE cedula_identidad = ".$cedulaIdentidad;
        return $db->fetchAll($listar_titulo);
    }

    public function extraer_titulo_universitario($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT titulo_universitario, universidad_institucion, pais_universidad, ciudad_universidad,
             registro_conesup, fecha_graduacion
             FROM titulo_universitario
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

