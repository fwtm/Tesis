<?php

class DatosPersonalesController extends Zend_Controller_Action
{

    public function init()
    {
        $this->initView();
        $this->view->baseUrl = $this->_request->getBaseUrl();
    }

    public function indexAction()
    {
    
    }

    public function listarCantonAction()
    {
       if ($this->getRequest()->isXmlHttpRequest())//Detectamos si es una llamada AJAX
            {
                    $this->_helper->viewRenderer->setNoRender(); //No necesitamos el render de la vista en una llamada ajax.
                    $this->_helper->layout->disableLayout(); // Solo si estas usando Zend_Layout
                    $table = new Application_Model_DbTable_Canton();
                    $idProvincia = $this->_request->getPost('id_provincia');
                    $lista = $table->listar_cantones($idProvincia);
                    $listaCanton='<option value="">[Seleccionar]</option>';
                    foreach($lista as $item):
                    $listaCanton.="<option value='".$item->id_canton."'>".$item->nombre_canton."</option>";
                    endforeach;
                    echo $listaCanton; //Devolvemos las opciones de la lista regiones.
            }
            
    }

    public function listarParroquiaAction()
    {
        if ($this->getRequest()->isXmlHttpRequest())//Detectamos si es una llamada AJAX
            {
                $this->_helper->viewRenderer->setNoRender(); //No necesitamos el render de la vista en una llamada ajax.
                $this->_helper->layout->disableLayout(); // Solo si estas usando Zend_Layout
                $table = new Application_Model_DbTable_Parroquia();
                $idCanton = $this->_request->getPost('id_canton');
                $lista = $table->listar_parroquias($idCanton);
                $listaParroquia='<option value="0">[Seleccionar]</option>';
                foreach($lista as $item):
                $listaParroquia.="<option value='".$item->id_parroquia."'>".$item->nombre_parroquia."</option>";
                endforeach;
                echo $listaParroquia; //Devolvemos las opciones de la lista regiones.
            }
            
    }

    public function listarUnidadAction()
    {
        if ($this->getRequest()->isXmlHttpRequest())//Detectamos si es una llamada AJAX
                {
                    $this->_helper->viewRenderer->setNoRender(); //No necesitamos el render de la vista en una llamada ajax.
                    $this->_helper->layout->disableLayout(); // Solo si estas usando Zend_Layout
                    $table = new Application_Model_DbTable_UnidadOperativa();
                    $idParroquia = $this->_request->getPost('id_parroquia');
                    $lista = $table->lista_unidad($idParroquia);
                    $listaUnidades='<option value="">[Seleccionar]</option>';
                    foreach($lista as $item):
                    $listaUnidades.="<option value='".$item->id_unidad."'>".$item->nombre_unidad."</option>";
                    endforeach;
                    echo $listaUnidades; //Devolvemos las opciones de la lista regiones.
                }
                
    }

