<?php
session_start(); 
require_once "../model/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);

		if (empty($idusuario)){
			$rspta=$usuario->insertar($nombre,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? 1 : 2;
		}
		else {
			$rspta=$usuario->editar($idusuario,$nombre,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? 3 : 4;
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fas fa-edit"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="far fa-times-circle"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fas fa-edit"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->telefono,
 				"3"=>$reg->email,
 				"4"=>$reg->login,
 				"5"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
 				"6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../model/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
				}
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;
			$_SESSION['clave']=$fetch->clave;
			$_SESSION['idmedico']=$fetch->idmedico;

	        //Obtenemos los permisos del usuario
	    	$marcados = $usuario->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
					//Determinamos los accesos del usuario
				


					//Determinamos los accesos del usuario
					in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
					in_array(6,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
					in_array(7,$valores)?$_SESSION['ayuda']=1:$_SESSION['ayuda']=0;
					/** */
					in_array(37,$valores)?$_SESSION['status']=1:$_SESSION['status']=0;
					in_array(38,$valores)?$_SESSION['statusadmin']=1:$_SESSION['statusadmin']=0;
					in_array(39,$valores)?$_SESSION['statusinvitado']=1:$_SESSION['statusinvitado']=0;
					in_array(7,$valores)?$_SESSION['reportes']=1:$_SESSION['reportes']=0;
					in_array(8,$valores)?$_SESSION['reportesadmin']=1:$_SESSION['reportesadmin']=0;
					in_array(9,$valores)?$_SESSION['reportesinvitado']=1:$_SESSION['reportesinvitado']=0;
					in_array(10,$valores)?$_SESSION['bitacora']=1:$_SESSION['bitacora']=0;
					in_array(11,$valores)?$_SESSION['bitacoraadmin']=1:$_SESSION['bitacoraadmin']=0;
					in_array(12,$valores)?$_SESSION['bitacorainvitado']=1:$_SESSION['bitacorainvitado']=0;
					in_array(13,$valores)?$_SESSION['operacion']=1:$_SESSION['operacion']=0;
					in_array(14,$valores)?$_SESSION['operacionadmin']=1:$_SESSION['operacionadmin']=0;
					in_array(15,$valores)?$_SESSION['operacioninvitado']=1:$_SESSION['operacioninvitado']=0;
					in_array(16,$valores)?$_SESSION['mantenimiento']=1:$_SESSION['mantenimiento']=0;
					in_array(17,$valores)?$_SESSION['mantenimientoadmin']=1:$_SESSION['mantenimientoadmin']=0;
					in_array(18,$valores)?$_SESSION['mantenimientoinvitado']=1:$_SESSION['mantenimientoinvitado']=0;
					in_array(19,$valores)?$_SESSION['conagua']=1:$_SESSION['conagua']=0;
					in_array(20,$valores)?$_SESSION['conaguaadmin']=1:$_SESSION['conaguaadmin']=0;
					in_array(21,$valores)?$_SESSION['conaguainvitado']=1:$_SESSION['conaguainvitado']=0;
					in_array(22,$valores)?$_SESSION['grafconagua']=1:$_SESSION['grafconagua']=0;
					in_array(23,$valores)?$_SESSION['grafconaguaadmin']=1:$_SESSION['grafconaguaadmin']=0;
					in_array(24,$valores)?$_SESSION['grafconaguainvitado']=1:$_SESSION['grafconaguainvitado']=0;
					in_array(25,$valores)?$_SESSION['kws']=1:$_SESSION['kws']=0;
					in_array(26,$valores)?$_SESSION['kwsadmin']=1:$_SESSION['kwsadmin']=0;
					in_array(27,$valores)?$_SESSION['kwsinvitado']=1:$_SESSION['kwsinvitado']=0;
					in_array(28,$valores)?$_SESSION['fp']=1:$_SESSION['fp']=0;
					in_array(29,$valores)?$_SESSION['fpadmin']=1:$_SESSION['fpadmin']=0;
					in_array(30,$valores)?$_SESSION['fpinvitado']=1:$_SESSION['fpinvitado']=0;
					in_array(31,$valores)?$_SESSION['costosiniva']=1:$_SESSION['costosiniva']=0;
					in_array(32,$valores)?$_SESSION['costosinivaadmin']=1:$_SESSION['costosinivaadmin']=0;
					in_array(33,$valores)?$_SESSION['costosinivainvitado']=1:$_SESSION['costosinivainvitado']=0;
					in_array(34,$valores)?$_SESSION['costo']=1:$_SESSION['costo']=0;
					in_array(35,$valores)?$_SESSION['costoadmin']=1:$_SESSION['costoadmin']=0;
					in_array(36,$valores)?$_SESSION['costoinvitado']=1:$_SESSION['costoinvitado']=0;
			
			
					
			// entre a la reunion en meet
			
	    }
	    $respuestajson = json_encode($fetch);

		if($respuestajson == "null"){
			echo 2;
		}else{
			echo 1;
		}


	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;
}
?>

	

