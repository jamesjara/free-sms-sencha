<?php
//Si no viene de la pagina princial mandar error  - add full url
if ( (basename($_SERVER['PHP_SELF'])!="index.php") )
{
die('No tiene derechos');	
}
?>