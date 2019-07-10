<?php
ob_start();
include('./Connections/serv.php');



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

$mail = $_REQUEST['mail'];
$nombre = $_REQUEST['nombre'];


$sql = "insert into res_plan(id_usr,res_1_1,res_1_2,res_1_3,res_2_1,res_2_2,res_2_3,res_3_1,res_3_2,res_3_3,res_3_4,res_4_1,res_4_2,res_4_3) values('$id_usr','$res_1_1','$res_1_2','$res_1_3','$res_2_1','$res_2_2','$res_2_3','$res_3_1','$res_3_2','$res_3_3','$res_3_4','$res_4_1','$res_4_2','$res_4_3')";

//echo $sql;
$result= $serv->query($sql);




if ($result){
	
	

 $dest= $mail;
    #$dest="dani.daniel_@hotmail.com";
    #$dest="servinsan@gmail.com";
    $headers = "From: TELCEL Evaluaciones <planeacion@softandgo.com> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $subject="Plan de acción :: ".$nombre;
    
    $image = 'http://aljibescolegio.edu.mx/v2/img/logo.png';
    $message="<html><body style='background:#f2f2f2;display:block;font-family: 'Open Sans', Arial, sans-serif;font-size: 17px;font-weight: 300;line-height: 1.6em;color: #1f3682;'>";
    $message.='
<html>

<div align="center">
<div align="center" style="width:80%">
<img src="https://telcelevaluaciones.softandgo.com/img/logo.png" width="298" height="61">
</div>
<div align="center" style="background-color:#F5FBFB; width:80%"></div>
<h1><font face="Verdana, Geneva, sans-serif" color="#063D81" size="+2"> Plan de acción</font></h1>
<br><br>
<p> <font face="Verdana, Geneva, sans-serif" color="#999999" size="+1">El empleado '.$nombre.' ha completado su plan de acción. <br> Verlo</font> <font face="Verdana, Geneva, sans-serif" color="#65C3FF" size="+1"><a href="https://telcelevaluaciones.softandgo.com/application/planaccion/plan.php?id='.$id_usr.'"> Aquí</a></font> </p>
</div>
<div align="center" style="width:100%">
<br>
<img src="https://telcelevaluaciones.softandgo.com/img/new/footer_mail.jpg" width="976" height="88" >
</div>

';
    $message.="</body></html>";
    
    $result_mail=mail($dest, $subject, $message, $headers);
    if($result_mail) echo "<script language=\"javascript\">window.location=\"./exitoso.php?mail=$mail\"</script>;"; 

    else echo 'Message could not be sent.';
	
	
    
}
	


/*
require('../../plugins/PHPMailer-master/class.phpmailer.php');

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.hostinger.cmx';                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'planeacion@softandgo.com';                // SMTP username
$mail->Password = 'kA8Fcujjmt4b';                  // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'planeacion@softandgo.com';
$mail->FromName = 'TELCEL Evaluaciones';
//$mail->AddAddress($mail, '');  // Add a recipient
$mail->AddAddress($mail);               // Name is optional

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Plan de acción :: $nombre';
$mail->Body    = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
<div align="center">
<div align="center" style="width:80%">
<img src="https://telcelevaluaciones.softandgo.com/img/logo.png" width="298" height="61">
</div>
<div align="center" style="background-color:#F5FBFB; width:80%"></div>
<h1><font face="Verdana, Geneva, sans-serif" color="#063D81" size="+2"> Plan de acción</font></h1>
<br><br><br>
<p> <font face="Verdana, Geneva, sans-serif" color="#999999" size="+1">El empleado '.$nombre.' ha completado su plan de acción. Para verlo Dar click</font> <font face="Verdana, Geneva, sans-serif" color="#65C3FF" size="+1"><a href="https://telcelevaluaciones.softandgo.com/application/planaccion/plan.php?id='.$id_usr.'"> Aquí</a></font> </p>
</div>
<div align="center" style="width:100%">
<img src="https://telcelevaluaciones.softandgo.com/img/new/footer_mail.jpg" >
</div>
</body>
</html>
';
#$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
*/




	
	
	
	
/*	
	$strHTML = "https://telcelevaluaciones.softandgo.com/application/planaccion/plan.php?id=$id_usr"; 


	// HTML to PDF in PHP
	// ejemplo de utilizaci�n de la clase dompdf
	// http://www.parentesys.com

				// generamos PDF
				require_once("./dompdf-0.5.1/dompdf_config.inc.php");
				
				$dompdf = new DOMPDF();
				$dompdf->set_paper('legal', 'portrait');
				$dompdf->load_html_file($strHTML);
				$dompdf->render();
				$dompdf->stream("Plan_Accion.pdf");
				exit(0);
	
	//}
	//echo json_encode(array('success'=>true));
*/
	//echo "<script language=\"javascript\">window.location=\"https://telcelevaluaciones.softandgo.com/application/planaccion/plan.php?id=$id_usr\"</script>;"; 

?>