    public function ingresoDatosAction()
    {
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jquery/jquery-1.5.1.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/Datos-Personales.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validation/js/jquery.validationEngine-es.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/validation/js/jquery.validationEngine.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/ListasAnidadas.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqueryui/js/jquery-ui-1.8.11.custom.min.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqueryui/js/jquery.ui.datepicker-es.js'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/validationEngine.jquery.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/template.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/botones.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqueryui/css/cupertino/jquery-ui-1.8.11.custom.css'));        

        //Para extraer la Provincia de la Base de Datos
        $provincia = new Application_Model_DbTable_Provincia();
        $this->view->provincia = $provincia->listar_provincias();
        //Para extraer el Programa Financiamiento
        $financiamiento = new Application_Model_DbTable_ProgramaFinanciamiento();
        $this->view->programa = $financiamiento->listar_programa();
        //Para extraer el Nominal
        $nominal = new Application_Model_DbTable_Nominal();
        $this->view->nominal = $nominal->listar_nominal();
        
         if ($this->getRequest()->isPost())
         {
            //Se recibe los datos enviados
            $cedulaIdentidad = $this->getRequest()->getParam('cedula_identidad');
            $codigoPersonal = $this->getRequest()->getParam('codigo_personal');
            $nombreEmpleado = $this->getRequest()->getParam('nombre_empleado');
            $apellidoEmpleado = $this->getRequest()->getParam('apellido_empleado');
            $sexo = $this->getRequest()->getParam('sexo');
            $afiliacioIess = $this->getRequest()->getParam('afiliacion_iess');
            $fechaNacimiento = $this->getRequest()->getParam('fecha_nacimiento');
            $grupoSanguineo = $this->getRequest()->getParam('grupo_sanguineo');
            $celular = $this->getRequest()->getParam('celular');
            $email = $this->getRequest()->getParam('email');
            $fotoEmpleado = $this->getRequest()->getParam('foto_empleado');
            $estadoCivil = $this->getRequest()->getParam('estado_civil');
            $ingresoSectorPublico = $this->getRequest()->getParam('ingreso_sector_publico');
            $ingresoMsp = $this->getRequest()->getParam('ingreso_msp');
            $nombramientoProvisional = $this->getRequest()->getParam('nombramiento_provisional');
            $nombramientoDefinitivo = $this->getRequest()->getParam('nombramiento_definitivo');
            $fechaNombramiento = $this->getRequest()->getParam('fecha_nombramiento');
            $contrato = $this->getRequest()->getParam('contrato');
            $idPrograma = $this->getRequest()->getParam('id_programa');
            $idNominal = $this->getRequest()->getParam('id_nominal');            
            $idUnidad = $this->getRequest()->getParam('id_unidad');
            $tiempoServicio = $this->getRequest()->getParam('tiempo_servicio');
            $estaActivo = $this->getRequest()->getParam('esta_activo');

              $datosPersonales = new Application_Model_DbTable_DatosPersonales();
              //llamo a la funcion agregar, con los datos que recibi del form
              $datosPersonales->agregar_personal($cedulaIdentidad, $codigoPersonal, $nombreEmpleado,
                                $apellidoEmpleado, $sexo, $afiliacioIess, $fechaNacimiento, $grupoSanguineo,
                                $celular, $email, $fotoEmpleado, $estadoCivil, $ingresoSectorPublico,
                                $ingresoMsp, $nombramientoProvisional, $nombramientoDefinitivo, $fechaNombramiento,
                                $contrato, $idPrograma, $idNominal, $idUnidad, $tiempoServicio, $estaActivo);


            //Almaceno los tres datos basicos(hc_digital,nombres y apellidos, ci) del paciente en una variable de sesion.
            $defaultNamespace = new Zend_Session_Namespace('Default'); //creo una variable del namespace por  defecto
            $defaultNamespace->cedula_identidad = $cedulaIdentidad;
            $defaultNamespace->nombre_empleado = $nombreEmpleado. " " .$apellidoEmpleado;
            $defaultNamespace->codido_personal = $codigoPersonal;

            $this->_helper->redirector('ingresar-domicilio', 'domicilioEmpleado');
         }

            
    }

    public function mostrarNominalAction()
    {
        if ($this->getRequest()->isXmlHttpRequest())//Detectamos si es una llamada AJAX
                {
                $this->_helper->viewRenderer->setNoRender(); //No necesitamos el render de la vista en una llamada ajax.
                $this->_helper->layout->disableLayout(); // Solo si estas usando Zend_Layout
                $table = new Application_Model_DbTable_Nominal();
                $idNominal = $this->_request->getParam('id_nominal');
                $lista = $table->mostrar_sueldo($idNominal);
                $this->view->remuneracion_mensual = $table->remuneracion_mensual;

                }
                
    }

    public function actualizarDatosAction()
    {
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jquery/jquery-1.5.1.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validation/js/jquery.validationEngine-es.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/validation/js/jquery.validationEngine.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/Validaciones/ListasAnidadas.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqueryui/js/jquery-ui-1.8.11.custom.min.js'));
        $this->view->headScript()->appendFile($this->view->baseUrl('/js/jqueryui/js/jquery.ui.datepicker-es.js'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/validationEngine.jquery.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/Validation/css/template.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/botones.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/js/jqueryui/css/cupertino/jquery-ui-1.8.11.custom.css'));

       $defaultNamespace = new Zend_Session_Namespace('Default');
              //Envio los datos del paciente a la vista
       $this->view->cedula = $defaultNamespace->cedula_identidad;
       $this->view->nombre = $defaultNamespace->nombre_empleado;
       $this->view->codigo = $defaultNamespace->codigo_personal;

        //Para extraer la Provincia de la Base de Datos
        $provincia = new Application_Model_DbTable_Provincia();
        $this->view->provincia = $provincia->listar_provincias();
        //Para extraer el Programa Financiamiento
        $financiamiento = new Application_Model_DbTable_ProgramaFinanciamiento();
        $this->view->programa = $financiamiento->listar_programa();
        //Para extraer el Nominal
        $nominal = new Application_Model_DbTable_Nominal();
        $this->view->nomina = $nominal->listar_nominal();
        $this->view->remuneracion_mensual = $nominal->remuneracion_mensual;
        //Para extraer el cargo y la funcion que desempeña
        $funciones =  new Application_Model_DbTable_Funcion();
        $this->view->desempenio = $funciones->listar_funcion();

        $defaultNamespace = new Zend_Session_Namespace('Default');
        $this->view->cedula_identidad = $defaultNamespace->cedula_identidad;
        $cedulaIdentidad =  $defaultNamespace->cedula_identidad;

        $tabla_datos = new Application_Model_DbTable_DatosPersonales();
        $datospersonal = $tabla_datos->extraer_personal($cedula_identidad);

        //Muestro los datos del personal para su edicion
        $this->view->codigo_personal = $datospersonal->codigo_personal;
        $this->view->nombre_empleado = $datospersonal->nombre_empleado;
        $this->view->apellido_empleado = $datospersonal->apellido_empleado;
        $this->view->sexo = $datospersonal->sexo;
        $this->view->afiliacion_iess = $datospersonal->afiliacion_iess;
        $this->view->fecha_nacimiento = $datospersonal->fecha_nacimiento;
        $this->view->grupo_sanguineo = $datospersonal->grupo_sanguineo;
        $this->view->celular = $datospersonal->celular;
        $this->view->email = $datospersonal->email;
        $this->view->foto_empleado = $datospersonal->foto_empleado;
        $this->view->estado_civil = $datospersonal->estado_civil;
        $this->view->ingreso_sector_publico = $datospersonal->ingreso_sector_publico;
        $this->view->ingreso_msp = $datospersonal->ingreso_msp;
        $this->view->nombramiento_provisional = $datospersonal->nombramiento_provisional;
        $this->view->nombramiento_definitivo = $datospersonal->nombramiento_definitivo;
        $this->view->fecha_nombramiento = $datospersonal->fecha_nombramiento;
        $this->view->contrato = $datospersonal->contrato;
        $this->view->id_programa = $datospersonal->id_programa;
        $this->view->id_nominal = $datospersonal->id_nominal;
        $this->view->id_unidad = $datospersonal->id_unidad;
        $this->view->tiempo_servicio = $datospersonal->tiempo_servicio;
        $this->view->esta_activo = $datospersonal->esta_activo;

        if ($this->getRequest()->isPost())
         {
            //Se recibe los datos enviados
            $cedulaIdentidad = $this->getRequest()->getParam('cedula_identidad');
            $codigoPersonal = $this->getRequest()->getParam('codigo_personal');
            $nombreEmpleado = $this->getRequest()->getParam('nombre_empleado');
            $apellidoEmpleado = $this->getRequest()->getParam('apellido_empleado');
            $sexo = $this->getRequest()->getParam('sexo');
            $afiliacioIess = $this->getRequest()->getParam('afiliacion_iess');
            $fechaNacimiento = $this->getRequest()->getParam('fecha_nacimiento');
            $grupoSanguineo = $this->getRequest()->getParam('grupo_sanguineo');
            $celular = $this->getRequest()->getParam('celular');
            $email = $this->getRequest()->getParam('email');
            $fotoEmpleado = $this->getRequest()->getParam('foto_empleado');
            $estadoCivil = $this->getRequest()->getParam('estado_civil');
            $ingresoSectorPublico = $this->getRequest()->getParam('ingreso_sector_publico');
            $ingresoMsp = $this->getRequest()->getParam('ingreso_msp');
            $nombramientoProvisional = $this->getRequest()->getParam('nombramiento_provisional');
            $nombramientoDefinitivo = $this->getRequest()->getParam('nombramiento_definitivo');
            $fechaNombramiento = $this->getRequest()->getParam('fecha_nombramiento');
            $contrato = $this->getRequest()->getParam('contrato');
            $idPrograma = $this->getRequest()->getParam('id_programa');
            $idNominal = $this->getRequest()->getParam('id_nominal');
            $idUnidad = $this->getRequest()->getParam('id_unidad');
            $tiempoServicio = $this->getRequest()->getParam('tiempo_servicio');
            $estaActivo = $this->getRequest()->getParam('esta_activo');

            $tabla_datos->actualizar_personal($cedulaIdentidad, $codigoPersonal, $nombreEmpleado,
                    $apellidoEmpleado, $sexo, $afiliacioIess, $fechaNacimiento, $grupoSanguineo, $celular,
                    $email, $fotoEmpleado, $estadoCivil, $ingresoSectorPublico, $ingresoMsp,
                    $nombramientoProvisional, $nombramientoDefinitivo, $fechaNombramiento, $contrato,
                    $idPrograma, $idNominal, $idUnidad, $tiempoServicio, $estaActivo);

            $this->_helper->redirector('actualizar-datos', 'DatosPersonales');
         }
         
    }

    public function visualizarDatosAction()
    {
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/format_table.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/botones.css'));
        $this->view->headLink()->appendStylesheet($this->view->baseUrl('/css/style.css'));

        $defaultNamespace = new Zend_Session_Namespace('Default');
        $cedulaIdentidad= $defaultNamespace->cedula_identidad;

        $personal =  new Application_Model_DbTable_DatosPersonales();
        $datos = $personal->extraer_personal($cedulaIdentidad);

        $domicilio = new Application_Model_DbTable_DireccionDomicilio();
        $datos1 = $domicilio->extraer_domicilio($cedulaIdentidad);

        $funcion = new Application_Model_DbTable_Funcion();
        $datos2 = $funcion->extraer_funcion($cedulaIdentidad);

        $discapacidad = new Application_Model_DbTable_Discapacidad();
        $datos3 = $discapacidad->extraer_discapacidad($cedulaIdentidad);

        $tituloUniversitario = new Application_Model_DbTable_TituloUniversitario();
        $datos4 = $tituloUniversitario->extraer_titulo_universitario($cedulaIdentidad);

        $tituloPostgrado = new Application_Model_DbTable_TituloPostgrado();
        $datos5 = $tituloPostgrado->extraer_titulo_postgrado($cedulaIdentidad);

        $docencia = new Application_Model_DbTable_DocenciaUniversitaria();
        $datos6 = $docencia->extraer_docencia($cedulaIdentidad);

        $estudiosActuales = new Application_Model_DbTable_EstudiosActuales();
        $datos7 = $estudiosActuales->extraer_estudios($cedulaIdentidad);

        $experiencia = new Application_Model_DbTable_ExperienciaLaboral();
        $datos8 = $experiencia->extraer_experiencia($cedulaIdentidad);

        $capacitacion = new Application_Model_DbTable_Capacitacion();
        $datos9 = $capacitacion->extraer_capacitacion($cedulaIdentidad);

         if(!$datos){
             $this->view->mensajeError ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->cedula_identidad = $cedulaIdentidad;
                 $this->view->codigo_personal = $datos->codigo_personal;
                 $this->view->nombre_empleado = $datos->nombre_empleado;
                 $this->view->apellido_empleado = $datos->apellido_empleado;
                 $this->view->sexo = $datos->sexo;
                 $this->view->afiliacion_iess = $datos->afiliacion_iess;
                 $this->view->fecha_nacimiento = $datos->fecha_nacimiento;
                 $this->view->grupo_sanguineo = $datos->grupo_sanguineo;
                 $this->view->celular = $datos->celular;
                 $this->view->foto_empleado = $datos->foto_empleado;
                 $this->view->estado_civil = $datos->estado_civil;
                 $this->view->ingreso_sector_publico = $datos->ingreso_sector_publico;
                 $this->view->ingreso_msp = $datos->ingreso_msp;
                 $this->view->nombramiento_provisional = $datos->nombramiento_provisional;
                 $this->view->nombramiento_definitivo = $datos->nombramiento_definitivo;
                 $this->view->fecha_nombramiento = $datos->fecha_nombramiento;
                 $this->view->contrato = $datos->contrato;
                 $this->view->programa_financiamiento = $datos->programa_financiamiento;
                 $this->view->grupo_ocupacional = $datos->grupo_ocupacional;
                 $this->view->remuneracion_mensual = $datos->remuneracion_mensual;
                 $this->view->nombre_provincia = $datos->nombre_provincia;
                 $this->view->nombre_canton = $datos->nombre_canton;
                 $this->view->nombre_parroquia = $datos->nombre_parroquia;
                 $this->view->nombre_unidad = $datos->nombre_unidad;
                 $this->view->tiempo_servicio = $datos->tiempo_servicio;
                 $this->view->esta_activo = $datos->esta_activo;
             }

             if(!$datos1){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->avenida_direccion = $datos1->avenida_direccion;
                 $this->view->calle_direccion = $datos1->calle_direccion;
                 $this->view->manzana_domicilio = $datos1->manzana_domicilio;
                 $this->view->lugar_referencia = $datos1->lugar_referencia;
                 $this->view->contacto_referencia = $datos1->contacto_referencia;
                 $this->view->telefono_contacto = $datos1->telefono_contacto;
             }

             if(!$datos2){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->cargo = $datos2->cargo;
                 $this->view->puesto_institucional = $datos2->puesto_institucional;
                 $this->view->tipo_especialidad = $datos2->tipo_especialidad;
                 $this->view->departamento = $datos2->departamento;
                 $this->view->oficina_consultorio = $datos2->oficina_consultorio;
             }

             if(!$datos3){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->tipo_discapacidad = $datos3->tipo_discapacidad;
                 $this->view->porcentaje_discapacidad = $datos3->porcentaje_discapacidad;
                 $this->view->carnet_conadis = $datos3->carnet_conadis;
             }

             if(!$datos4){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->titulo_universitario = $datos4->titulo_universitario;
                 $this->view->universidad_institucion = $datos4->universidad_institucion;
                 $this->view->pais_universidad = $datos4->pais_universidad;
                 $this->view->ciudad_universidad = $datos4->ciudad_universidad;
                 $this->view->registro_conesup = $datos4->registro_conesup;
                 $this->view->fecha_graduacion = $datos4->fecha_graduacion;
             }

             if(!$datos5){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->nombre_postgrado = $datos5->nombre_postgrado;
                 $this->view->institucion_postgrado = $datos5->institucion_postgrado;
                 $this->view->titulo_obtenido = $datos5->titulo_obtenido;
                 $this->view->registro_conesup = $datos5->registro_conesup;
                 $this->view->fecha_graduacion = $datos5->fecha_graduacion;
             }

             if(!$datos6){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->institucion_docencia = $datos6->institucion_docencia;
                 $this->view->tipo_contrato = $datos6->tipo_contrato;
                 $this->view->catedra = $datos6->catedra;
                 $this->view->horas_semana = $datos6->horas_semana;
             }

             if(!$datos7){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->establecimiento = $datos7->establecimiento;
                 $this->view->titulo_obtener = $datos7->titulo_obtener;
                 $this->view->nivel_actual = $datos7->nivel_actual;
             }

             if(!$datos8){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->institucion_empresa = $datos8->institucion_empresa;
                 $this->view->puesto_cargo = $datos8->puesto_cargo;
                 $this->view->fecha_entrada = $datos8->fecha_entrada;
                 $this->view->fecha_salida = $datos8->fecha_salida;
                 $this->view->id_canton = $datos8->id_canton;
             }

             if(!$datos9){
             $this->view->mensajeErro ='Se ha producido un error interno al intentar recuperar datos.'
                                        .' Los Datos de la Persona con cedula de identidad No. '.$cedulaIdentidad.' esta incompleta o no existe '
                                       .' Por favor comuniquese con el Administrador';
             }else
             {
                 $this->view->nombre_evento = $datos9->nombre_evento;
                 $this->view->institucion_capacitacion = $datos9->institucion_capacitacion;
                 $this->view->fecha_capacitacion = $datos9->fecha_capacitacion;
                 $this->view->total_horas = $datos9->total_horas;
                 $this->view->lugar = $datos9->lugar;
             }
    }

}
