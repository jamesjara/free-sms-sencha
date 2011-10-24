<?php
//Funciones de M.Login
include("funciones/module-login.php");

create_login(
//Unique ID
'abc',
//Url conection WS
'core/Store/service.php?xaction=1',
//Title form login
'Acceso al Iphone',
//Image
'http://i209.photobucket.com/albums/bb146/jamesjara/innosystem.png',
//Username field title
'Usuario',
//msg empty field Username
'No puedes dejar el usuario vacio',
//Password field title
'Password' ,
//msg empty field Password
'El password es obligatorio',
//Login Button title
'Entrar',
//Wait title
'Espere...',
//Wait msg
'Conectando...',
//Success login title
'Bievenido al sistema',
//Success login msh
'Felicidades!',
//page success ok
'index.php',
//error login title
'Ups!',
//error login msg
'A ocurrido un error',
//error login title2
'Ups!',
//error login msg2
'Tus datos no son correctos',
//DEBUG?
'false'
)
?>