<? 
if (!isset($_SESSION)) {
	session_start();
}

//Configuracion del servidor
$carpet_root 	= "http://servidorlocal/securearea123456789/Sms-mensajes/";
$login_page 	= "http://www.navegalo.com/sms/loginsc.php";
$foot			= "Hosting+y+dominios+-+Racklodge.com";

$arr = array();
function comandos_web($modulo,$tipo,$cont_name,$cont_number,$cont_id,$msj_foot,$msj_mensaje,$msj_number,$dia,$mes,$año){
	global $login_page,$user,$pass,$foot;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $login_page);
	curl_setopt ($ch, CURLOPT_POST, 1);
	//curl_setopt ($ch, CURLOPT_POSTFIELDS, 'user='.$user.'&pass='.$pass.'&Submit=Ingresar');
	curl_setopt ($ch, CURLOPT_POSTFIELDS, 'user='.$_SESSION['Username'].'&pass='.$_SESSION['Password'].'&Submit=Ingresar');
	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_exec ($ch);
	
	if ($modulo == "contactos"){ 
	switch ($tipo) {
		//VER
    case 0:
        	curl_setopt($ch, CURLOPT_URL, 'http://www.navegalo.com/sms/inContactos.php' );
			curl_setopt ($ch, CURLOPT_POST, 1);
        	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        	$cadena = curl_exec ($ch);			
			preg_match_all( '/javascript:ag\(\'(.*?)\'\);/i', $cadena, $identificadores);
        	preg_match_all( '/<font color="#000D39" size="2" face="Verdana">(.*?)<\/font>/i', $cadena, $nombres);
        	preg_match_all( '/<div align="center" class="style9"><font size="2" face="Verdana">(.*?)<\/font><\/div><\/td>/i', $cadena, $numero);
        	preg_match_all( '/<a href="core\/acciones.php\?del\=(.*?)\&delAgen\=1">/i', $cadena, $id_numero);  
			$total 		= count($identificadores[1]);
			$metadata = '"metaData":{idProperty:"A",root:"data",totalProperty:"total",fields:[{name: 																							"A"},{name: "B"},{name: "C"},{name: "D"},{name: "E"}],sortInfo:{field:"B",direction:"ASC"}}';
			if (count($identificadores[1]) == 0)  	{
			echo '({"total":"0", "data":""})'; 	
			} else {				
			for ($i = 0, $limite = $total; $i < $limite; $i++) {
			$arr .=  "{A:'".$i."',B:'".$identificadores[1][$i]."',C:'".$nombres[1][$i]."',D:'".$numero[1][$i]."',E:'".$id_numero[1][$i]."'},";			
        	}
			$dataa = substr($arr,'',-1);
			echo '{'.$metadata.',"total":"'.$total.'","data":['.$dataa.']}'; 
			};					
        break;		
		//ADD
    case 1:
        	curl_setopt($ch, CURLOPT_URL, 'http://www.navegalo.com/sms/core/acciones.php' );
			curl_setopt ($ch, CURLOPT_POST, 1);
        	curl_setopt ($ch, CURLOPT_POSTFIELDS, 'nom='.$cont_name.'&tel='.$cont_number.'&addAgen=Agregar');
        	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        	curl_exec ($ch);			
        break;
		//DEL
    case 2:
        	curl_setopt($ch,CURLOPT_URL,'http://www.navegalo.com/sms/core/acciones.php?del='.$cont_id.'&delAgen=1' );
        	curl_exec ($ch);				
        break;
	};	
	};
	
	if ($modulo == "mensajes"){ 
	switch ($tipo) {
		//VER
    case 0:
			//EXTRAEMOS ID DEL USUARIO
        	curl_setopt($ch, CURLOPT_URL, 'http://www.navegalo.com/sms/default.php' );
			curl_setopt ($ch, CURLOPT_POST, 1);
        	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        	$cadena = curl_exec ($ch);
        	preg_match_all( '/<iframe src="inMensajes.php\?idUser=(.*?)&userAct=/i', $cadena, $id);	
        	for ($i = 0, $limite = count($id[1]); $i < $limite; $i++) {
        	$id_user = $id[1][$i];
        	};				
			//EXTRAEMOS MENSAJES
        	curl_setopt($ch, CURLOPT_URL, 'http://www.navegalo.com/sms/inMensajes.php?idUser='.$id_user.'&userAct='.$user.'&foot='.$foot );
			curl_setopt ($ch, CURLOPT_POST, 1);
        	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        	$cadena = curl_exec ($ch);
        	preg_match_all( '/(.*?) =>/i', $cadena, $numero);
        	preg_match_all( '/=> (.*?)<br><br>/i', $cadena, $mensaje);			
			$total 		= count($numero[1]);
			$metadata = '"metaData":{idProperty:"A",root:"data",totalProperty:"total",fields:[{name: 																							"A"},{name: "B"},{name: "C"}],sortInfo:{field:"B",direction:"ASC"}}';
			if (count($numero[1]) == 0)  	{
			echo '({"total":"0", "data":""})'; 	
			} else {				
			for ($i = 0, $limite = $total; $i < $limite; $i++) {
			$arr .=  "{A:'".$i."',B:'".$numero[1][$i]."',C:'".$mensaje[1][$i]."'},";			
        	}
			$dataa = substr($arr,'',-1);
			echo '{'.$metadata.',"total":"'.$total.'","data":['.$dataa.']}'; 
			};				
        break;		
		//ADD
    case 1:
        	curl_setopt($ch, CURLOPT_URL, 'http://www.navegalo.com/sms/core/acciones.php' );
			curl_setopt ($ch, CURLOPT_POST, 1);
        	curl_setopt ($ch, CURLOPT_POSTFIELDS, 'footer='.$msj_foot.'&count=1&insertaMensaje=1&smsMsg='.$msj_mensaje.'&disponible=17+de+116+caracteres&pais=Costa+Rica&proveedor=103&area=&numtelefono='.$msj_number.'&Enviar2=Enviar');				
        	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        	curl_exec ($ch);
        break;
		//DEL
    case 2:
        //NO EXISTE DELETE
        break;
	};	
	};
	
	if ($modulo == "recordatorios"){ 
	switch ($tipo) {
		//VER lISTA DE RECORDATORIOS X MES
    case 0:
        	curl_setopt($ch, CURLOPT_URL, 'http://www.navegalo.com/sms/agenda.php?d='.$dia.'&m='.$mes.'&y='.$año );
			curl_setopt ($ch, CURLOPT_POST, 1);
        	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        	$cadena = curl_exec ($ch);		
			preg_match_all( '/<td align="center" class="dia tit3"><a href="(.*?)">/i', $cadena, $recordatorio);		
			$total 		= count($recordatorio[1]);
			$metadata = '"metaData":{idProperty:"A",root:"data",totalProperty:"total",fields:[{name: 																							"A"},{name:"B"}],sortInfo:{field:"B",direction:"ASC"}}';
			if (count($recordatorio[1]) == 0)  	{
			echo '({"total":"0", "data":""})'; 	
			} else {				
			for ($i = 0, $limite = $total; $i < $limite; $i++) {
			$arr .=  "{A:'".$i."',B:'".$recordatorio[1][$i]."'},";			
        	}
			$dataa = substr($arr,'',-1);
			echo '{'.$metadata.',"total":"'.$total.'","data":['.$dataa.']}'; 
			};	
        break;		
		//VER RECORDATORIOS DE 1 DIA
    case 1:
        	curl_setopt($ch, CURLOPT_URL, 'http://www.navegalo.com/sms/agenda.php?d='.$dia.'&m='.$mes.'&y='.$año );
			curl_setopt ($ch, CURLOPT_POST, 1);
        	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        	$cadena = curl_exec ($ch);	
			preg_match_all( '/<th width="15%" class="di STYLE7" align="left"> <font face="Verdana" size="2">&nbsp;(.*)<\/font> <\/th>/siU', $cadena, $hora);										
			preg_match_all( '/ <td width="68%" align="left" class="aviso"><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">(.*)<\/font><\/td>/siU', $cadena, $mensaje);
			$total 		= count($hora[1]);
			$metadata = '"metaData":{idProperty:"A",root:"data",totalProperty:"total",fields:[{name: 																							"A"},{name:"B"},{name:"C"}] ,sortInfo:{field:"B",direction:"ASC"}}';
			if (count($hora[1]) == 0)  	{
			echo '({"total":"0", "data":""})'; 	
			} else {				
			for ($i = 0, $limite = $total; $i < $limite; $i++) {
			$arr .=  "{A:'".$i."',B:'".$hora[1][$i]."',C:'".strip_tags($mensaje[1][$i])."'},";			
        	}
			$dataa = substr($arr,'',-1);
			echo '{'.$metadata.',"total":"'.$total.'","data":['.$dataa.']}'; 
			};			
        break;	
		//ADD
    case 2:
        break;
		//DEL
    case 3:
        break;
	};	
	};


	curl_close ($ch); 
};	

