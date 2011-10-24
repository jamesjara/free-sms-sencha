<?php
//Modulo De Sesion
include("core/modules/sesion.php");
?><?php
//Tip visual 
for ($i = 1; $i <= 100; $i++) {
echo"



";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org
/1999/xhtml">
<head>
	<meta name="google-site-verification" content="5L4fJR-HV4jczW6BL8V3a3ENONs61H7pYPFlChCU3mQ" />
	<link rel="shortcut icon" href="core/resources/icon.png">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="core/resources/icono.ico">
	<title>Enviar Sms - Mensajes Gratis - Costa Rica - Enviar mensajes</title>
	<meta name="keywords" content="sms,enviar sms gratis,mensaje celular gratis costa rica," />
	<meta name="description" content="Envia mensaje sms a cualquier parte completamente gratis desde tu pc, envia mensajes de celular sms gratis" />
	<meta name="author" content="James jara - Innosystem" />
	<meta name="copyright" content="2010 innosystem" />
	<meta name="distribution" content="global" />
	<meta name="rating" content="general" />
    <link rel="stylesheet" type="text/css" href="core/coreresources/css/all.css" />
    <link rel="stylesheet" type="text/css" href="core/coreresources/css/xtheme-black.css" />
	<link rel="stylesheet" type="text/css" href="core/resources/aplication.css" />
	<script type="text/javascript" src="core/basic/base.js"></script>
	<script type="text/javascript" src="core/basic/all.js"></script>
	<script type="text/javascript" src="core/basic/aplication.js"></script> 
	<style type="text/css">
	<!--
	body {background-image: url(core/resources/2Classic_Aqua_Blue.jpg);background-repeat: no-repeat;}
	-->
	</style>
	<?php
	//Ofuscador
  	require("core/modules/funciones/class.JavaScriptPacker.php");
	$header_in  = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="2%"  height="54" style="background-image:url(core/resources/header_sitenav_toggle.png)" ></td><td width="98%"  style="background-image:url(core/resources/header_bg.png)"  ><p><img src="core/resources/innosystem.gif" /><A HREF="?doLogout=true" ><img src="core/resources/building_go.png" /></a></p></td></tr></table>';
	//Detecta si existe SESSION, si no existe muestra el login, si existe muestra el Escritoriio
	if ((isset($_SESSION['Username'])) && ($_SESSION['Username'] != ""))
	{
		//Modulo Escritorio,Activa escritorio
		$escritorio_activo = "yes";
	}
	else
	{
		//Modulo Login
		include("core/modules/login.php");
		$escritorio_activo = "no";			
		echo $header_in.'</head><body ><div styel="padding: 5px 5px 5px 5px " align="center"><font color="#3366ff"><small><font face="tahoma">Para ingresar necesitas tener una cuenta con navegalo sms para entrar <a target="_blank" href="http://www.navegalo.com/id/index.php?option=com_community&amp;view=register&amp;Itemid=331&amp;lang=es" title="Regístrate Gratis">Regístrate gratis</a></font></small>
<small><font face="tahoma">Sistema de mensajeria celular gratis - La mensajeria sms gratis en costa rica.. puedes enviar mensajes de texto a cualquier celularm.. El <b>envio de sms gratis costa rica</b> lo brinda Innosystem</font></small></font></div>';
		include("core/modules/seo_analitycs.php");
		die('</body></html>');
	}
	?><?php
	//Activa escritorio si esta activo
	if ( $escritorio_activo == "yes")
	{
		//Genera los elementos del M.Escritorio		
		include("core/modules/escritorio.php");		
	}
	?>
 	</head>
<body >   
<?php echo $header_in; ?>
<div id="boxB" class="space" >
  <div class="iphone" >
  <div class="drag" onmousedown="dragStart(event, 'boxB')"></div>
  	<div class="contenido">
      	<div class="topbar"> 
        	<div class="time"> 
            <script type="text/javascript">  inicio(); </script>
  			</div>
  		</div>
      <div id="sms" class="mediumbar" 	style="display:none;"></div>
      <div id="agenda" class="mediumbar" style="display:none;"></div>
      <div id="clima" class="mediumbar" style="display:none;"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" id="portadaMap" align="middle"height="100%" width="100%">
<param name="allowScriptAccess" value="sameDomain">
<param name="movie" value="http://www.imn.ac.cr/images/portadaMap.swf">
<param name="menu" value="false">
<param name="quality" value="high">
<param name="scale" value="exactfit">
<param name="bgcolor" value="#ffffff">
<embed src="http://www.imn.ac.cr/images/portadaMap.swf" menu="false" quality="high" scale="exactfit" bgcolor="#ffffff" name="portadaMap" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" align="middle" height="100%" width="100%">
</object></div>
	<div id="reloj" class="mediumbar" style="display:none;"><embed style="" src="http://www.crearunaweb.net/complementos/reloj08.swf" wmode="transparent" type="application/x-shockwave-flash" height="90%" width="100%"><param name=wmode value=transparent /></embed>
</object></div>
	<div id="about" class="mediumbar" style="display:none;"><big><font color="#ffffff" face="Monotype Corsiva"><b>Desarrollado por InnoSystem - By James Jara  <A HREF="http://innosystem.isgreat.org/" target="_blank" >Visitar InnoSystem</a></b></font></big></div>
   	  <div id="mediumbar" class="mediumbar">         
        <A HREF="javascript:void(0);" onclick="javascript:document.getElementById('mediumbar').style.display='none';document.getElementById('sms').style.display='block';" ><img src="core/template/sms.png" /></a>
        <A HREF="javascript:void(0);" onclick="javascript:document.getElementById('mediumbar').style.display='none';document.getElementById('agenda').style.display='block';" ><img src="core/template/contactos.png" /></a>
       <A HREF="javascript:void(0);" onclick="javascript:document.getElementById('mediumbar').style.display='none';document.getElementById('clima').style.display='block';" ><img src="core/template/clima.png" /></a><br>
       <A HREF="javascript:void(0);" onclick="javascript:document.getElementById('mediumbar').style.display='none';document.getElementById('reloj').style.display='block';" ><img src="core/template/reloj.png" /></a>
       <A HREF="javascript:void(0);" onclick="javascript:document.getElementById('mediumbar').style.display='none';document.getElementById('about').style.display='block';" ><img src="core/template/calculator.png" /></a>
	  </div>
      	<div class="footbar">  
			<A HREF="javascript:void(0);" onclick="javascript:document.getElementById('sms').style.display='block';
            document.getElementById('mediumbar').style.display='none';            
            document.getElementById('agenda').style.display='none';
            document.getElementById('clima').style.display='none';
            document.getElementById('reloj').style.display='none';
            document.getElementById('about').style.display='none';" ><img src="core/template/foot-sms.gif" align="bottom" /></a>  
			<A HREF="javascript:void(0);" onclick="javascript:document.getElementById('agenda').style.display='block';
            document.getElementById('mediumbar').style.display='none';          				            document.getElementById('sms').style.display='none';
            document.getElementById('clima').style.display='none';
            document.getElementById('reloj').style.display='none';
            document.getElementById('about').style.display='none';
            " ><img src="core/template/foot-agenda.gif" align="bottom" /></a>  
  		</div>
  	</div>
    <div style="text-align:center;" >			
    		<A HREF="javascript:void(0);" onclick="javascript:document.getElementById('mediumbar').style.display='block';            				document.getElementById('sms').style.display='none';          document.getElementById('agenda').style.display='none';
document.getElementById('clima').style.display='none';
document.getElementById('about').style.display='none';
            document.getElementById('reloj').style.display='none';" ><img src="core/template/main.gif" align="bottom" /></a>  
	</div>
  </div>
  </div>
</div>
<?php include("core/modules/seo_analitycs.php"); ?>
</body>
</html>