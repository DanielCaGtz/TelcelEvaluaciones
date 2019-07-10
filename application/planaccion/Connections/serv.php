<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname= "mysql.hostinger.mx";
$database = "u465027285_tel";
$username = "u465027285_tel";
$password = "KUqAqSRN6ydb";

$serv = new mysqli($hostname, $username, $password, $database);
$serv->set_charset("utf8");

//$serv = mysql_connect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 

#Seleccion de la base de datos a utilizar 
//mysql_select_db($database) or die("Error al tratar de selecccionar esta base"); 
?>

<?php
// ... conectar con MySQL aqui ....
// luego..

//mysql_query("SET NAME 'utf8'");
//mysql_query("SET CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'");

// si esto no ayuda entonces escribe esto:
// http://php.net/manual/es/function.mysql-set-charset.php

//mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $serv);

?>
