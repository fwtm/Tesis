<?php

class Application_Model_DbTable_RegistroIngreso extends Zend_Db_Table_Abstract
{

    protected $_name = 'registro_ingreso';

     public function listar_horas_por_cedula($consulta)
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
        $select = "SELECT row_number() over (order by tb.fecha_registro) as item, dp.nombre_empleado, dp.apellido_empleado, dp.codigo_personal, tb.fecha_registro, tb.hora_registro
                   FROM datos_personales AS dp
                   INNER JOIN registro_ingreso AS tb ON (dp.codigo_personal = tb.codigo_personal)
                   WHERE (dp.nombre_empleado LIKE '%".$consulta."%')
                   OR (dp.apellido_empleado LIKE '%".$consulta."%')";
        return $db->fetchAll($select);
    }

    public function listar_horas_por_apellidos($apellidoEmpleado)
    {
         //recupero objeto desde el registro
        $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:

        return $db->fetchAll();
    }

    public function ingresar_registros($archivo)
    {
         $db = Zend_Registry::get('pgdb');
        //opcional, esto es para que devuelva los resultados como objetos $row->campo
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //hago la consulta sql que desee:
        $select = "COPY registro_ingreso FROM 'C:/xampp/tmp/$archivo' DELIMITER ','";
        return $db->fetchAll($select);
    }

    public function listar()
    {
      //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $select = "SELECT row_number() over (order by tb.codigo_personal), *
                    FROM registro_ingreso AS tb";
        return $db->fetchAll($select);
    }

    public function listar_registros()
    {
        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);
         $select = "SELECT row_number() over (order by codigo_personal) as item, codigo_personal, fecha_registro, hora_registro
                   FROM registro_ingreso";
        return $db->fetchAll($select);
        
    }

}