//MODULO CONTACTOS
function get_contactos (){
	comandos_web('contactos',0,0,0,0,0,0,0,0,0,0);
};	
function add_contactos ($name,$number){
	comandos_web('contactos',1,$name,$number,0,0,0,0,0,0,0);
};	
function del_contactos ($id){
	comandos_web('contactos',2,0,0,$id,0,0,0,0,0,0);
};	

//MODULO MENSAJES
function get_mensajes (){
	comandos_web('mensajes',0,0,0,0,0,0,0,0,0,0);
};	
function add_mensajes ($msj_foot,$msj_mensaje,$msj_number){
	comandos_web('mensajes',1,0,0,0,$msj_foot,$msj_mensaje,$msj_number,0,0,0);
};	

//MODULO DE RECORDATORIOS
function get_recordatorios_list ($dia,$mes,$año ){
	comandos_web('recordatorios',0,0,0,0,0,0,0,$dia,$mes,$año);
};	

function get_recordatorios($dia,$mes,$año ){
	comandos_web('recordatorios',1,0,0,0,0,0,0,$dia,$mes,$año);
};	

//MODULO DE LOGIN
function login ($user,$pass){
	comandos_web('recordatorios',0,0,0,0,0,0,0,$dia,$mes,$año);
};	


//get_contactos ();
//add_contactos ('name','11111');
//del_contactos ('1144773');
//get_mensajes ();
//add_mensajes ($foot,'mensaje','0034343');
//Si se kiere ver todos los recordatorios.. hacer un bucle del 1 al 12
//get_recordatorios_list('1','12','2009');
//get_recordatorios('25','12','2009');

