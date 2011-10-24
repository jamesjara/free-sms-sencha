<?php if (!isset($_SESSION)) {
	//Crea la sesion
	session_start();
} 
//Cierra la sesion , comprueba variable doLogout
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
	$logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
	//Para un correcto cierre de sesion, se debe resetear variables
	$_SESSION['Username'] = NULL;
	unset($_SESSION['Username']);
}	
?>