<?php
include('./Connections/serv.php');

/*
$id_usr = $_REQUEST['id'];
$res_1_1 = $_REQUEST['res_1_1'];
$res_1_2 = $_REQUEST['res_1_2'];
$res_1_3 = $_REQUEST['res_1_3'];

$res_2_1 = $_REQUEST['res_2_1'];
$res_2_2 = $_REQUEST['res_2_2'];
$res_2_3 = $_REQUEST['res_2_3'];

$res_3_1 = $_REQUEST['res_3_1'];
$res_3_2 = $_REQUEST['res_3_2'];
$res_3_3 = $_REQUEST['res_3_3'];
$res_3_4 = $_REQUEST['res_3_4'];

$res_4_1 = $_REQUEST['res_4_1'];
$res_4_2 = $_REQUEST['res_4_2'];
$res_4_3 = $_REQUEST['res_4_3'];
*/
/*$ss="CREATE TABLE `res_plan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_usr` char(200) NOT NULL,
  `res_1_1` char(20) NOT NULL,
  `res_1_2` char(20) NOT NULL,
  `res_1_3` char(20) NOT NULL,
  `res_2_1` char(20) NOT NULL,
  `res_2_2` char(20) NOT NULL,
  `res_2_3` char(20) NOT NULL,
  `res_3_1` char(20) NOT NULL,
  `res_3_2` char(20) NOT NULL,
  `res_3_3` char(20) NOT NULL,
  `res_3_4` char(20) NOT NULL,
  `res_4_1` char(20) NOT NULL,
  `res_4_2` char(20) NOT NULL,
  `res_4_3` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
*/
/*$sql = "insert into res_plan(id_usr,res_1_1,res_1_2,res_1_3,res_2_1,res_2_2,res_2_3,res_3_1,res_3_2,res_3_3,res_3_4,res_4_1,res_4_2,res_4_3) values('$id_usr','$res_1_1','$res_1_2','$res_1_3','$res_2_1','$res_2_2','$res_2_3','$res_3_1','$res_3_2','$res_3_3','$res_3_4','$res_4_1','$res_4_2','$res_4_3')";
$result= $serv->query($sql);
*/

$ss="select count(*) from res_plan";

echo $ss;

$result= $serv->query($ss);
if ($result){
	//echo json_encode(array('success'=>true));
	echo "Exito!!";
	//echo "<script language=\"javascript\">window.location=\"../usuarios/correcto.php\"</script>;"; 
} else {
    echo "Errorr...";
	//echo json_encode(array('msg'=>'Ocurrieron algunos errores.'));
	//echo "<script language=\"javascript\">window.location=\"../usuarios/error_update.php?id=$id\"</script>;"; 
}
?>