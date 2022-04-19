<?php

class Application_Model_DbTable_TituloPostgrado extends Zend_Db_Table_Abstract
{

    protected $_name = 'titulo_postgrado';

    public function agregar_postgrado($idTituloPostgrado, $cedulaIdentidad, $nombrePostgrado, $institucionPostgrado, $tituloObtenido,
             $registroConesup, $fechaGraduacion, $verificarPostgrado)
    {
        $postgrado = array('cedula_identidad' => $cedulaIdentidad, 'nombre_postgrado' => $nombrePostgrado, 'institucion_postgrado' => $institucionPostgrado,
            'titulo_obtenido' => $tituloObtenido, 'registro_conesup' => $registroConesup, 'fecha_graduacion' => $fechaGraduacion,
            'verificar_postgrado' => $verificarPostgrado);

        $this->insert($postgrado);
    }

    public function listar_postgrado_cedula($cedulaIdentidad)
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $listar_postgrado = "SELECT id_postgrado, cedula_identidad, nombre_postgrado, institucion_postgrado,
                           titulo_obtenido, registro_conesup, fecha_graduacion, verificar_postgrado
                           FROM titulo_postgrado
                           WHERE cedula_identidad = ".$cedulaIdentidad;
        return $db->fetchAll($listar_postgrado);
    }

    public function extraer_titulo_postgrado($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT nombre_postgrado, institucion_postgrado, titulo_obtenido, registro_conesup,
             fecha_graduacion
             FROM titulo_postgrado
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