//AGREGAR seguridad a las variables
if (!function_exists("var_safe")) {
function var_safe($var_to_safe,$html)
{
//convierte los html tags a entidades html
//$var_safe = htmlentities($var_to_safe);
if ($html=="0")
{
//o es no, 1 es si - elimina tags
$var_safe = strip_tags($var_to_safe);
} else{
$var_safe = $var_to_safe;
}
return $var_safe;
}
}

// FUNCIONES DE TIPOS DE CARACTERES
function only_ids($ids){
			if(is_numeric($ids)){
			return $ids;
			}else{
			die( '{success:false,data:{"result":"Solo se adm numeros!"}}' );
			} 
} 
function only_leters($leters){
			if(ereg('^[a-zA0-Z9]+$', $leters)){
			die( '{success:false,data:{"result":"Solo se adm letras!"}}' );
			}else{
			return $leters;
			} 
} 
function only_leters_numb($leters_numb){
			if(ereg('[^A-Za-zñÑáéíóúÁÉÍÓÚ@.,]', $leters_numb)){
			die( '{success:false,data:{"result":"Solo se adm letras y num!"}}' );
			}else{
			return $leters_numb;
			} 
} 

//ACTION - ENVIA EL TIPO DE PROCEDIEMIENTO (ADD,DEL,UPD)
$action = "NULL";
$safe_action = "NULL";
if (isset($_POST['A']) && ($_POST['A'] != "")) {
  	$action 		= $_POST['A'];
	$safe_action	= var_safe($action,0);  
}
//xaction - ENVIA LA SECCION
$xaction = "NULL";
$safe_xaction = "NULL";
if (isset($_GET['xaction']) && ($_GET['xaction'] != "")) {
  	$xaction 		= $_GET['xaction'];
	$safe_xaction = var_safe($xaction,0); 
} 


switch ($safe_action) {
	default:
        	 die(" L0L ");
    break; 
	//MODULO DE CONTACTOS
	case "1":	
			switch ($safe_xaction) {
					default:
        			die(" LOL ");
   					break; 
					case "1": 					
					get_contactos ();
   					break;  
   					case "2": 					
   					add_contactos ($_POST['name'],only_ids($_POST['numero']));
					echo '{success:true,data:{"result":" Contacto Agregado "}}';	
   					break;  
   					case "3":    
					del_contactos (only_ids($_POST['contacto']));
					echo '{success:true,data:{"result":" Contacto eliminado del servidor "}}';	
   					break; 
			};
    break;  
	//MODULO DE MENSAJES
	case "2": 	
			switch ($safe_xaction) {
					default:
        			die(" LOL ");
   					break; 
					case "1": 					
					get_mensajes ();
   					break;  
   					case "2": 	
					add_mensajes ($foot,$_POST['mensaje'],only_ids($_POST['numero']));
					echo '{success:true,data:{"result":" Mensaje enviado al servidor "}}';					
   					break;  
			};
    break;  
	//MODULO DE RECORDATORIOS
	case "3": 	
			switch ($safe_xaction) {
					default:
        			die(" LOL ");
   					break; 
					case "1.1": 					
					get_recordatorios_list('1','12','2009');
   					break;  
   					case "1.2": 	
   					get_recordatorios('25','12','2009');
   					break;  
			};	
    break; 
	//MODULO DE LOGIN
	case "4": 	
			switch ($safe_xaction) {
					default:
        			die(" LOL ");
   					break; 
					//LOGIN
					case "1": 			
					$user	 = htmlentities( $_POST['loginUsername'] );
					$pass	 = htmlentities( $_POST['loginPassword'] );
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $login_page);
					curl_setopt ($ch, CURLOPT_POST, 1);
					curl_setopt ($ch, CURLOPT_POSTFIELDS, 'user='.$user.'&pass='.$pass.'&Submit=Ingresar');
					curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);	
					$check = htmlentities( curl_exec ($ch) );
					if  ($check!="&lt;script&gt;document.location.href='index.php?men=3'&lt;/script&gt;"){
					$_SESSION['Username'] = $user;
					$_SESSION['Password'] = $pass;
					$result["success"] = true;
					//echo $check;
					} else{
					$result["success"] = false;
					}
					echo json_encode($result);
   					break;  
			};	
    break; 
};


	

?> 