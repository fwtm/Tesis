<?php

class Application_Model_DbTable_DatosPersonales extends Zend_Db_Table_Abstract
{

    protected $_name = 'datos_personales';

    public function extraer_personal($cedula_identidad)
    {
        $cedula_identidad = (int)$cedula_identidad;

        //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT dp.codigo_personal, dp.nombre_empleado, dp.apellido_empleado,
       dp.sexo, dp.afiliacion_iess, dp.fecha_nacimiento, dp.grupo_sanguineo, dp.celular,
       dp.email, dp.foto_empleado, dp.estado_civil, dp.ingreso_sector_publico, dp.ingreso_msp,
       dp.nombramiento_provisional, dp.nombramiento_definitivo, dp.fecha_nombramiento,
       dp.contrato, pf.programa_financiamiento, nm.grupo_ocupacional, nm.remuneracion_mensual,
       pr.nombre_provincia, ca.nombre_canton, pq.nombre_parroquia,
       um.nombre_unidad, dp.tiempo_servicio, dp.esta_activo
       FROM datos_personales As dp
      INNER JOIN programa_financiamiento AS pf ON (dp.id_programa = pf.id_programa)
      INNER JOIN nominal AS nm ON (dp.id_nominal = nm.id_nominal)
      INNER JOIN unidad_operativa AS um ON (dp.id_unidad = um.id_unidad)
      INNER JOIN parroquia AS pq ON (um.id_parroquia = pq.id_parroquia)
      INNER JOIN canton AS ca ON (pq.id_canton = ca.id_canton)
      INNER JOIN provincia AS pr ON (ca.id_provincia = pr.id_provincia)
      WHERE dp.cedula_identidad =" .$cedula_identidad;

         try {

           $row = $db->fetchRow($select);
             }
            catch (Zend_Exception $e)
         {
           echo "Db error : " . $e->getMessage() . "\n";
         }

         return $row;
    }

    public function agregar_personal($cedulaIdentidad, $codigoPersonal, $nombreEmpleado, $apellidoEmpleado, $sexo, $afiliacioIess,
                                 $fechaNacimiento, $grupoSanguineo, $celular, $email, $fotoEmpleado, $estadoCivil,
                                 $ingresoSectorPublico, $ingresoMsp, $nombramientoProvisional, $nombramientoDefinitivo,
                                 $fechaNombramiento, $contrato, $idPrograma, $idNominal, $idUnidad, $tiempoServicio, $estaActivo)
    {
        $datosPersonales = array('cedula_identidad' => $cedulaIdentidad, 'codigo_personal' => $codigoPersonal, 'nombre_empleado' => $nombreEmpleado,
                                 'apellido_empleado' => $apellidoEmpleado, 'sexo' => $sexo, 'afiliacion_iess' => $afiliacioIess, 'fecha_nacimiento' => $fechaNacimiento,
                                 'grupo_sanguineo' => $grupoSanguineo, 'celular' => $celular, 'email' => $email, 'foto_empleado' => $fotoEmpleado, 'estado_civil' => $estadoCivil,
                                 'ingreso_sector_publico' => $ingresoSectorPublico, 'ingreso_msp' => $ingresoMsp, 'nombramiento_provisional'=>$nombramientoProvisional,
                                 'nombramiento_definitivo'=>$nombramientoDefinitivo, 'fecha_nombramiento'=>$fechaNombramiento, 'contrato'=>$contrato, 'id_programa'=>$idPrograma, 'id_nominal'=>$idNominal,
                                 'id_unidad'=>$idUnidad, 'tiempo_servicio'=>$tiempoServicio, 'esta_activo' => $estaActivo);
        //$this->insert inserta nuevos datos Personales
        $this->insert($datosPersonales);
    }

     public function actualizar_personal($cedulaIdentidad, $codigoPersonal, $nombreEmpleado, $apellidoEmpleado, $sexo, $afiliacioIess,
                                 $fechaNacimiento, $grupoSanguineo, $celular, $email, $fotoEmpleado, $estadoCivil,
                                 $ingresoSectorPublico, $ingresoMsp, $nombramientoProvisional, $nombramientoDefinitivo,
                                 $fechaNombramiento, $contrato, $idPrograma, $idNominal, $idUnidad, $tiempoServicio, $estaActivo)
     {
         $data = array('cedula_identidad' => $cedulaIdentidad, 'codigo_personal' => $codigoPersonal, 'nombre_empleado' => $nombreEmpleado,
             'apellido_empleado' => $apellidoEmpleado, 'sexo' => $sexo, 'afiliacion_iess' => $afiliacioIess, 'fecha_nacimiento' => $fechaNacimiento,
             'grupo_sanguineo' => $grupoSanguineo, 'celular' => $celular, 'email' => $email, 'foto_empleado' => $fotoEmpleado, 'estado_civil' => $estadoCivil,
             'ingreso_sector_publico' => $ingresoSectorPublico, 'ingreso_msp' => $ingresoMsp, 'nombramiento_provisional'=>$nombramientoProvisional,
             'nombramiento_definitivo'=>$nombramientoDefinitivo, 'fecha_nombramiento'=>$fechaNombramiento, 'contrato'=>$contrato, 'id_programa'=>$idPrograma, 'id_nominal'=>$idNominal,
             'id_unidad'=>$idUnidad, 'tiempo_servicio'=>$tiempoServicio, 'esta_activo' => $estaActivo);

         $this->update($data, 'cedula_identidad = ' . (int) $cedulaIdentidad);
     }

}

