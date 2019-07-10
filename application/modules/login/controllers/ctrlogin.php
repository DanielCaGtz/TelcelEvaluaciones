<?php

class ctrLogin extends MX_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('mdllogin');
		date_default_timezone_set('America/Mexico_City');
	}

	public function index(){
		$data["controller"]=Modules::run("home/ctrhome/get_self");
		if($this->session->userdata("id")){
			redirect("home");
		}else{
			print $this->load->view("vwlogin",$data,TRUE);
		}
	}

	private function get_data($select="",$from="",$where="",$order="",$group="",$limit=""){
		return $this->mdllogin->getData($select,$from,$where,$order,$group,$limit);
	}

	public function login(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$params = array();
		parse_str($data, $params);
		$data_login=$this->mdllogin->check_login($params["email"],$params["pwd"],$params["clave"]);
		if($data_login!==FALSE){
			$continue=FALSE;
			if(strlen($data_login[0]["date_end"])==0){
				if(intval($data_login[0]["idPermisos"])>0) $continue=TRUE;
				if($params["clave"]==$data_login[0]["clave"] || $continue){
					if($data_login[0]["date_from"] == date('Y-m-d')){
						$continue=TRUE;
						$temp_pre=$this->mdllogin->getDataFromQuery("SELECT * FROM log_historial WHERE idUsuario='".$data_login[0]["id"]."' AND pre_post=0 AND idCuestionario=(SELECT id FROM cuestionarios WHERE clave='".$params["clave"]."') AND date_end IS NULL AND id IN (SELECT DISTINCT idLog FROM historial_preguntas); ");
						if($temp_pre!==FALSE){
							$date1 = new DateTime($temp_pre[0]["date_start"]);
							$date2 = new DateTime(date('Y-m-d H:i:s'));
							$diff = $date2->diff($date1);
							$hours = $diff->h;
							$hours = $hours + ($diff->days*24);
							if(intval($hours)>2){
								$continue=FALSE;
								//BLOCKED AFTER 3 HOURS FROM PRE STARTED
								print json_encode(array("success"=>FALSE,"type_msg"=>"warning","title"=>"Error","msg"=>"<h4>CUESTIONARIO PRE FINALIZADO</h4>Has finalizado tu cuestionario PRE, regresa mañana para realizar el POST."));
								return;
							}

							if(intval(date('H'))>13){
								$continue=FALSE;
								//BLOCKED AFTER 13:59
								print json_encode(array("success"=>FALSE,"type_msg"=>"warning","title"=>"Error","msg"=>"<h4>CUESTIONARIO PRE FINALIZADO</h4>Ha finalizado el tiempo para realizar y consultar el cuestionario PRE. Vuelve mañana para realizar el POST."));
								return;
							}
						}
					}elseif($data_login[0]["date_to"] == date('Y-m-d')){
						$continue=TRUE;
						#$temp_post=$this->mdllogin->getDataFromQuery("SELECT * FROM log_historial WHERE idUsuario='".$data_login[0]["id"]."' AND pre_post=1 AND idCuestionario=(SELECT id FROM cuestionarios WHERE clave='".$params["clave"]."') AND date_end IS NULL AND id IN (SELECT DISTINCT idLog FROM historial_preguntas); ");
						#if($temp_post!==FALSE){
							if(intval(date('H'))>19){
							#if(0){
								$continue=FALSE;
								//BLOCKED AFTER 19:59
								print json_encode(array("success"=>FALSE,"type_msg"=>"warning","title"=>"Error","msg"=>"<h4>CUESTIONARIO POST FINALIZADO</h4>Ha finalizado el tiempo para realizar y consultar el cuestionario POST. ¡Gracias por participar!"));
								return;
							}

							if(intval(date('H'))<15){
								$continue=FALSE;
								//BLOCKED BEFORE 15:00
								print json_encode(array("success"=>FALSE,"type_msg"=>"warning","title"=>"Error","msg"=>"<h4>EL CUESTIONARIO POST NO HA INICIADO</h4>Aún no es la hora de inicio. Intenta más tarde o consulta tu acceso con tu instructor."));
								return;
							}
						#}
					}
					if($continue){
						if(array_key_exists("remember",$params)){
							$sess['new_expiration'] = 60*60*24*30;//30 day(s)
							$this->session->sess_expiration = $sess['new_expiration'];
							$this->session->set_userdata($sess);
						}
						$this->session->set_userdata("data_temp",array());
						$this->session->set_userdata("current_test",0);
						$this->session->set_userdata($data_login[0]);
						print json_encode(array("success"=>TRUE,"type_msg"=>"success","title"=>"Éxito","msg"=>"Sesión iniciada correctamente."));
					}else{
						//NO COURSE DAY
						print json_encode(array("success"=>FALSE,"type_msg"=>"warning","title"=>"Error","msg"=>"<h4>GRUPO FUERA DE FECHA</h4>Si tu grupo aún no empieza o ya ha finalizado, no podrás iniciar sesión. Contacta a tu instructor para más información."));
					}
				}else//CURSO INCORRECTO
					print json_encode(array("success"=>FALSE,"type_msg"=>"danger","title"=>"Alerta","msg"=>"<h4>CURSO INCORRECTO</h4>El usuario no está dado de alta con el curso seleccionado. Consulta tu curso asignado con tu Instructor."));
			}else//USUARIO DESACTIVADO
				print json_encode(array("success"=>FALSE,"type_msg"=>"warning","title"=>"Alerta","msg"=>"<h4>USUARIO DESACTIVADO</h4>Consulta con tu instructor para más información."));
		}else //NO USUARIO
			print json_encode(array("success"=>FALSE,"type_msg"=>"danger","title"=>"Error","msg"=>"<h4>DATOS DE INGRESO INCORRECTOS</h4>Favor de verificar que el número de empleado y/o la contraseña sean válidos."));
	}

	public function signup(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$params = array();
		parse_str($data, $params);
		$params["clave"]=$this->security->xss_clean($this->input->post("clave"));
		$data_login=$this->mdllogin->check_email_existence($params["numero"]);
		if($data_login===FALSE){
			$params["pwd"]=hash('sha512',$params["pwd"]);
			$params["date_start"]=date('Y-m-d H:i:s');
			unset($params["curso"]);
			unset($params["despacho"]);
			$params["idInstructor"]=$params["instructor"];
			unset($params["instructor"]);
			$params["idGrupo"]=$params["grupos"];
			$params["codigo"]=$this->get_data("nombre","grupos","id='".$params["idGrupo"]."'")[0]["nombre"];
			unset($params["grupos"]);
			$params["nombre"]=strtoupper($params["nombre_1"])." ".strtoupper($params["nombre_2"])." ".strtoupper($params["nombre_3"]);
			unset($params["nombre_1"]);
			unset($params["nombre_2"]);
			unset($params["nombre_3"]);
			if(array_key_exists("remember",$params)){ $rem=TRUE; unset($params["remember"]); } else $rem=FALSE;
			$insert_id=$this->mdllogin->insertData($params,"usuarios");
			if(intval($insert_id)>0){
				$data_login_id=$this->mdllogin->check_login_by_id($insert_id);
				if($data_login_id!==FALSE){
					if($rem){
						$sess['new_expiration'] = 60*60*24*30;//30 day(s)
        				$this->session->sess_expiration = $sess['new_expiration'];
        				$this->session->set_userdata($sess);
					}
					$this->session->set_userdata("data_temp",array());
					$this->session->set_userdata($data_login_id[0]);
					print json_encode(array("success"=>TRUE,"type_msg"=>"success","title"=>"Éxito","msg"=>"Usuario registrado correctamente."));
				}else print json_encode(array("success"=>FALSE,"type_msg"=>"danger","title"=>"Error","msg"=>"Hubo un error con el usuario. Favor de intentar más tarde."));
			}else print json_encode(array("success"=>FALSE,"type_msg"=>"danger","title"=>"Error","msg"=>"Hubo un error. Favor de intentar más tarde."));
		}else print json_encode(array("success"=>FALSE,"type_msg"=>"warning","title"=>"Alerta","msg"=>"El número de empelado ingresado ya se encuentra registrado. Favor de iniciar sesión o verificar sus datos."));
	}

	public function forgot_password(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$data_login=$this->mdllogin->check_email_existence($params["email"]);
	}
}

?>