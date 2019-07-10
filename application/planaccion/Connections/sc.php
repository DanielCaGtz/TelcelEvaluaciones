<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostnames= "localhost";
$databases = "ashmonts_school";
$usernames = "ashmonts_schoole";
$passwords = "eoRTHxrTP4";

$conexions = new mysqli($hostnames, $usernames, $passwords, $databases);
$conexions->set_charset("utf8");

$sc = mysql_connect($hostnames, $usernames, $passwords) or trigger_error(mysql_error(),E_USER_ERROR); 

#Seleccion de la base de datos a utilizar 
mysql_select_db($databases) or die("Error al tratar de selecccionar esta base"); 
?>

<?php
// ... conectar con MySQL aqui ....
// luego..

mysql_query("SET NAME 'utf8'");
mysql_query("SET CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'");

// si esto no ayuda entonces escribe esto:
// http://php.net/manual/es/function.mysql-set-charset.php

mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $sc);

?>
