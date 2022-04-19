<?php

class Application_Model_DbTable_DireccionDomicilio extends Zend_Db_Table_Abstract
{

    protected $_name = 'direccion_domicilio';

    public function consultar_ultimo_id()
     {
          $select= $this->select();
          $select->from('direccion_domicilio',array('ultm_id' => 'max(id_domicilio)'));
          return $this->fetchRow($select);
     }

    public function ingresar_domicilio($idDomicilio, $cedulaIdentidad, $avenidaDireccion, $calleDireccion,
            $manzanaDomicilio, $lugarReferencia, $contactoReferencia, $telefonoContacto)
    {
        $direccion = array('id_domicilio' => $idDomicilio, 'cedula_identidad' => $cedulaIdentidad, 'avenida_direccion' => $avenidaDireccion,
                            'calle_direccion' => $calleDireccion, 'manzana_domicilio' => $manzanaDomicilio,
                            'lugar_referencia' => $lugarReferencia, 'contacto_referencia' => $contactoReferencia,
                            'telefono_contacto' => $telefonoContacto);
                    $this->insert($direccion);
    }

    public function extraer_domicilio($cedula_identidad)
    {
         $cedula_identidad = (int)$cedula_identidad;
         //recupero objeto desde el registro
         $db = Zend_Registry::get('pgdb');
         //opcional, esto es para que devuelva los resultados como objetos $row->campo
         $db->setFetchMode(Zend_Db::FETCH_OBJ);

         $select = "SELECT avenida_direccion, calle_direccion, manzana_domicilio, lugar_referencia,
            contacto_referencia, telefono_contacto FROM direccion_domicilio
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

