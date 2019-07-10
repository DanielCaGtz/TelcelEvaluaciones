<?php

class ctrHome extends MX_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('login/mdllogin');
		date_default_timezone_set('America/Mexico_City');
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel.php";
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel/Writer/Excel2007.php";
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel/IOFactory.php";
	}

	public function index(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data_user=$this->get_data("clave","usuarios","id='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			if($permisos!==FALSE){
				#if(intval($permisos[0]["idAdmin"])>0){
					$data["scripts"]=FALSE;
					print $this->load->view("vwheader_admin",$data,TRUE);
					print $this->load->view("vwaside_admin",$data,TRUE);
					print $this->load->view("vwhome_admin",$data,TRUE);
					print $this->load->view("vwfooter_admin",$data,TRUE);
					print $this->load->view("vwsidebar_admin",$data,TRUE);
					return 0;
				#}
			}
			if($data_user!==FALSE){
				if($data_user[0]["clave"]==CLAVE_RECONSTRUYE){
					print $this->load->view("vwhome_v2",$data,TRUE);
					return 0;
				}
			}
			print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function tests(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function carga_grupos(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$data["carga_usuarios"]=FALSE;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			if($permisos!==FALSE){
				#if(intval($permisos[0]["idDespacho"])==0 && intval($permisos[0]["idInstructor"])==0){
					$data["scripts"]=array("0" => base_url("js/cargas.js"));
					print $this->load->view("vwheader_admin",$data,TRUE);
					print $this->load->view("vwaside_admin",$data,TRUE);
					print $this->load->view("vwcargagrupos_admin",$data,TRUE);
					print $this->load->view("vwfooter_admin",$data,TRUE);
					print $this->load->view("vwsidebar_admin_fix",$data,TRUE);
					return 0;
				#}else redirect(base_url());
			}
			print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function carga_usuarios(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$data["carga_usuarios"]=FALSE;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			if($permisos!==FALSE){
				#if(intval($permisos[0]["idDespacho"])==0 && intval($permisos[0]["idInstructor"])==0){
					$data["scripts"]=array("0" => base_url("js/cargas.js"));
					print $this->load->view("vwheader_admin",$data,TRUE);
					print $this->load->view("vwaside_admin",$data,TRUE);
					print $this->load->view("vwcargausuarios_admin",$data,TRUE);
					print $this->load->view("vwfooter_admin",$data,TRUE);
					print $this->load->view("vwsidebar_admin_fix",$data,TRUE);
					return 0;
				#}else redirect(base_url());
			}
			print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function carga_instructores(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$data["carga_usuarios"]=FALSE;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			if($permisos!==FALSE){
				if(intval($permisos[0]["idInstructor"])==0){
					$data["scripts"]=array("0" => base_url("js/cargas.js"));
					print $this->load->view("vwheader_admin",$data,TRUE);
					print $this->load->view("vwaside_admin",$data,TRUE);
					print $this->load->view("vwcargainstructores_admin",$data,TRUE);
					print $this->load->view("vwfooter_admin",$data,TRUE);
					print $this->load->view("vwsidebar_admin_fix",$data,TRUE);
					return 0;
				}else redirect(base_url());
			}
			print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function carga_calificaciones(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$data["carga_usuarios"]=FALSE;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			if($permisos!==FALSE){
				#if(intval($permisos[0]["idDespacho"])==0 && intval($permisos[0]["idInstructor"])==0){
					$data["scripts"]=array("0" => base_url("js/cargas.js"));
					print $this->load->view("vwheader_admin",$data,TRUE);
					print $this->load->view("vwaside_admin",$data,TRUE);
					print $this->load->view("vwcargacalif_admin",$data,TRUE);
					print $this->load->view("vwfooter_admin",$data,TRUE);
					print $this->load->view("vwsidebar_admin_fix",$data,TRUE);
					return 0;
				#}else redirect(base_url());
			}
			print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function admon_usuarios(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$data["carga_usuarios"]=TRUE;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			if($permisos!==FALSE){
				#if(intval($permisos[0]["idAdmin"])>0){
					$data["scripts"]=array("0" => base_url("js/cargas.js"));
					print $this->load->view("vwheader_admin",$data,TRUE);
					print $this->load->view("vwaside_admin",$data,TRUE);
					print $this->load->view("vwusuarios_admin",$data,TRUE);
					print $this->load->view("vwfooter_admin",$data,TRUE);
					print $this->load->view("vwsidebar_admin_fix",$data,TRUE);
					return 0;
				#}
			}
			#print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function admon_grupos(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$data["carga_usuarios"]=TRUE;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			if($permisos!==FALSE){
				#if(intval($permisos[0]["idAdmin"])>0){
					$data["scripts"]=array("0" => base_url("js/cargas.js"));
					print $this->load->view("vwheader_admin",$data,TRUE);
					print $this->load->view("vwaside_admin",$data,TRUE);
					print $this->load->view("vwgrupos_admin",$data,TRUE);
					print $this->load->view("vwfooter_admin",$data,TRUE);
					print $this->load->view("vwsidebar_admin_grupos",$data,TRUE);
					return 0;
				#}
			}
			#print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function get_self(){return $this;}

	public function get_data($select="",$from="",$where="",$order="",$group="",$limit=""){
		return $this->mdllogin->getData($select,$from,$where,$order,$group,$limit);
	}

	public function get_despachos(){
		$id=$this->security->xss_clean($this->input->post("id"));
		print json_encode(array("success"=>TRUE,"result"=>$this->get_data_from_query("SELECT * FROM despachos WHERE idCurso='$id' ORDER BY nombre ASC")));
	}

	public function get_instructores(){
		$id=$this->security->xss_clean($this->input->post("id"));
		print json_encode(array("success"=>TRUE,"result"=>$this->get_data_from_query("SELECT * FROM instructores WHERE idDespacho='$id' ORDER BY nombre ASC")));
	}

	public function get_grupos(){
		$id=$this->security->xss_clean($this->input->post("id"));
		$date_now=date('Y-m-d H:i:s');
		$query="SELECT * FROM grupos WHERE idInstructor='$id' AND DATE('$date_now') BETWEEN date_from AND date_to ORDER BY nombre ASC";
		print json_encode(array("success"=>TRUE,"result"=>$this->get_data_from_query($query)));
	}

	public function check_user_quests(){
		$id=$this->security->xss_clean($this->input->post("id"));
		$idQuest=$this->security->xss_clean($this->input->post("idQuest"));
		$data_pre=$this->get_data_from_query("SELECT COUNT(*) AS num FROM log_historial WHERE idCuestionario='$idQuest' AND idUsuario='$id' AND id IN (SELECT DISTINCT idLog FROM historial_preguntas) AND date_end IS NULL");
		print json_encode(array("num"=>$data_pre[0]["num"]));
	}

	public function check_user_quests_admin(){
		$id=$this->security->xss_clean($this->input->post("id"));
		$idQuest=$this->security->xss_clean($this->input->post("idQuest"));
		$data_pre=$this->get_data_from_query("SELECT COUNT(*) AS num FROM log_historial WHERE idCuestionario='$idQuest' AND idAdmin='$id' AND date_end IS NULL");
		print json_encode(array("num"=>$data_pre[0]["num"]));
	}

	public function get_data_from_query($query){
		return $this->mdllogin->getDataFromQuery($query);
	}

	public function start_quest_admin($id_new){
		$id=explode("A",$id_new)[0];
		$data["user"]=explode("A",$id_new)[1];
		$data["controller"]=$this;
		$data["id_cuestionario"]=$id;
		$data_quest=$this->get_data("is_new, nombre","cuestionarios","id='$id'","","","");
		$data["nombre_cuestionario"]=$data_quest[0]["nombre"];
		$data["is_view"]=FALSE;
		$data["data_temp"]=$this->session->userdata("data_temp");
		print $this->load->view("vwheader_admin_quest",$data,TRUE);
		if(intval($data_quest[0]["is_new"])>0) print $this->load->view("vwquest_admin_v2",$data,TRUE);
		else print $this->load->view("vwquest_admin",$data,TRUE);
		print $this->load->view("vwfooter",$data,TRUE);
	}

	public function view_quest_admin($id_new){
		$id=explode("A",$id_new)[0];
		$id_user=explode("A",$id_new)[1];
		$data["user"]=$id_user;
		$data["controller"]=$this;
		$data["id_cuestionario"]=$id;
		$data_quest=$this->get_data("is_new, nombre","cuestionarios","id='$id'","","","");
		$data["nombre_cuestionario"]=$data_quest[0]["nombre"];
		$data["is_view"]=TRUE;
		$data["id_log"]=$this->get_data("id","log_historial","idCuestionario='$id' AND idUsuario='$id_user' AND date_end IS NULL","id ASC","","1")[0]["id"];
		print $this->load->view("vwheader_admin_quest",$data,TRUE);
		if(intval($data_quest[0]["is_new"])>0) print $this->load->view("vwquest_admin_v2",$data,TRUE);
		else print $this->load->view("vwquest_admin",$data,TRUE);
		print $this->load->view("vwfooter",$data,TRUE);
	}

	public function save_quest_admin(){
		$idCuestionario=$this->security->xss_clean($this->input->post("id"));
		$id_user=$this->security->xss_clean($this->input->post("id_user"));
		$data=$this->security->xss_clean($this->input->post("data"));
		$query="SELECT id FROM log_historial WHERE idCuestionario='$idCuestionario' AND idUsuario='".$this->session->userdata("id")."' AND date_end IS NULL;";
		$insert_one=$this->get_data_from_query($query);
		if($insert_one==FALSE){
			$log_historial=array(
				"idCuestionario"=> $idCuestionario,
				"idUsuario"		=> $id_user,
				"idAdmin"		=> $this->session->userdata("id"),
				"date_start"	=> date('Y-m-d H:i:s'),
				"pre_post"		=> 0
			);
			$logID=$this->mdllogin->insertData($log_historial,"log_historial");
			if(intval($logID)>0){
				foreach($data AS $e=>$key){
					$temp=array(
						"idPregunta"	=> $key["idPregunta"],
						"idRespuesta"	=> intval($key["idRespuesta"]),
						"idUsuario"		=> $this->session->userdata("id"),
						"idLog"			=> $logID
						//"observaciones"	=> $key["observaciones"]
					);
					$this->mdllogin->insertData($temp,"historial_preguntas");
				}
				$this->session->set_userdata("data_temp",array());
				print json_encode(array("success"=>TRUE));
			}else print json_encode(array("success"=>FALSE,"msg"=>"Hubo un error. Favor de intentar más tarde."));
		}else print json_encode(array("success"=>TRUE));
	}

	public function save_quest(){
		$idCuestionario=$this->security->xss_clean($this->input->post("id"));
		$data=$this->security->xss_clean($this->input->post("data"));
		
		$query="SELECT id FROM log_historial WHERE idCuestionario='$idCuestionario' AND idUsuario='".$this->session->userdata("id")."' AND id NOT IN (SELECT DISTINCT idLog FROM historial_preguntas);";
		#echo $query;
		$insert_one=$this->get_data_from_query($query);
		if($insert_one!==FALSE){
			$insert_one=$insert_one[0]["id"];
			foreach($data AS $e=>$key){
				$temp=array(
					"idPregunta"	=> $key["idPregunta"],
					"idRespuesta"	=> intval($key["idRespuesta"]),
					"idUsuario"		=> $this->session->userdata("id"),
					"idLog"			=> $insert_one
				);
				$this->mdllogin->insertData($temp,"historial_preguntas");
			}
			$this->session->set_userdata("data_temp",array());
			print json_encode(array("success"=>TRUE));
		}else print json_encode(array("success"=>FALSE,"msg"=>"Hubo un error en la base de datos. Intente de nuevo más tarde."));
	}

	public function save_pregunta_temp(){
		$id=$this->security->xss_clean($this->input->post("id"));
		$parent=$this->security->xss_clean($this->input->post("parent"));
		$temp=$this->session->userdata("data_temp");
		if(array_key_exists("P$parent",$temp)) unset($temp["P$parent"]);
		$temp=array_merge($temp,array("P$parent"=>$id));
		$this->session->set_userdata("data_temp",$temp);
	}

	public function start_quest($id_new){
		if($this->session->userdata("id")){
			$id=explode("A",$id_new)[0];
			$user=explode("A",$id_new)[1];
			$data["user"]=$user;
			$data["controller"]=$this;
			$data["id_cuestionario"]=$id;
			$data["nombre_cuestionario"]=$this->get_data("nombre","cuestionarios","id='$id'","","","")[0]["nombre"];
			$data["is_view"]=FALSE;
			$data["data_temp"]=$this->session->userdata("data_temp");

			$data_grupos=$this->get_data("date_from, date_to","grupos","id='".$this->session->userdata("idGrupo")."'");

			$result=$this->get_data_from_query("SELECT id, date_start, pre_post FROM log_historial WHERE idCuestionario='$id' AND idUsuario='".$this->session->userdata("id")."' AND id NOT IN (SELECT DISTINCT idLog FROM historial_preguntas);");
			if($result!==FALSE){//PENDING QUEST
				$timeFirst  = strtotime(date('Y-m-d H:i:s'));
				$timeSecond = strtotime($result[0]["date_start"]);
				$diff = $timeFirst - $timeSecond;
				$data["actual_time"]=900-$diff;
				$data["insert_one"]=$result[0]["id"];
				if($diff>=900){
					foreach($this->get_data("*","preguntas","idCuestionario='$id'") AS $e=>$key){
						$temp=array(
							"idPregunta"	=> $key["id"],
							"idRespuesta"	=> 0,
							"idUsuario"		=> $this->session->userdata("id"),
							"idLog"			=> $result[0]["id"]
						);
						$this->mdllogin->insertData($temp,"historial_preguntas");
					}
					$this->session->set_userdata("data_temp",array());
					redirect(base_url());
				}
			}else{
				$exists=0;
				$p=$this->get_data_from_query("SELECT pre_post FROM log_historial WHERE idCuestionario='$id' AND idUsuario='".$this->session->userdata("id")."' AND date_end IS NULL;");
				if($p!==FALSE){
					if(intval($p[0]["pre_post"])===0) $exists=1;
					elseif(intval($p[0]["pre_post"])>1) $exists=2;
				}
				if((intval($exists)===0 && date('Y-m-d')==$data_grupos[0]["date_from"]) || (intval($exists)===1 && date('Y-m-d')==$data_grupos[0]["date_to"])){
					$log_historial=array(
						"idCuestionario"=> $id,
						"idUsuario"		=> $this->session->userdata("id"),
						"date_start"	=> date('Y-m-d H:i:s'),
						"pre_post"		=> $exists
					);
					$data["insert_one"]=$this->mdllogin->insertData($log_historial,"log_historial");
					$data["actual_time"]=900;
				}else redirect(base_url());
			}
			if(date('Y-m-d')!=$data_grupos[0]["date_from"] && date('Y-m-d')!=$data_grupos[0]["date_to"]) redirect(base_url());
			else{
				print $this->load->view("vwheader",$data,TRUE);
				print $this->load->view("vwquest",$data,TRUE);
				print $this->load->view("vwfooter",$data,TRUE);
			}
		}else redirect(base_url());
	}

	public function view_quest_pre($id_new){
		$id=explode("A",$id_new)[0];
		$id_user=explode("A",$id_new)[1];
		$data["user"]=$id_user;
		$data["controller"]=$this;
		$data["id_cuestionario"]=$id;
		$data["nombre_cuestionario"]=$this->get_data("nombre","cuestionarios","id='$id'","","","")[0]["nombre"];
		$data["is_view"]=TRUE;
		$data["actual_time"]=900;
		$data["id_log"]=$this->get_data("id","log_historial","idCuestionario='$id' AND idUsuario='$id_user' AND date_end IS NULL","id ASC","","1")[0]["id"];
		print $this->load->view("vwheader",$data,TRUE);
		print $this->load->view("vwquest",$data,TRUE);
		print $this->load->view("vwfooter",$data,TRUE);
	}

	public function view_quest_post($id_new){
		$id=explode("A",$id_new)[0];
		$id_user=explode("A",$id_new)[1];
		$data["user"]=$id_user;
		$data["controller"]=$this;
		$data["id_cuestionario"]=$id;
		$data["nombre_cuestionario"]=$this->get_data("nombre","cuestionarios","id='$id'","","","")[0]["nombre"];
		$data["is_view"]=TRUE;
		$data["actual_time"]=900;
		$data["id_log"]=$this->get_data("id","log_historial","idCuestionario='$id' AND idUsuario='$id_user' AND date_end IS NULL","id DESC","","1")[0]["id"];
		print $this->load->view("vwheader",$data,TRUE);
		print $this->load->view("vwquest",$data,TRUE);
		print $this->load->view("vwfooter",$data,TRUE);
	}

	public function graficar(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$data["carga_usuarios"]=TRUE;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"]=$permisos;
			if($permisos!==FALSE){
				#if(intval($permisos[0]["idAdmin"])>0){
					$data["scripts"]=array("0" => base_url("js/cargas.js"));
					print $this->load->view("vwheader_admin",$data,TRUE);
					print $this->load->view("vwaside_admin",$data,TRUE);
					print $this->load->view("vwhome_graph_new",$data,TRUE);
					print $this->load->view("vwfooter_admin",$data,TRUE);
					print $this->load->view("vwsidebar_admin_graph",$data,TRUE);
					return 0;
				#}
			}else redirect(base_url());
			#print $this->load->view("vwhome",$data,TRUE);
		}else redirect(base_url());
	}

	public function get_graph_data(){
		if($this->session->userdata("id") && $this->session->userdata("graph_type") && intval($this->session->userdata("graph_primer"))>0){
			switch(intval($this->session->userdata("graph_type"))){
				/***********************************************************/
				case 1:
					$result=array("success"=>TRUE);
					if(intval($this->session->userdata("graph_quest_type"))>0) $sub="Calificación"; else $sub="Aciertos";
					$result=array_merge($result,array("title"=>"GRÁFICA COMPARATIVA DE USUARIOS"));
					$data_first=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=ppal.clave) AS nombre_quest, (SELECT id FROM cuestionarios WHERE clave=ppal.clave) AS id_quest FROM usuarios AS ppal WHERE ppal.id='".$this->session->userdata("graph_primer")."'")[0];

					if($data_first["clave"]==CLAVE_AVENTURA) $protocolo_s=TRUE;
					else $protocolo_s=FALSE;

					$result=array_merge($result,array("type_main"=>'column'));
					$result=array_merge($result,array("categories"=>array($sub)));

					$data_main=array();
					$aciertos=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog=(SELECT id FROM log_historial WHERE idUsuario='".$data_first["id"]."' AND idCuestionario='".$data_first["id_quest"]."' AND pre_post='".intval($this->session->userdata("graph_pre_post"))."' LIMIT 1) AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0]["num"];
					if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0){
						$totales=$this->get_data("COUNT(*) AS num","preguntas","idCuestionario='".$data_first["id_quest"]."'")[0]["num"];
						$aciertos=floatval($aciertos)*10/floatval($totales);
					}
					array_push($data_main,array("name"=>$data_first["nombre"], "data"=>array(floatval($aciertos))));

					if(intval($this->session->userdata("graph_segundo"))>0){
						$data_second=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=ppal.clave) AS nombre_quest, (SELECT id FROM cuestionarios WHERE clave=ppal.clave) AS id_quest FROM usuarios AS ppal WHERE ppal.id='".$this->session->userdata("graph_segundo")."'")[0];
						if($protocolo_s && $data_second["clave"]==CLAVE_AVENTURA) $protocolo_s=TRUE;
						else $protocolo_s=FALSE;
						$aciertos=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog=(SELECT id FROM log_historial WHERE idUsuario='".$data_second["id"]."' AND idCuestionario='".$data_second["id_quest"]."' AND pre_post='".intval($this->session->userdata("graph_pre_post"))."' LIMIT 1) AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0]["num"];
						if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0){
							$totales=$this->get_data("COUNT(*) AS num","preguntas","idCuestionario='".$data_second["id_quest"]."'")[0]["num"];
							$aciertos=floatval($aciertos)*10/floatval($totales);
						}
						array_push($data_main,array("name"=>$data_second["nombre"], "data"=>array(floatval($aciertos))));
					}

					if(intval($this->session->userdata("graph_pre_post"))>0) $sub.=" POST"; else $sub.=" PRE";
					$result=array_merge($result,array("subtitle"=>$sub));
					$result=array_merge($result,array("data_main"=>$data_main));

					$result=array_merge($result,array("protocolo_success"=>$protocolo_s));
					if($protocolo_s){
						$result=array_merge($result,array("protocolo_title"=>"GRÁFICA COMPARATIVA DE USUARIOS (PROTOCOLO)"));
						$data_first=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=ppal.clave) AS nombre_quest, (SELECT id FROM cuestionarios WHERE clave=ppal.clave) AS id_quest FROM usuarios AS ppal WHERE ppal.id='".$this->session->userdata("graph_primer")."'")[0];
						$result=array_merge($result,array("protocolo_type_main"=>'column'));
						$result=array_merge($result,array("protocolo_categories"=>array("Resultados")));
						$data_main=array();
						$aciertos=$this->get_data_from_query("SELECT COALESCE(SUM(idRespuesta),0) AS tot FROM historial_preguntas WHERE idLog=(SELECT id FROM log_historial WHERE idAdmin='".$data_first["id"]."' AND idCuestionario='4' LIMIT 1);")[0]["tot"];
						array_push($data_main,array("name"=>$data_first["nombre"], "data"=>array(floatval($aciertos)), "color"=> '#10bf97'));
						if(intval($this->session->userdata("graph_segundo"))>0){
							$data_second=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=ppal.clave) AS nombre_quest, (SELECT id FROM cuestionarios WHERE clave=ppal.clave) AS id_quest FROM usuarios AS ppal WHERE ppal.id='".$this->session->userdata("graph_segundo")."'")[0];
							$aciertos=$this->get_data_from_query("SELECT COALESCE(SUM(idRespuesta),0) AS tot FROM historial_preguntas WHERE idLog=(SELECT id FROM log_historial WHERE idAdmin='".$data_second["id"]."' AND idCuestionario='4' LIMIT 1);")[0]["tot"];
							array_push($data_main,array("name"=>$data_second["nombre"], "data"=>array(floatval($aciertos)), "color"=> '#fbb49a'));
						}
						$result=array_merge($result,array("protocolo_subtitle"=>"Resultados Protocolo"));
						$result=array_merge($result,array("protocolo_data_main"=>$data_main));
					}

					print json_encode($result);
				break;
				/***********************************************************/
				case 2:
					$result=array("success"=>TRUE);
					if(intval($this->session->userdata("graph_quest_type"))>0) $sub="Calificación Promedio"; else $sub="Aciertos Promedio";
					$result=array_merge($result,array("title"=>"GRÁFICA COMPARATIVA DE GRUPOS"));
					$data_first=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS nombre_quest, (SELECT clave FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS clave_quest, (SELECT id FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS id_quest FROM grupos AS ppal WHERE ppal.id='".$this->session->userdata("graph_primer")."'")[0];

					if($data_first["clave_quest"]==CLAVE_AVENTURA) $protocolo_s=TRUE;
					else $protocolo_s=FALSE;

					$result=array_merge($result,array("type_main"=>'column'));
					$result=array_merge($result,array("categories"=>array($sub)));

					$fecha_inicio=$this->session->userdata("graph_date_start");
					$fecha_fin=$this->session->userdata("graph_date_end");
					$filtro_fecha="";
					if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" AND DATE(date_start) >= '$fecha_inicio'";
					elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(date_start) <= '$fecha_fin'";
					elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";

					$data_main=array();
					$query="SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='".$data_first["id"]."' $filtro_fecha ) $filtro_fecha AND idCuestionario='".$data_first["id_quest"]."' AND pre_post='".intval($this->session->userdata("graph_pre_post"))."') AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1) GROUP BY idUsuario;";
					$totales=$this->get_data_from_query($query);
					$aciertos=0;
					$x=0;
					if($totales!==FALSE)foreach($totales AS $e=>$key){$aciertos+=intval($key["num"]);$x++;}
					if(intval($aciertos)>0) $aciertos=floatval($aciertos/$x);
					if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0){
						$totales=$this->get_data("COUNT(*) AS num","preguntas","idCuestionario='".$data_first["id_quest"]."'")[0]["num"];
						$aciertos=floatval($aciertos)*10/floatval($totales);
					}
					array_push($data_main,array("name"=>$data_first["nombre"], "data"=>array(floatval($aciertos))));

					if(intval($this->session->userdata("graph_segundo"))>0){
						$data_second=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS nombre_quest, (SELECT clave FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS clave_quest, (SELECT id FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS id_quest FROM grupos AS ppal WHERE ppal.id='".$this->session->userdata("graph_segundo")."'")[0];
						if($protocolo_s && $data_second["clave_quest"]==CLAVE_AVENTURA) $protocolo_s=TRUE;
						else $protocolo_s=FALSE;
						$query="SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='".$data_second["id"]."' $filtro_fecha ) $filtro_fecha AND idCuestionario='".$data_second["id_quest"]."' AND pre_post='".intval($this->session->userdata("graph_pre_post"))."') AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1) GROUP BY idUsuario;";
						$totales=$this->get_data_from_query($query);
						$aciertos=0;
						$x=0;
						if($totales!==FALSE)foreach($totales AS $e=>$key){$aciertos+=intval($key["num"]);$x++;}
						if(intval($aciertos)>0) $aciertos=floatval($aciertos/$x);
						if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0){
							$totales=$this->get_data("COUNT(*) AS num","preguntas","idCuestionario='".$data_second["id_quest"]."'")[0]["num"];
							$aciertos=floatval($aciertos)*10/floatval($totales);
						}
						array_push($data_main,array("name"=>$data_second["nombre"], "data"=>array(floatval($aciertos))));
					}

					if(intval($this->session->userdata("graph_pre_post"))>0) $sub.=" POST"; else $sub.=" PRE";
					$result=array_merge($result,array("subtitle"=>$sub));
					$result=array_merge($result,array("data_main"=>$data_main));

					$result=array_merge($result,array("protocolo_success"=>$protocolo_s));
					if($protocolo_s){
						$result=array_merge($result,array("protocolo_title"=>"GRÁFICA COMPARATIVA DE GRUPOS (PROTOCOLO)"));
						$data_first=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS nombre_quest, (SELECT clave FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS clave_quest, (SELECT id FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS id_quest FROM grupos AS ppal WHERE ppal.id='".$this->session->userdata("graph_primer")."'")[0];
						$result=array_merge($result,array("protocolo_type_main"=>'column'));
						$result=array_merge($result,array("protocolo_categories"=>array("Resultados")));
						$data_main=array();
						$query="SELECT COALESCE(SUM(idRespuesta),0) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='".$data_first["id"]."' $filtro_fecha ) $filtro_fecha AND idCuestionario='4' ) GROUP BY idUsuario;";
						$totales=$this->get_data_from_query($query);
						$aciertos=0;
						$x=0;
						if($totales!==FALSE)foreach($totales AS $e=>$key){$aciertos+=intval($key["num"]);$x++;}
						if(intval($x)>0) $aciertos=floatval($aciertos/$x);
						array_push($data_main,array("name"=>$data_first["nombre"], "data"=>array($aciertos), "color"=> '#10bf97'));
						if(intval($this->session->userdata("graph_segundo"))>0){
							$data_second=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS nombre_quest, (SELECT clave FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS clave_quest, (SELECT id FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS id_quest FROM grupos AS ppal WHERE ppal.id='".$this->session->userdata("graph_segundo")."'")[0];
							$query="SELECT COALESCE(SUM(idRespuesta),0) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='".$data_second["id"]."' $filtro_fecha ) $filtro_fecha AND idCuestionario='4' ) GROUP BY idUsuario;";
							$totales=$this->get_data_from_query($query);
							$aciertos=0;
							$x=0;
							if($totales!==FALSE)foreach($totales AS $e=>$key){$aciertos+=intval($key["num"]);$x++;}
							if(intval($x)>0) $aciertos=floatval($aciertos/$x);
							array_push($data_main,array("name"=>$data_second["nombre"], "data"=>array($aciertos), "color"=> '#fbb49a'));
						}
						$result=array_merge($result,array("protocolo_subtitle"=>"Resultados Protocolo"));
						$result=array_merge($result,array("protocolo_data_main"=>$data_main));
					}

					print json_encode($result);
				break;
				/***********************************************************/
				case 22:
					$result=array("success"=>TRUE);
					$data_first=$this->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS nombre_quest, (SELECT clave FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS clave_quest, (SELECT id FROM cuestionarios WHERE clave=(SELECT clave FROM usuarios WHERE idGrupo=ppal.id LIMIT 1)) AS id_quest FROM grupos AS ppal WHERE ppal.id='".$this->session->userdata("graph_primer")."'")[0];
					if(intval($this->session->userdata("graph_quest_type"))>0) $sub="Calificación Promedio"; else $sub="Aciertos Promedio";
					$result=array_merge($result,array("title"=>"GRÁFICA COMPLETA GRUPO ".$data_first["nombre"]));

					if($data_first["clave_quest"]==CLAVE_AVENTURA) $protocolo_s=TRUE;
					else $protocolo_s=FALSE;

					$result=array_merge($result,array("type_main"=>'column'));
					$result=array_merge($result,array("categories"=>array($sub)));

					$fecha_inicio=$this->session->userdata("graph_date_start");
					$fecha_fin=$this->session->userdata("graph_date_end");
					$filtro_fecha="";
					if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" AND DATE(date_start) >= '$fecha_inicio'";
					elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(date_start) <= '$fecha_fin'";
					elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";

					$data_main=array();
					$query="SELECT COUNT(*) AS num, ppal.nombre FROM historial_preguntas AS hist INNER JOIN usuarios AS ppal ON hist.idUsuario=ppal.id WHERE hist.idLog IN (SELECT id FROM log_historial WHERE idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='".$data_first["id"]."' $filtro_fecha ) $filtro_fecha AND idCuestionario='".$data_first["id_quest"]."' AND pre_post='".intval($this->session->userdata("graph_pre_post"))."') AND hist.idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1) GROUP BY hist.idUsuario;";
					$totales=$this->get_data_from_query($query);
					$preg_totales=$this->get_data("COUNT(*) AS num","preguntas","idCuestionario='".$data_first["id_quest"]."'")[0]["num"];
					if($totales!==FALSE){
						foreach($totales AS $e=>$key){
							if(intval($this->session->userdata("graph_quest_type"))>0) $aciertos=floatval(intval($key["num"])*10/$preg_totales);
							else $aciertos=intval($key["num"]);
							array_push($data_main,array("name"=>$key["nombre"], "data"=>array($aciertos)));
						}
					}

					if(intval($this->session->userdata("graph_pre_post"))>0) $sub.=" POST"; else $sub.=" PRE";
					$result=array_merge($result,array("subtitle"=>$sub));
					$result=array_merge($result,array("data_main"=>$data_main));

					$result=array_merge($result,array("protocolo_success"=>$protocolo_s));
					if($protocolo_s){
						$result=array_merge($result,array("protocolo_title"=>"GRÁFICA COMPLETA GRUPO ".$data_first["nombre"]." (PROTOCOLO)"));
						$result=array_merge($result,array("protocolo_type_main"=>'column'));
						$result=array_merge($result,array("protocolo_categories"=>array("Resultados")));
						$data_main=array();
						$query="SELECT COALESCE(SUM(hist.idRespuesta),0) AS num, ppal.nombre FROM historial_preguntas AS hist INNER JOIN usuarios AS ppal ON hist.idUsuario=ppal.id WHERE hist.idLog IN (SELECT id FROM log_historial WHERE idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='".$data_first["id"]."' $filtro_fecha ) $filtro_fecha AND idCuestionario='4') GROUP BY hist.idUsuario;";
						$totales=$this->get_data_from_query($query);
						if($totales!==FALSE){
							foreach($totales AS $e=>$key){
								array_push($data_main,array("name"=>$key["nombre"], "data"=>array(intval($key["num"]))));
							}
						}
						$result=array_merge($result,array("protocolo_subtitle"=>"Resultados Protocolo"));
						$result=array_merge($result,array("protocolo_data_main"=>$data_main));
					}

					print json_encode($result);
				break;
				/***********************************************************/
				case 3:
					$result=array("success"=>TRUE);
					if(intval($this->session->userdata("graph_quest_type"))>0) $sub="Calificación Promedio"; else $sub="Aciertos Promedio";
					$result=array_merge($result,array("title"=>"GRÁFICA COMPARATIVA DE DESPACHOS"));
					$data_first=$this->get_data_from_query("SELECT ppal.*, curso.nombre AS nombre_quest, curso.id AS id_quest FROM despachos AS ppal INNER JOIN cuestionarios AS curso ON ppal.idCurso=curso.id WHERE ppal.id='".$this->session->userdata("graph_primer")."'")[0];

					$result=array_merge($result,array("type_main"=>'column'));
					$result=array_merge($result,array("categories"=>array($sub)));

					$fecha_inicio=$this->session->userdata("graph_date_start");
					$fecha_fin=$this->session->userdata("graph_date_end");
					$filtro_fecha="";
					if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" AND DATE(date_start) >= '$fecha_inicio'";
					elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(date_start) <= '$fecha_fin'";
					elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";

					$data_main=array();
					$query="SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idUsuario IN (SELECT id FROM usuarios WHERE idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$data_first["id"]."') $filtro_fecha ) $filtro_fecha AND idCuestionario='".$data_first["id_quest"]."' AND pre_post='".intval($this->session->userdata("graph_pre_post"))."') AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1) GROUP BY idUsuario;";
					$totales=$this->get_data_from_query($query);
					$aciertos=0;
					$x=0;
					if($totales!==FALSE)foreach($totales AS $e=>$key){$aciertos+=intval($key["num"]);$x++;}
					if(intval($aciertos)>0) $aciertos=floatval($aciertos/$x);
					if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0){
						$totales=$this->get_data("COUNT(*) AS num","preguntas","idCuestionario='".$data_first["id_quest"]."'")[0]["num"];
						$aciertos=floatval($aciertos)*10/floatval($totales);
					}
					array_push($data_main,array("name"=>$data_first["nombre"], "data"=>array(floatval($aciertos))));

					if(intval($this->session->userdata("graph_segundo"))>0){
						$data_second=$this->get_data_from_query("SELECT ppal.*, curso.nombre AS nombre_quest, curso.id AS id_quest FROM despachos AS ppal INNER JOIN cuestionarios AS curso ON ppal.idCurso=curso.id WHERE ppal.id='".$this->session->userdata("graph_segundo")."'")[0];
						$query="SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idUsuario IN (SELECT id FROM usuarios WHERE idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$data_second["id"]."') $filtro_fecha ) $filtro_fecha AND idCuestionario='".$data_second["id_quest"]."' AND pre_post='".intval($this->session->userdata("graph_pre_post"))."') AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1) GROUP BY idUsuario;";
						$totales=$this->get_data_from_query($query);
						$aciertos=0;
						$x=0;
						if($totales!==FALSE)foreach($totales AS $e=>$key){$aciertos+=intval($key["num"]);$x++;}
						if(intval($aciertos)>0) $aciertos=floatval($aciertos/$x);
						if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0){
							$totales=$this->get_data("COUNT(*) AS num","preguntas","idCuestionario='".$data_second["id_quest"]."'")[0]["num"];
							$aciertos=floatval($aciertos)*10/floatval($totales);
						}
						array_push($data_main,array("name"=>$data_second["nombre"], "data"=>array(floatval($aciertos))));
					}

					if(intval($this->session->userdata("graph_pre_post"))>0) $sub.=" POST"; else $sub.=" PRE";
					$result=array_merge($result,array("subtitle"=>$sub));
					$result=array_merge($result,array("data_main"=>$data_main));
					print json_encode($result);
				break;
			}
		}else print json_encode(array("success"=>FALSE));
	}

	public function set_graph_data(){
		$type=$this->security->xss_clean($this->input->post("type"));
		$date_start=$this->security->xss_clean($this->input->post("date_start"));
		$date_end=$this->security->xss_clean($this->input->post("date_end"));
		$primer=$this->security->xss_clean($this->input->post("primer"));
		$segundo=$this->security->xss_clean($this->input->post("segundo"));
		$pre_post=$this->security->xss_clean($this->input->post("pre_post"));
		$quest_type=$this->security->xss_clean($this->input->post("quest_type"));
		$this->session->set_userdata("graph_type",$type);
		$this->session->set_userdata("graph_date_start",$date_start);
		$this->session->set_userdata("graph_date_end",$date_end);
		$this->session->set_userdata("graph_primer",$primer);
		$this->session->set_userdata("graph_segundo",$segundo);
		$this->session->set_userdata("graph_pre_post",$pre_post);
		$this->session->set_userdata("graph_quest_type",$quest_type);
	}

	public function new_graph(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			if($permisos!==FALSE){
				$this->load->view("graphs/vw_new_graph");
			}else redirect(base_url());
		}else redirect(base_url());
	}

	public function get_graficas(){
		$idCuestionario=$this->security->xss_clean($this->input->post("quest"));
		$id=$this->security->xss_clean($this->input->post("id"));
		$date_start=$this->security->xss_clean($this->input->post("date_start"));
		$date_end=$this->security->xss_clean($this->input->post("date_end"));
		$session_id=$this->session->userdata("id");
		if(intval($this->get_data("is_admin","cuestionarios","id='$idCuestionario'")[0]["is_admin"])===0){
			$nombre="PRE";
			$pre_post=0;
			$id_log=$this->get_data("COALESCE(id,0) AS id","log_historial","idCuestionario='$idCuestionario' AND idUsuario='$id' AND date_end IS NULL AND pre_post='$pre_post'","id DESC","","1")[0]["id"];
			$aciertos=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log' AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0]["num"];
			$totales=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log';")[0]["num"];
			$alumno_pre = array("aciertos"=>$aciertos,"nombre"=>$nombre,"totales"=>$totales);
			$prom=$this->get_data_from_query("SELECT COUNT(*) AS num, (SELECT COUNT(*) FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AS avr FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0];
			$promedio_pre = array("aciertos"=>intval($prom["avr"])>0?($prom["num"]/$prom["avr"]):0,"nombre"=>$nombre,"totales"=>$totales);

			$nombre="POST";
			$pre_post=1;
			$id_log=$this->get_data("COALESCE(id,0) AS id","log_historial","idCuestionario='$idCuestionario' AND idUsuario='$id' AND date_end IS NULL AND pre_post='$pre_post'","id DESC","","1")[0]["id"];
			$aciertos=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log' AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0]["num"];
			$totales=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log';")[0]["num"];
			$alumno_post = array("aciertos"=>$aciertos,"nombre"=>$nombre,"totales"=>$totales);
			$prom=$this->get_data_from_query("SELECT COUNT(*) AS num, (SELECT COUNT(*) FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AS avr FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0];
			$promedio_post = array("aciertos"=>intval($prom["avr"])>0?($prom["num"]/$prom["avr"]):0,"nombre"=>$nombre,"totales"=>$totales);
		}else{
			$nombre="YO";
			$pre_post=0;
			$id_log=$this->get_data("COALESCE(id,0) AS id","log_historial","idCuestionario='$idCuestionario' AND idUsuario='$id' AND idAdmin='$session_id' AND date_end IS NULL AND pre_post='$pre_post'","id DESC","","1")[0]["id"];
			$aciertos=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log' AND idRespuesta=1;")[0]["num"];
			$totales=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log';")[0]["num"];
			$alumno_pre = array("aciertos"=>$aciertos,"nombre"=>$nombre,"totales"=>$totales);
			$prom=$this->get_data_from_query("SELECT COUNT(*) AS num, (SELECT COUNT(*) FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AS avr FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AND idRespuesta=1;")[0];
			$promedio_pre = array("aciertos"=>intval($prom["avr"])>0?($prom["num"]/$prom["avr"]):0,"nombre"=>$nombre,"totales"=>$totales);

			$nombre="PROVEEDOR";
			$pre_post=1;
			$id_log=$this->get_data("COALESCE(id,0) AS id","log_historial","idCuestionario='$idCuestionario' AND idUsuario='$id' AND idAdmin='$session_id' AND date_end IS NULL AND pre_post='$pre_post'","id DESC","","1")[0]["id"];
			$aciertos=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log' AND idRespuesta=1;")[0]["num"];
			$totales=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log';")[0]["num"];
			$alumno_post = array("aciertos"=>$aciertos,"nombre"=>$nombre,"totales"=>$totales);
			$prom=$this->get_data_from_query("SELECT COUNT(*) AS num, (SELECT COUNT(*) FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AS avr FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AND idRespuesta=1;")[0];
			$promedio_post = array("aciertos"=>intval($prom["avr"])>0?($prom["num"]/$prom["avr"]):0,"nombre"=>$nombre,"totales"=>$totales);
		}
		
		print json_encode(array("alumno_pre"=>$alumno_pre,"promedio_pre"=>$promedio_pre,"alumno_post"=>$alumno_post,"promedio_post"=>$promedio_post));
	}

	public function get_graficas_grupo(){
		$idCuestionario=$this->security->xss_clean($this->input->post("quest"));
		$id=$this->security->xss_clean($this->input->post("id"));
		$idInstructor=$this->get_data("idInstructor AS id","grupos","id='$id'")[0]["id"];
		
		$nombre="PRE";
		$pre_post=0;
		$aciertos=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE pre_post='$pre_post' AND idCuestionario='$idCuestionario' AND idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='$id')) AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0]["num"];
		$totales=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog = (SELECT id FROM log_historial WHERE pre_post='$pre_post'AND idCuestionario='$idCuestionario' LIMIT 1);")[0]["num"];
		$alumno_pre = array("aciertos"=>$aciertos,"nombre"=>$nombre,"totales"=>$totales);
		$prom=$this->get_data_from_query("SELECT COUNT(*) AS num, (SELECT COUNT(*) FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AS avr FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE pre_post='$pre_post' AND idCuestionario='$idCuestionario' AND idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='$id')) AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0];
		$promedio_pre = array("aciertos"=>intval($prom["avr"])>0?($prom["num"]/$prom["avr"]):0,"nombre"=>$nombre,"totales"=>$totales);

		$nombre="POST";
		$pre_post=1;
		$aciertos=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE pre_post='$pre_post'AND idCuestionario='$idCuestionario' AND idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='$id')) AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0]["num"];
		$totales=$this->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog = (SELECT id FROM log_historial WHERE pre_post='$pre_post'AND idCuestionario='$idCuestionario' LIMIT 1);")[0]["num"];
		$alumno_post = array("aciertos"=>$aciertos,"nombre"=>$nombre,"totales"=>$totales);
		$prom=$this->get_data_from_query("SELECT COUNT(*) AS num, (SELECT COUNT(*) FROM log_historial WHERE idCuestionario='$idCuestionario' AND pre_post='$pre_post') AS avr FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE pre_post='$pre_post' AND idCuestionario='$idCuestionario' AND idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='$id')) AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0];
		$promedio_post = array("aciertos"=>intval($prom["avr"])>0?($prom["num"]/$prom["avr"]):0,"nombre"=>$nombre,"totales"=>$totales);
		
		print json_encode(array("alumno_pre"=>$alumno_pre,"promedio_pre"=>$promedio_pre,"alumno_post"=>$alumno_post,"promedio_post"=>$promedio_post));
	}

	public function closesession(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function eliminar_usuarios(){
		$data=$this->security->xss_clean($this->input->post("data"));
		foreach($data AS $e => $key){
			$this->mdllogin->deleteData("usuarios",$key,"id");
		}
		print json_encode(array("success"=>TRUE));
	}

	public function eliminar_grupos(){
		$data=$this->security->xss_clean($this->input->post("data"));
		foreach($data AS $e => $key){
			$this->mdllogin->deleteData("grupos",$key,"id");
		}
		print json_encode(array("success"=>TRUE));
	}

	public function bloquear_todos_usuarios(){
		$temp=array("date_end"=>date('Y-m-d H:i:s'));
		$this->mdllogin->editData($temp,"usuarios",FALSE,"id","WHERE date_end IS NULL AND id NOT IN (SELECT idUsuario FROM usuarios_permisos)");
		print json_encode(array("success"=>TRUE));
	}

	public function guardar_edicion_usuarios(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$s=TRUE;
		if(!empty($data)){
			foreach($data AS $e => $key){
				$j=1;
				$id_temp=$key[0];
				$temp=array(
					"nombre"		=> $key[$j++],
					"numero"		=> $key[$j++],
					"idInstructor"	=> $key[$j++],
					"idGrupo"		=> $key[$j++],
					"clave"			=> $key[$j++],
					"codigo"		=> $key[$j++],
					"date_end"		=> intval($key[$j++])>0 ? "NULL" : date('Y-m-d H:i:s'),
					"date_start"	=> DateTime::createFromFormat('Y-m-d',$key[$j++])->format('Y-m-d H:i:s')
				);
				if(strlen($key[$j])>0) $temp["estatus"]=$key[$j];
				if($this->mdllogin->editData($temp,"usuarios",$id_temp,"id"))$s=$s; else $s=FALSE;
			}
			print json_encode(array("success"=>$s, "msg"=>FALSE));
		}else print json_encode(array("success"=>FALSE, "msg"=>"Por favor seleccione los usuarios a editar"));
	}

	public function guardar_edicion_grupos(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$s=TRUE;
		if(!empty($data)){
			foreach($data AS $e => $key){
				$j=1;
				$id_temp=$key[0];
				$temp=array(
					"idInstructor"	=> $key[$j++],
					"nombre"		=> $key[$j++],
					"date_from"		=> DateTime::createFromFormat('Y-m-d',$key[$j++])->format('Y-m-d'),
					"date_to"		=> DateTime::createFromFormat('Y-m-d',$key[$j++])->format('Y-m-d')
				);
				if($this->mdllogin->editData($temp,"grupos",$id_temp,"id"))$s=$s; else $s=FALSE;
			}
			print json_encode(array("success"=>$s, "msg"=>FALSE));
		}else print json_encode(array("success"=>FALSE, "msg"=>"Por favor seleccione los grupos a editar"));
	}

	public function upload_files(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$resultados=array();
		foreach($data AS $e => $key){
			$objPHPExcel = PHPExcel_IOFactory::load(FILE_ROUTE_FULL."files/".$key);
			foreach($objPHPExcel->getWorksheetIterator() as $worksheet){
				$index=$objPHPExcel->getIndex($worksheet);
				$elem=$objPHPExcel->setActiveSheetIndex($index);
				$end=$elem->getHighestRow();
				for($i=2;$i<=$end;$i++){
					if(strlen($elem->getCell("A".strval($i))->getValue())>0){
						$num=$elem->getCell("B".strval($i))->getValue();
						$curso=$elem->getCell("H".strval($i))->getValue();
						$log="";
						$tempCuest=$this->get_data("id,clave,is_admin","cuestionarios","LOWER(nombre) LIKE LOWER('%$curso%')","","","1");
						$tempCurso=$this->get_data("id,is_admin","cursos","LOWER(nombre) LIKE LOWER('%$curso%')","","","1");
						if($tempCuest!==FALSE){
							$temp=$this->get_data("id","usuarios","numero='$num' AND clave='".$tempCuest[0]["clave"]."'");
							if($temp!==FALSE){
								$already_exists=TRUE;
								$id=$temp[0]["id"];
								$log="Usuario: ".$elem->getCell("A".strval($i))->getValue()." encontrado.";
							}else{
								$already_exists=FALSE;
								$id=0;
								$instructor=$elem->getCell("G".strval($i))->getValue();
								$new_temp=$this->get_data("id","instructores","LOWER(nombre) LIKE LOWER('%$instructor%') AND idDespacho IN (SELECT id FROM despachos WHERE idCurso=(SELECT id FROM cuestionarios WHERE LOWER(nombre) LIKE LOWER('%$curso%') LIMIT 1))","","","1");
								if($new_temp!==FALSE){
									if($tempCuest!==FALSE || $tempCurso!==FALSE){
										
										#if(intval($tempCuest[0]["id"])===intval($tempCurso[0]["id"])){
											
											if($elem->getCell("D".strval($i))->getValue()==$tempCuest[0]["clave"]){

												$grupo_temp=$this->get_data("id,date_from","grupos","idInstructor='".$new_temp[0]["id"]."' AND LOWER(nombre) = LOWER('".$elem->getCell("E".strval($i))->getValue()."')","","","1");
												if($grupo_temp!==FALSE){
													$insert_user=array(
														"nombre"		=> $elem->getCell("A".strval($i))->getValue(),
														"numero"		=> $elem->getCell("B".strval($i))->getValue(),
														"clave"			=> $elem->getCell("D".strval($i))->getValue(),
														"codigo"		=> $elem->getCell("E".strval($i))->getValue(),
														"idInstructor"	=> $new_temp[0]["id"],
														"idGrupo"		=> $grupo_temp[0]["id"],
														"pwd"			=> hash('sha512', $elem->getCell("B".strval($i))->getValue()),
														"date_start"	=> $grupo_temp[0]["date_from"]." ".date("H:i:s"),
														"idUsuarioCarga"=> $this->session->userdata("id"),
														"fechaCarga"	=> date("Y-m-d H:i:s"),
														"nombreCarga"	=> $key
													);
													$id=$this->mdllogin->insertData($insert_user,"usuarios");
													if(intval($id)>0) $log="Fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle().", usuario nuevo insertado correctamente.";
													else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se insertó correctamente el usuario"));
												
												}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el grupo ".$elem->getCell("E".strval($i))->getValue()." con el instructor seleccionado. Favor de verificar el nombre del instructor."));
											
											}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." la clave del grupo no corresponde con el instructor seleccionado. Favor de verificar el código de grupo."));
										
										#}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." la clave del curso no corresponde con el curso seleccionado. Favor de verificar el nombre del curso."));

									}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el curso: $curso. Favor de verificar el nombre del curso."));

								}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra al instructor: ".$instructor));
							
							}
							if(intval($id)>0){
								if($tempCurso!==FALSE || $tempCuest!==FALSE){
									$idCuestionario= intval($tempCuest[0]["id"])>0 ? $tempCuest[0]["id"] : $tempCurso[0]["id"];
									$continuar_pre=TRUE;
									if(trim($elem->getCell("I".strval($i))->getValue())=="POST"){
										$pre_exists=$this->get_data("id","log_historial","idUsuario='$id' AND idCuestionario='$idCuestionario' AND pre_post='0'");
										if($pre_exists!==FALSE) $continuar_pre=$continuar_pre;
										else $continuar_pre=FALSE;
									}
									if($continuar_pre){
										$grupo_temp=$this->get_data("id,date_from,date_to","grupos","id=(SELECT idGrupo FROM usuarios WHERE id='$id')");
										$date_log=date('Y-m-d H:i:s');
										if($grupo_temp!==FALSE){
											if(trim($elem->getCell("I".strval($i))->getValue())=="POST") $date_log=$grupo_temp[0]["date_to"]." ".date('H:i:s');
											else $date_log=$grupo_temp[0]["date_from"]." ".date('H:i:s');
										}
										if(trim($elem->getCell("I".strval($i))->getValue())=="PROTOCOLO"){
											$idCuestionario=4;
											$resp_temp=$this->get_data_from_query("select id AS idPregunta, (SELECT COUNT(*) FROM preguntas WHERE idCuestionario='$idCuestionario') AS num from preguntas WHERE idCuestionario='$idCuestionario' LIMIT 1;")[0];
											$insert=array(
												"idCuestionario"	=> $idCuestionario,
												"idUsuario"			=> $id,
												"idAdmin"			=> $id,
												"date_start"		=> $date_log,
												"pre_post"			=> 0,
												"idUsuarioCarga"	=> $this->session->userdata("id"),
												"fechaCarga"		=> date("Y-m-d H:i:s"),
												"nombreCarga"		=> $key
											);
											$resp=0;
										}else{
											$resp_temp=$this->get_data_from_query("select id, (SELECT id FROM preguntas WHERE idCuestionario='$idCuestionario' LIMIT 1) AS idPregunta, (SELECT COUNT(*) FROM preguntas WHERE idCuestionario='$idCuestionario') AS num from respuestas WHERE idPregunta IN (SELECT id FROM preguntas WHERE idCuestionario='$idCuestionario') LIMIT 1;")[0];
											$resp=$resp_temp["id"];
											$insert=array(
												"idCuestionario"	=> $idCuestionario,
												"idUsuario"			=> $id,
												"date_start"		=> $date_log,
												"pre_post"			=> trim($elem->getCell("I".strval($i))->getValue())=="POST"?1:0,
												"idUsuarioCarga"	=> $this->session->userdata("id"),
												"fechaCarga"		=> date("Y-m-d H:i:s"),
												"nombreCarga"		=> $key
											);
										}
										//*
										$this->mdllogin->deleteData_multipleWhere("log_historial",array(
											"idCuestionario"	=> $idCuestionario,
											"idUsuario"			=> $id,
											"pre_post"			=> trim($elem->getCell("I".strval($i))->getValue())=="POST"?1:0
										));
										$insert_one=$this->mdllogin->insertData($insert,"log_historial");
										/* */
										$a='J';
										$num_resp=$resp_temp["num"];
										$num_preg=$resp_temp["idPregunta"];
										for($j=0; $j<$num_resp;$j++){
											if($idCuestionario===4){
												$num_temp=intval($elem->getCell(strval($a).strval($i))->getValue());
												$data_temp=array(
													"idPregunta"	=> $num_preg+$j,
													"idRespuesta"	=> $num_temp,
													"idUsuario"		=> $id,
													"idLog"			=> $insert_one
												);
											}else{
												$num_temp=intval(ord(strtoupper($elem->getCell(strval($a).strval($i))->getValue())));
												$data_temp=array(
													"idPregunta"	=> $num_preg+$j,
													"idRespuesta"	=> $num_temp>0?(intval($num_temp+$resp)-65):0,
													"idUsuario"		=> $id,
													"idLog"			=> $insert_one
												);
											}
											$this->mdllogin->insertData($data_temp,"historial_preguntas");

											$resp+=4;
											$a++;
										}
										array_push($resultados, array("type"=>TRUE, "msg"=>$log." Evaluación añadida correctamente en el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()."."));
									}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se puede insertar el test POST sin antes haber un PRE para este usuario."));
								}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra ningún curso con los datos seleccionados. Favor de verificar el nombre del curso."));
							}//END IF ID > 0 (NO MESSAGE)
						}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el cuestionario seleccionado"));
					}else array_push($resultados, array("type"=>FALSE, "msg"=>"El registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no cuenta con el nombre del usuario"));
				}//END IF FOR
			}//END WHILE
		}
		print json_encode(array("result"=>$resultados));
	}

	public function upload_files_instructores(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$resultados=array();
		foreach($data AS $e => $key){
			$objPHPExcel = PHPExcel_IOFactory::load(FILE_ROUTE_FULL."files/".$key);
			foreach($objPHPExcel->getWorksheetIterator() as $worksheet){
				$index=$objPHPExcel->getIndex($worksheet);
				$elem=$objPHPExcel->setActiveSheetIndex($index);
				$end=$elem->getHighestRow();
				for($i=2;$i<=$end;$i++){
					if(strlen($elem->getCell("A".strval($i))->getValue())>0){
						$curso=$elem->getCell("A".strval($i))->getValue();
						$despacho=$elem->getCell("B".strval($i))->getValue();
						$instructor=$elem->getCell("C".strval($i))->getValue();
						$user=$elem->getCell("D".strval($i))->getValue();
						$pwd=$elem->getCell("E".strval($i))->getValue();
						$curso_data=$this->get_data("id, clave","cuestionarios","LOWER(nombre) LIKE LOWER('%$curso%')","","","1");
						if($curso_data!==FALSE){
							$despacho_data=$this->get_data("id","despachos","LOWER(nombre)=LOWER('$despacho') AND idCurso='".$curso_data[0]["id"]."'","","","1");
							if($despacho_data!==FALSE){
								$id_ins_data=$this->get_data("id","instructores","LOWER(nombre) = LOWER('$instructor') AND idDespacho='".$despacho_data[0]["id"]."'","","","1");
								if($id_ins_data===FALSE){
									$data_instructores=array(
										"idDespacho"	=> $despacho_data[0]["id"],
										"nombre"		=> $instructor,
										"usuario"		=> $user,
										"contrasena"	=> $pwd
									);
									$idInstructor=$this->mdllogin->insertData($data_instructores,"instructores");
									$data_users=array(
										"idGrupo"		=> 0,
										"idInstructor"	=> $idInstructor,
										"nombre"		=> $instructor,
										"numero"		=> $user,
										"email"			=> $user,
										"pwd"			=> hash('sha512',$pwd),
										"date_start"	=> date('Y-m-d H:i:s'),
										"idUsuarioCarga"=> $this->session->userdata("id"),
										"fechaCarga"	=> date('Y-m-d H:i:s'),
										"nombreCarga"	=> $key
									);
									$idUsuario=$this->mdllogin->insertData($data_users,"usuarios");
									$data_permisos=array(
										"idUsuario"		=> $idUsuario,
										"idInstructor"	=> $idInstructor
									);
									$id_result=$this->mdllogin->insertData($data_permisos,"usuarios_permisos");
									if(intval($id_result)>0) array_push($resultados, array("type"=>TRUE, "msg"=>"Instructor dado de alta correctamente en la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle().": ".$instructor));
									else array_push($resultados, array("type"=>FALSE, "msg"=>"Hubo un error en la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle().": ".$instructor));
								}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." el instructor registrado ya existe: $instructor. Intente con otro nombre distinto "));
							}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el despacho: $despacho. Intente corrigiendo el nombre del despacho tal como aparece en el sistema"));
						}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el cuestionario: $curso. Intente corrigiendo el nombre del curso tal como aparece en el sistema"));
					}
				}//END IF FOR
			}
		}
		print json_encode(array("result"=>$resultados));
	}

	public function upload_files_grupos(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$resultados=array();
		foreach($data AS $e => $key){
			$objPHPExcel = PHPExcel_IOFactory::load(FILE_ROUTE_FULL."files/".$key);
			foreach($objPHPExcel->getWorksheetIterator() as $worksheet){
				$index=$objPHPExcel->getIndex($worksheet);
				$elem=$objPHPExcel->setActiveSheetIndex($index);
				$end=$elem->getHighestRow();
				for($i=2;$i<=$end;$i++){
					if(strlen($elem->getCell("A".strval($i))->getValue())>0){
						$instructor=$elem->getCell("A".strval($i))->getValue();
						$despacho=$elem->getCell("B".strval($i))->getValue();
						$curso=$elem->getCell("C".strval($i))->getValue();
						$curso_data=$this->get_data("id, clave","cuestionarios","LOWER(nombre) LIKE LOWER('%$curso%')","","","1");
						if($curso_data!==FALSE){
							$despacho_data=$this->get_data("id","despachos","LOWER(nombre)=LOWER('$despacho') AND idCurso='".$curso_data[0]["id"]."'","","","1");
							if($despacho_data!==FALSE){
								$id_ins_data=$this->get_data("id","instructores","LOWER(nombre) = LOWER('$instructor') AND idDespacho='".$despacho_data[0]["id"]."'","","","1");
								if($id_ins_data!==FALSE){
									$grupo=$elem->getCell("D".strval($i))->getValue();
									$date_inicio=$elem->getCell("E".strval($i))->getValue();
									if(strlen($date_inicio)>0)$date_inicio=date('Y-m-d', strtotime($date_inicio));
									$date_fin=$elem->getCell("F".strval($i))->getValue();
									if(strlen($date_fin)>0)$date_fin=date('Y-m-d', strtotime($date_fin));
									$id_gr_data=$this->get_data("id","grupos","LOWER(nombre)=LOWER('$grupo') AND idInstructor='".$id_ins_data[0]["id"]."'");
									if($id_gr_data===FALSE){
										$temp=array(
											"nombre"		=> $grupo,
											"idInstructor"	=> $id_ins_data[0]["id"],
											"date_from"		=> $date_inicio,
											"date_to"		=> $date_fin,
											"idUsuarioCarga"=> $this->session->userdata("id"),
											"fechaCarga"	=> date('Y-m-d H:i:s'),
											"nombreCarga"	=> $key
										);
										$this->mdllogin->insertData($temp,"grupos");
										array_push($resultados, array("type"=>TRUE, "msg"=>"Grupo registrado correctamente en la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle().": ".$grupo));
									}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." el grupo: $grupo ya se encuentra dado de alta"));
								}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el instructor: $instructor. Intente corrigiendo el nombre del instructor tal como aparece en el sistema"));
							}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el despacho: $despacho. Intente corrigiendo el nombre del despacho tal como aparece en el sistema"));
						}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el cuestionario: $curso. Intente corrigiendo el nombre del curso tal como aparece en el sistema"));
					}
				}//END IF FOR
			}
		}
		print json_encode(array("result"=>$resultados));
	}

	public function upload_files_users(){
		$data=$this->security->xss_clean($this->input->post("data"));
		$resultados=array();
		foreach($data AS $e => $key){
			$objPHPExcel = PHPExcel_IOFactory::load(FILE_ROUTE_FULL."files/".$key);
			foreach($objPHPExcel->getWorksheetIterator() as $worksheet){
				$index=$objPHPExcel->getIndex($worksheet);
				$elem=$objPHPExcel->setActiveSheetIndex($index);
				$end=$elem->getHighestRow();
				for($i=2;$i<=$end;$i++){
					if(strlen(trim($elem->getCell("A".strval($i))->getValue()))>0){
						$datos_carga=array();
						$datos_carga["nombre"]=trim($elem->getCell("A".strval($i))->getValue())." ".trim($elem->getCell("B".strval($i))->getValue())." ".trim($elem->getCell("C".strval($i))->getValue());
						#$datos_carga["antiguedad"]=$elem->getCell("E".strval($i))->getValue();
						$datos_carga["pwd"]=hash('sha512',trim($elem->getCell("D".strval($i))->getValue()));
						$datos_carga["email"]=trim($elem->getCell("D".strval($i))->getValue());

						$data_temp=trim($elem->getCell("G".strval($i))->getValue());
						$temp_ins=$this->get_data("id","instructores","LOWER(nombre) LIKE LOWER('%$data_temp%') AND idDespacho IN (SELECT id FROM despachos WHERE idCurso=(SELECT id FROM cuestionarios WHERE LOWER(nombre) LIKE LOWER('%".trim($elem->getCell("F".strval($i))->getValue())."%') LIMIT 1))","","","1");
						if($temp_ins!==FALSE){
							$datos_carga["idInstructor"]=$temp_ins[0]["id"];

							$data_temp=trim($elem->getCell("I".strval($i))->getValue());
							$temp_gru=$this->get_data("id,date_from","grupos","LOWER(nombre) = LOWER('$data_temp')","","","1");
							if($temp_gru!==FALSE){
								$datos_carga["idGrupo"]=$temp_gru[0]["id"];
								$datos_carga["codigo"]=$data_temp;
								$datos_carga["date_start"]=$temp_gru[0]["date_from"]." ".date("H:i:s");
							
								$data_temp=trim($elem->getCell("F".strval($i))->getValue());
								$temp_quest=$this->get_data("id, clave","cuestionarios","LOWER(nombre) LIKE LOWER('%$data_temp%')","","","1");
								if($temp_quest!==FALSE){
									$datos_carga["clave"]=trim($temp_quest[0]["clave"]);

									$data_temp=trim($elem->getCell("D".strval($i))->getValue());
									$temp=$this->get_data("id","usuarios","numero = '$data_temp' AND clave = '".$datos_carga["clave"]."'");
									if($temp!==FALSE){
										$this->mdllogin->editData($datos_carga,"usuarios",$temp[0]["id"],"id");
										array_push($resultados, array("type"=>TRUE, "msg"=>"Usuario editado correctamente en la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle().": ".$data_temp));
									}else{
										$datos_carga["numero"]=trim($elem->getCell("D".strval($i))->getValue());
										$datos_carga["idUsuarioCarga"]=$this->session->userdata("id");
										$datos_carga["fechaCarga"]=date('Y-m-d H:i:s');
										$datos_carga["nombreCarga"]=$key;
										$this->mdllogin->insertData($datos_carga,"usuarios");
										array_push($resultados, array("type"=>TRUE, "msg"=>"Usuario dado de alta correctamente en la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle().": ".$datos_carga["numero"]));
									}
								}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el cuestionario: $data_temp. Intente corrigiendo el nombre del curso tal como aparece en el sistema"));
							}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." el grupo: $data_temp no está registrado. Realice primero la carga de grupos"));
						}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." no se encuentra el instructor: $data_temp. Intente corrigiendo el nombre del instructor tal como aparece en el sistema"));
					}else array_push($resultados, array("type"=>FALSE, "msg"=>"En el registro de la fila $i, hoja ".$objPHPExcel->getActiveSheet()->getTitle()." el nombre del usuario está incompleto, favor de verificarlo"));
				}//END FOR
			}
		}
		print json_encode(array("result"=>$resultados));
	}

	public function get_reporte_completo_azul(){
		$fecha_inicio=$this->security->xss_clean($this->input->post("fecha_inicio"));
		$fecha_fin=$this->security->xss_clean($this->input->post("fecha_fin"));
		
		$despachos=$this->security->xss_clean($this->input->post("despachos"));
		$instructores=$this->security->xss_clean($this->input->post("instructores"));
		$grupos=$this->security->xss_clean($this->input->post("grupos"));

		$filtro_fecha="";
		$filtro_usuarios="";

		if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" AND DATE(ppal.date_start) >= '$fecha_inicio'";
		elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(ppal.date_start) <= '$fecha_fin'";
		elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(ppal.date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";

		if(intval($grupos)>0) $filtro_usuarios=" AND ppal.idGrupo = '$grupos'";
		elseif(intval($grupos)===0 && intval($instructores)>0) $filtro_usuarios=" AND ppal.idInstructor = '$instructores'";
		elseif(intval($grupos)===0 && intval($instructores)===0 && intval($despachos)>0) $filtro_usuarios=" AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='$despachos')";

		//*

		$objPHPExcel = PHPExcel_IOFactory::load(FILE_ROUTE_FULL."files/layout.xlsx");
		$name="Reporte_Completo_".date("Ymd_His").".xlsx";
		$objPHPExcel->setActiveSheetIndex(0);

		$id=$this->session->userdata("id");
		$permisos=$this->get_data("*","usuarios_permisos","idUsuario='$id'");
		if(intval($permisos[0]["idDespacho"])>0){
			$consulta="SELECT ppal.* FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos) AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') $filtro_fecha ;";
			$quests="SELECT * FROM cursos WHERE id=(SELECT idCurso FROM despachos WHERE id='".$permisos[0]["idDespacho"]."') AND is_admin=1;";
		}elseif(intval($permisos[0]["idInstructor"])>0){
			$consulta="SELECT ppal.* FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.idInstructor='".$permisos[0]["idInstructor"]."' $filtro_fecha ;";
			$quests="SELECT * FROM cursos WHERE id=(SELECT idCurso FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id='".$permisos[0]["idInstructor"]."')) AND is_admin=1;";
		}else{
			$consulta="SELECT ppal.* FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) $filtro_fecha ;";
			$quests="SELECT * FROM cursos;";
		}

		#$usuarios=$this->get_data_from_query($consulta);
		$cuest=$this->get_data_from_query($quests);
		$session_id=$this->session->userdata("id");
		$temp_u=0;
		$s=2;
		$numeros_de_usuario=array();

		if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" AND DATE(ppal.date_start) >= '$fecha_inicio'";
		elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(ppal.date_start) <= '$fecha_fin'";
		elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(ppal.date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";

		foreach($cuest AS $c=>$cuestionario){
			$a='A';
			/*
			if(intval($permisos[0]["idDespacho"])>0) $data_temp=$this->get_data_from_query("		SELECT ppal.id, ppal.pre_post, det.id AS idUsuario, det.codigo, det.clave, det.nombre, det.numero FROM log_historial AS ppal INNER JOIN usuarios AS det ON ppal.idUsuario=det.id WHERE ppal.idCuestionario='".$cuestionario["id"]."' $filtro_fecha $filtro_usuarios AND ppal.pre_post=0 AND ppal.date_end IS NULL AND det.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY id) AND det.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') ORDER BY ppal.idUsuario;");
			elseif(intval($permisos[0]["idInstructor"])>0) $data_temp=$this->get_data_from_query("	SELECT ppal.id, ppal.pre_post, det.id AS idUsuario, det.codigo, det.clave, det.nombre, det.numero FROM log_historial AS ppal INNER JOIN usuarios AS det ON ppal.idUsuario=det.id WHERE ppal.idCuestionario='".$cuestionario["id"]."' $filtro_fecha $filtro_usuarios AND ppal.pre_post=0 AND ppal.date_end IS NULL AND det.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY id) AND det.idInstructor='".$permisos[0]["idInstructor"]."' ORDER BY ppal.idUsuario;");
			else $data_temp=$this->get_data_from_query("											SELECT ppal.id, ppal.pre_post, det.id AS idUsuario, det.codigo, det.clave, det.nombre, det.numero FROM log_historial AS ppal INNER JOIN usuarios AS det ON ppal.idUsuario=det.id WHERE ppal.idCuestionario='".$cuestionario["id"]."' $filtro_fecha $filtro_usuarios AND ppal.pre_post=0 AND ppal.date_end IS NULL AND det.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY id) ORDER BY ppal.idUsuario;");
			/* */
			$filtro_fecha="";
			if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" WHERE DATE(date_start) >= '$fecha_inicio'";
			elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" WHERE DATE(date_start) <= '$fecha_fin'";
			elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" WHERE DATE(date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";
			if(intval($cuestionario["is_admin"])==0){
				if(intval($permisos[0]["idDespacho"])>0) 		$query_new="SELECT ppal.id AS idUsuario, ppal.codigo, ppal.estatus, grupo.date_from, grupo.date_to, DATE(ppal.date_start) AS date_user, ppal.clave, ppal.nombre, ppal.numero, (SELECT id FROM log_historial WHERE date_end IS NULL AND idUsuario=ppal.id AND pre_post=0 AND idCuestionario='".$cuestionario["id"]."' LIMIT 1) AS id, 0 AS pre_post FROM usuarios AS ppal INNER JOIN grupos AS grupo ON ppal.idGrupo=grupo.id WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.id IN (SELECT idUsuario FROM log_historial $filtro_fecha ) $filtro_usuarios AND ppal.clave=(SELECT clave FROM cuestionarios WHERE id='".$cuestionario["id"]."') AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') ORDER BY ppal.id;";
				elseif(intval($permisos[0]["idInstructor"])>0) 	$query_new="SELECT ppal.id AS idUsuario, ppal.codigo, ppal.estatus, grupo.date_from, grupo.date_to, DATE(ppal.date_start) AS date_user, ppal.clave, ppal.nombre, ppal.numero, (SELECT id FROM log_historial WHERE date_end IS NULL AND idUsuario=ppal.id AND pre_post=0 AND idCuestionario='".$cuestionario["id"]."' LIMIT 1) AS id, 0 AS pre_post FROM usuarios AS ppal INNER JOIN grupos AS grupo ON ppal.idGrupo=grupo.id WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.id IN (SELECT idUsuario FROM log_historial $filtro_fecha ) $filtro_usuarios AND ppal.clave=(SELECT clave FROM cuestionarios WHERE id='".$cuestionario["id"]."') AND ppal.idInstructor='".$permisos[0]["idInstructor"]."' ORDER BY ppal.id;";
				else 											$query_new="SELECT ppal.id AS idUsuario, ppal.codigo, ppal.estatus, grupo.date_from, grupo.date_to, DATE(ppal.date_start) AS date_user, ppal.clave, ppal.nombre, ppal.numero, (SELECT id FROM log_historial WHERE date_end IS NULL AND idUsuario=ppal.id AND pre_post=0 AND idCuestionario='".$cuestionario["id"]."' LIMIT 1) AS id, 0 AS pre_post FROM usuarios AS ppal INNER JOIN grupos AS grupo ON ppal.idGrupo=grupo.id WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.id IN (SELECT idUsuario FROM log_historial $filtro_fecha ) $filtro_usuarios AND ppal.clave=(SELECT clave FROM cuestionarios WHERE id='".$cuestionario["id"]."') ORDER BY ppal.id;";
			}else{
				if(intval($permisos[0]["idDespacho"])>0) 		$query_new="SELECT ppal.id AS idUsuario, ppal.codigo, ppal.estatus, grupo.date_from, grupo.date_to, DATE(ppal.date_start) AS date_user, ppal.clave, ppal.nombre, ppal.numero, (SELECT id FROM log_historial WHERE date_end IS NULL AND idAdmin=ppal.id LIMIT 1) AS id FROM usuarios AS ppal INNER JOIN grupos AS grupo ON ppal.idGrupo=grupo.id WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) $filtro_usuarios AND ppal.id IN (SELECT idAdmin FROM log_historial $filtro_fecha ) AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') ORDER BY ppal.id;";
				elseif(intval($permisos[0]["idInstructor"])>0) 	$query_new="SELECT ppal.id AS idUsuario, ppal.codigo, ppal.estatus, grupo.date_from, grupo.date_to, DATE(ppal.date_start) AS date_user, ppal.clave, ppal.nombre, ppal.numero, (SELECT id FROM log_historial WHERE date_end IS NULL AND idAdmin=ppal.id LIMIT 1) AS id FROM usuarios AS ppal INNER JOIN grupos AS grupo ON ppal.idGrupo=grupo.id WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) $filtro_usuarios AND ppal.id IN (SELECT idAdmin FROM log_historial $filtro_fecha ) AND ppal.idInstructor='".$permisos[0]["idInstructor"]."' ORDER BY ppal.id;";
				else 											$query_new="SELECT ppal.id AS idUsuario, ppal.codigo, ppal.estatus, grupo.date_from, grupo.date_to, DATE(ppal.date_start) AS date_user, ppal.clave, ppal.nombre, ppal.numero, (SELECT id FROM log_historial WHERE date_end IS NULL AND idAdmin=ppal.id LIMIT 1) AS id FROM usuarios AS ppal INNER JOIN grupos AS grupo ON ppal.idGrupo=grupo.id WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) $filtro_usuarios AND ppal.id IN (SELECT idAdmin FROM log_historial $filtro_fecha ) ORDER BY ppal.id;";
			}
			#echo $query_new;
			$data_temp=$this->get_data_from_query($query_new);
			if($data_temp!==FALSE){
				foreach($data_temp AS $e=>$key){
					if(intval($cuestionario["is_admin"])==0){
						#$resp=$this->get_data_from_query("SELECT ppal.*, det.is_correct FROM historial_preguntas AS ppal LEFT JOIN respuestas AS det ON ppal.idRespuesta=det.id WHERE ppal.idLog='".$key["id"]."'");
						$a='A';
						$aciertos_num=0;
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["codigo"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["date_from"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["date_to"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["clave"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $cuestionario["nombre"]);
						$names_add=$this->get_data_from_query("SELECT nombre FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=(SELECT idInstructor FROM usuarios WHERE id='".$key["idUsuario"]."'))")[0];
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $names_add["nombre"]);
						#$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "PRUEBA");
						$names_add=$this->get_data_from_query("SELECT nombre FROM instructores WHERE id=(SELECT idInstructor FROM usuarios WHERE id='".$key["idUsuario"]."')")[0];
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $names_add["nombre"]);
						#$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "PRUEBA");
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["numero"]); $numeros_de_usuario[$key["numero"]]=$s;
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["nombre"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["estatus"]);
						#$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["date_user"]);

						$aciertos=$this->get_data_from_query("SELECT COUNT(1) AS num FROM historial_preguntas AS det LEFT JOIN log_historial AS log ON det.idLog=log.id LEFT JOIN respuestas AS resp ON det.idRespuesta=resp.id WHERE log.pre_post='0' AND log.idCuestionario='".$cuestionario["id"]."' AND log.idUsuario='".$key["idUsuario"]."' AND resp.is_correct=1;");
						#$aciertos=FALSE;
						if($aciertos!==FALSE) $objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $aciertos[0]["num"]);
						else $objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, 0);

						$aciertos=$this->get_data_from_query("SELECT COUNT(1) AS num FROM historial_preguntas AS det LEFT JOIN log_historial AS log ON det.idLog=log.id LEFT JOIN respuestas AS resp ON det.idRespuesta=resp.id WHERE log.pre_post='1' AND log.idCuestionario='".$cuestionario["id"]."' AND log.idUsuario='".$key["idUsuario"]."' AND resp.is_correct=1;");
						#$aciertos=FALSE;
						if($aciertos!==FALSE) $objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $aciertos[0]["num"]);
						else $objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, 0);
						/*
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, intval($key["pre_post"])>0?"POST":"PRE");
						$names_add=$this->get_data_from_query("SELECT nombre FROM instructores WHERE id=(SELECT idInstructor FROM usuarios WHERE id='".$key["idUsuario"]."')")[0];
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $names_add["nombre"]);
						$names_add=$this->get_data_from_query("SELECT codigo FROM usuarios WHERE id='".$key["idUsuario"]."'")[0];
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $names_add["codigo"]);
						
						if($resp!==FALSE){
							foreach($resp AS $r=>$respuesta){
								if(intval($respuesta["is_correct"])>0){
									$objPHPExcel->getActiveSheet()->getStyle(strval($a).$s)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '92D050'))));
									$aciertos_num++;
								}
								if(intval($respuesta["idRespuesta"])>0)
									$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, chr(ord('A')+intval($this->get_data_from_query("SELECT (z.rank-1) AS num FROM (SELECT t.id, @rownum := @rownum + 1 AS rank FROM respuestas t, (SELECT @rownum := 0) r WHERE idPregunta='".$respuesta["idPregunta"]."' ORDER BY id ASC) AS z WHERE id='".$respuesta["idRespuesta"]."';")[0]["num"])));
								else
									$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "");
							}
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a).$s, $aciertos_num);
						}*/
						$s++;
					}else{
						$resp=$this->get_data_from_query("SELECT SUM(idRespuesta) AS suma FROM historial_preguntas AS ppal WHERE ppal.idLog='".$key["id"]."'");
						$a='A';
						$aciertos_num=0;
						$worksheet = $objPHPExcel->getActiveSheet();
						if(array_key_exists($key["numero"],$numeros_de_usuario)){
							$s_temp=$numeros_de_usuario[$key["numero"]];
						}else{
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["codigo"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["date_from"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["date_to"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["clave"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $cuestionario["nombre"]);
							$names_add=$this->get_data_from_query("SELECT nombre FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=(SELECT idInstructor FROM usuarios WHERE id='".$key["idUsuario"]."'))")[0];
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $names_add["nombre"]);
							$names_add=$this->get_data_from_query("SELECT nombre FROM instructores WHERE id=(SELECT idInstructor FROM usuarios WHERE id='".$key["idUsuario"]."')")[0];
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $names_add["nombre"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["numero"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["nombre"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["estatus"]);
							$s_temp=$s;
							$s++;
						}
						if($resp!==FALSE){
							/*foreach($resp AS $r=>$respuesta){
								if(intval($respuesta["idRespuesta"])===1){
									$objPHPExcel->getActiveSheet()->getStyle(strval($a).$s)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '92D050'))));
									$aciertos_num++;
								}
								if(intval($respuesta["idRespuesta"])>0)
									$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, (intval($respuesta["idRespuesta"])===1?"SI":"NO"));
								else
									$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "");
							}*/
							#$a_temp=$a;
							#$objPHPExcel->getActiveSheet()->mergeCells(strval($a++).$s.":".strval($a).$s);
							$objPHPExcel->getActiveSheet()->SetCellValue("M".$s_temp, $resp[0]["suma"]);
							$aciertos=intval($resp[0]["suma"]);
							/*
							if($aciertos <= 24) $rango = "12 - 24 NIVEL NULO: Tienes una oportunidad de mejora urgente.";
							elseif($aciertos>=25 && $aciertos <= 37) $rango = "25 - 37 NIVEL BAJO: Tienes una oportunidad de mejora importante.";
							elseif($aciertos>=38 && $aciertos <= 50) $rango = "38 - 50 NIVEL MEDIO: Tienes áreas de mejora.";
							elseif($aciertos>=51) $rango = "51 - 60 NIVEL ALTO: Brindaste un servicio de excelencia.";
							else $rango = "";
							*/
							if($aciertos <= 18) $rango = "1 - 18 Competencia no desarrollada: Muestra un desarrollo nulo de la Competencia de Enfoque a Resultados.";
							elseif($aciertos>=19 && $aciertos <= 26) $rango = "19 - 26 Competencia ligeramente desarrollada: Asume el compromiso con los objetivos de la organización, actuando de manera Eficiente frente a los obstáculos o imprevistos, asumiendo la responsabilidad por los aciertos y errores cometidos. Realiza correctamente el trabajo, entregándolo en tiempo y con calidad.";
							elseif($aciertos>=27 && $aciertos <= 34) $rango = "27 - 34 Competencia medianamente desarrollada: Asume con seriedad sus tareas y obtiene los resultados esperados en los plazos establecidos, comprometiéndose con su equipo y con equipos de otras áreas en el logro de los mismos. Identifica claramente el impacto que tiene su contribución individual con los resultados globales de la empresa. Se ausenta sólo por motivos de fuerza mayor y hace lo posible para reponer el tiempo perdido.";
							elseif($aciertos>=35 && $aciertos <= 42) $rango = "35 - 42 Competencia altamente desarrollada: Alinea sus funciones y tareas asignadas con los objetivos estratégicos de la empresa. Facilita el alcance de resultados de otras áreas. Aporta soluciones de alto valor agregado para la organización, incluso frente a problemas complejos y en escenarios cambiantes.";
							elseif($aciertos>=43) $rango = "43 - 55 Competencia plenamente desarrollada: Actúa de manera pro activa al realizar cambios y mejoras en los métodos de trabajo para hacer más eficiente su operación. Promueve el mejoramiento de la calidad, la satisfacción del cliente interno y externo y/o las ventas.";
							else $rango = "";
							$objPHPExcel->getActiveSheet()->SetCellValue("N".$s_temp, $rango);
						}
					}
				}
			}
		}
		$s--;
		$objPHPExcel->getActiveSheet()->getStyle("A2:N".strval($s))->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))));
		$objPHPExcel->getActiveSheet()->getStyle("A2:N".strval($s))->applyFromArray(array('font'  => array('bold'  => false,'color' => array('rgb' => '000000'),'size'  => 11,'name'  => 'Calibri')));
		$objPHPExcel->getActiveSheet()->getStyle("A2:N".strval($s))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save(str_replace(__FILE__,FILE_ROUTE_FULL.'files/'.$name,__FILE__));

		print json_encode(array("success"=>TRUE,"ruta"=>$name));

		/* */
	}

	public function get_reporte_completo_individual(){
		$fecha_inicio=$this->security->xss_clean($this->input->post("fecha_inicio"));
		$fecha_fin=$this->security->xss_clean($this->input->post("fecha_fin"));
		
		$despachos=$this->security->xss_clean($this->input->post("despachos"));
		$instructores=$this->security->xss_clean($this->input->post("instructores"));
		$grupos=$this->security->xss_clean($this->input->post("grupos"));

		$filtro_fecha="";
		$filtro_usuarios="";

		//*

		if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" AND DATE(ppal.date_start) >= '$fecha_inicio'";
		elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(ppal.date_start) <= '$fecha_fin'";
		elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(ppal.date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";

		if(intval($grupos)>0) $filtro_usuarios=" AND ppal.idGrupo = '$grupos'";
		elseif(intval($grupos)===0 && intval($instructores)>0) $filtro_usuarios=" AND ppal.idInstructor = '$instructores'";
		elseif(intval($grupos)===0 && intval($instructores)===0 && intval($despachos)>0) $filtro_usuarios=" AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='$despachos')";

		$objPHPExcel = PHPExcel_IOFactory::load(FILE_ROUTE_FULL."files/reporte.xlsx");
		$name="Reporte_Completo_".date("Ymd_His").".xlsx";

		$id=$this->session->userdata("id");
		$permisos=$this->get_data("*","usuarios_permisos","idUsuario='$id'");
		if(intval($permisos[0]["idDespacho"])>0){
			$consulta="SELECT ppal.*, (COALESCE((SELECT nombre FROM cuestionarios WHERE clave=ppal.clave),'')) AS nombre_quest, (COALESCE((SELECT id FROM cuestionarios WHERE clave=ppal.clave),'')) AS id_quest, (COALESCE((SELECT nombre FROM grupos WHERE id=ppal.idGrupo),'')) AS nombre_grupo, (COALESCE((SELECT nombre FROM instructores WHERE id=ppal.idInstructor),'')) AS nombre_instructor, (COALESCE((SELECT nombre FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=ppal.idInstructor)),'')) AS nombre_despacho FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.id IN (SELECT DISTINCT idUsuario FROM log_historial GROUP BY idUsuario) AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') $filtro_usuarios $filtro_fecha ORDER BY ppal.numero LIMIT 500;";
			$quests="SELECT ppal.*, (SELECT COUNT(1) FROM preguntas WHERE idCuestionario=ppal.id) AS tot_preg FROM cuestionarios AS ppal WHERE ppal.id=(SELECT idCurso FROM despachos WHERE id='".$permisos[0]["idDespacho"]."') OR ppal.is_admin=1;";
		}elseif(intval($permisos[0]["idInstructor"])>0){
			$consulta="SELECT ppal.*, (COALESCE((SELECT nombre FROM cuestionarios WHERE clave=ppal.clave),'')) AS nombre_quest, (COALESCE((SELECT id FROM cuestionarios WHERE clave=ppal.clave),'')) AS id_quest, (COALESCE((SELECT nombre FROM grupos WHERE id=ppal.idGrupo),'')) AS nombre_grupo, (COALESCE((SELECT nombre FROM instructores WHERE id=ppal.idInstructor),'')) AS nombre_instructor, (COALESCE((SELECT nombre FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=ppal.idInstructor)),'')) AS nombre_despacho FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.id IN (SELECT DISTINCT idUsuario FROM log_historial GROUP BY idUsuario) AND ppal.idInstructor='".$permisos[0]["idInstructor"]."' $filtro_usuarios $filtro_fecha ORDER BY ppal.numero LIMIT 500;";
			$quests="SELECT ppal.*, (SELECT COUNT(1) FROM preguntas WHERE idCuestionario=ppal.id) AS tot_preg FROM cuestionarios AS ppal WHERE ppal.id=(SELECT idCurso FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id='".$permisos[0]["idInstructor"]."')) OR ppal.is_admin=1;";
		}else{
			$consulta="SELECT ppal.*, (COALESCE((SELECT nombre FROM cuestionarios WHERE clave=ppal.clave),'')) AS nombre_quest, (COALESCE((SELECT id FROM cuestionarios WHERE clave=ppal.clave),'')) AS id_quest, (COALESCE((SELECT nombre FROM grupos WHERE id=ppal.idGrupo),'')) AS nombre_grupo, (COALESCE((SELECT nombre FROM instructores WHERE id=ppal.idInstructor),'')) AS nombre_instructor, (COALESCE((SELECT nombre FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=ppal.idInstructor)),'')) AS nombre_despacho FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.id IN (SELECT DISTINCT idUsuario FROM log_historial GROUP BY idUsuario) $filtro_usuarios $filtro_fecha ORDER BY ppal.numero LIMIT 500;";
			$quests="SELECT ppal.*, (SELECT COUNT(1) FROM preguntas WHERE idCuestionario=ppal.id) AS tot_preg FROM cuestionarios AS ppal;";
		}

		if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" AND DATE(date_start) >= '$fecha_inicio'";
		elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(date_start) <= '$fecha_fin'";
		elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";

		$usuarios=$this->get_data_from_query($consulta);
		$cuest=$this->get_data_from_query($quests);
		$session_id=$this->session->userdata("id");
		$temp_u=0;
		if($usuarios!==FALSE){
			foreach($usuarios AS $u=>$usuario){
				if(intval($u)>0) $objPHPExcel->createSheet();
				$objPHPExcel->setActiveSheetIndex($u);
				$a='A';
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "ID");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Nombre");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Estatus");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Número de empleado");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Antigüedad");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Clave");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Código");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Despacho");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Instructor");
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."1", "Curso");
				$a='A';
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["id"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["nombre"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["estatus"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["numero"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["antiguedad"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["clave"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["codigo"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["nombre_despacho"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["nombre_instructor"]);
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."2", $usuario["nombre_quest"]);
				$s=4;
				foreach($cuest AS $c=>$cuestionario){
					if(intval($cuestionario["id"])===intval($usuario["id_quest"]) || intval($cuestionario["is_admin"])>0){
						$objPHPExcel->getActiveSheet()->SetCellValue("A".$s, "Cuestionario");
						if(intval($cuestionario["is_admin"])===0){
							$objPHPExcel->getActiveSheet()->SetCellValue("B".$s++, $usuario["nombre_quest"]);
							$objPHPExcel->getActiveSheet()->mergeCells('A'.++$s.':C'.$s);
							$objPHPExcel->getActiveSheet()->mergeCells('F'.$s.':H'.$s);
							$objPHPExcel->getActiveSheet()->SetCellValue("A".$s, "PRE");
							$objPHPExcel->getActiveSheet()->SetCellValue("F".$s++, "POST");
							$objPHPExcel->getActiveSheet()->SetCellValue("A".$s, "# Pregunta");
							$objPHPExcel->getActiveSheet()->SetCellValue("B".$s, "Respuesta");
							$objPHPExcel->getActiveSheet()->SetCellValue("C".$s, "Acierto");
							$objPHPExcel->getActiveSheet()->SetCellValue("F".$s, "# Pregunta");
							$objPHPExcel->getActiveSheet()->SetCellValue("G".$s, "Respuesta");
							$objPHPExcel->getActiveSheet()->SetCellValue("H".$s++, "Acierto");
						}else{
							$objPHPExcel->getActiveSheet()->SetCellValue("B".$s++, $cuestionario["nombre"]);
							$objPHPExcel->getActiveSheet()->mergeCells('A'.++$s.':B'.$s);
							$objPHPExcel->getActiveSheet()->SetCellValue("A".$s++, "PROTOCOLO");
							$objPHPExcel->getActiveSheet()->SetCellValue("A".$s, "# Pregunta");
							$objPHPExcel->getActiveSheet()->SetCellValue("B".$s++, "Respuesta");
						}
						$s_temp=$s;

						if(intval($cuestionario["is_admin"])===0) 	$log_t=$this->get_data_from_query("SELECT id, pre_post FROM log_historial WHERE idUsuario='".$usuario["id"]."' AND idCuestionario='".$cuestionario["id"]."' ;");
						else 										$log_t=$this->get_data_from_query("SELECT id, pre_post FROM log_historial WHERE idAdmin='".$usuario["id"]."' AND idCuestionario='".$cuestionario["id"]."' ;");
						
						if($log_t!==FALSE){
							foreach($log_t AS $l=>$log){
								if(intval($log["pre_post"])===0){
									$aciertos=0;
									if(intval($cuestionario["is_admin"])===0){
										$temp=$this->get_data_from_query("SELECT ppal.*, det.is_correct FROM historial_preguntas AS ppal LEFT JOIN respuestas AS det ON ppal.idRespuesta=det.id WHERE ppal.idLog='".$log["id"]."'");
										if($temp!==FALSE){
											foreach($temp AS $p=>$preg){
												$objPHPExcel->getActiveSheet()->SetCellValue("A".$s, ($p+1));
												if(intval($preg["idRespuesta"])>0){
													#$objPHPExcel->getActiveSheet()->SetCellValue("B".$s, chr(ord('A')+intval($this->get_data_from_query("SELECT (z.rank-1) AS num FROM (SELECT t.id, @rownum := @rownum + 1 AS rank FROM respuestas t, (SELECT @rownum := 0) r WHERE idPregunta='".$preg["idPregunta"]."' ORDER BY id ASC) AS z WHERE id='".$preg["idRespuesta"]."';")[0]["num"])));
													switch(intval($preg["idRespuesta"] % 4)){
														case 1: $objPHPExcel->getActiveSheet()->SetCellValue("B".$s, "A"); break;
														case 2: $objPHPExcel->getActiveSheet()->SetCellValue("B".$s, "B"); break;
														case 3: $objPHPExcel->getActiveSheet()->SetCellValue("B".$s, "C"); break;
														case 0: $objPHPExcel->getActiveSheet()->SetCellValue("B".$s, "D"); break;
													}
												}else
													$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s_temp, "");
												$objPHPExcel->getActiveSheet()->SetCellValue("C".$s, intval($preg["is_correct"])>0?"SI":"NO");
												if(intval($preg["is_correct"])>0){
													$aciertos++;
													$objPHPExcel->getActiveSheet()->getStyle("C".$s)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '92D050'))));
												}
												$s++;
											}
										}
										$objPHPExcel->getActiveSheet()->mergeCells('A'.$s.':B'.$s);
										$objPHPExcel->getActiveSheet()->SetCellValue("A".$s, "ACIERTOS");
										$objPHPExcel->getActiveSheet()->SetCellValue("C".$s, $aciertos);
									}else{
										//*
										$temp=$this->get_data_from_query("SELECT ppal.* FROM historial_preguntas AS ppal WHERE ppal.idLog='".$log["id"]."'");
										if($temp!==FALSE){
											foreach($temp AS $p=>$preg){
												$objPHPExcel->getActiveSheet()->SetCellValue("A".$s, ($p+1));
												$objPHPExcel->getActiveSheet()->SetCellValue("B".$s, intval($preg["idRespuesta"]));
												$aciertos+=intval($preg["idRespuesta"]);
												$s++;
											}
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("A".$s, "ACIERTOS");
										$objPHPExcel->getActiveSheet()->SetCellValue("B".$s, $aciertos);
										/* */
									}
								}else{
									$aciertos=0;
									if(intval($cuestionario["is_admin"])===0){
										$temp=$this->get_data_from_query("SELECT ppal.idRespuesta, ppal.idPregunta, det.is_correct FROM historial_preguntas AS ppal LEFT JOIN respuestas AS det ON ppal.idRespuesta=det.id WHERE ppal.idLog='".$log["id"]."'");
										if($temp!==FALSE){
											foreach($temp AS $p=>$preg){
												$objPHPExcel->getActiveSheet()->SetCellValue("F".$s_temp, ($p+1));
												if(intval($preg["idRespuesta"])>0){
													#$objPHPExcel->getActiveSheet()->SetCellValue("G".$s_temp, chr(ord('A')+intval($this->get_data_from_query("SELECT (z.rank-1) AS num FROM (SELECT t.id, @rownum := @rownum + 1 AS rank FROM respuestas t, (SELECT @rownum := 0) r WHERE idPregunta='".$preg["idPregunta"]."' ORDER BY id ASC) AS z WHERE id='".$preg["idRespuesta"]."';")[0]["num"])));
													#$objPHPExcel->getActiveSheet()->SetCellValue("G".$s_temp, chr(ord('A')+intval($preg["idRespuesta"] % 4)-1));
													switch(intval($preg["idRespuesta"] % 4)){
														case 1: $objPHPExcel->getActiveSheet()->SetCellValue("G".$s_temp, "A"); break;
														case 2: $objPHPExcel->getActiveSheet()->SetCellValue("G".$s_temp, "B"); break;
														case 3: $objPHPExcel->getActiveSheet()->SetCellValue("G".$s_temp, "C"); break;
														case 0: $objPHPExcel->getActiveSheet()->SetCellValue("G".$s_temp, "D"); break;
													}
												}else
													$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s_temp, "");
												$objPHPExcel->getActiveSheet()->SetCellValue("H".$s_temp, intval($preg["is_correct"])>0?"SI":"NO");
												if(intval($preg["is_correct"])>0){
													$aciertos++;
													$objPHPExcel->getActiveSheet()->getStyle("H".$s_temp)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '92D050'))));
												}
												$s_temp++;
											}
											$objPHPExcel->getActiveSheet()->mergeCells('F'.$s_temp.':G'.$s_temp);
											$objPHPExcel->getActiveSheet()->SetCellValue("F".$s_temp, "ACIERTOS");
											$objPHPExcel->getActiveSheet()->SetCellValue("H".$s_temp, $aciertos);
										}
									}
								}
							}
						}
						$s+=4;
					}
				}

				$objPHPExcel->getActiveSheet()->setTitle($this->getInicials($usuario["numero"]));
				$temp_u=$u+1;
			}
		}

		$objPHPExcel->setActiveSheetIndex(0);

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save(str_replace(__FILE__,FILE_ROUTE_FULL.'files/'.$name,__FILE__));

		print json_encode(array("success"=>TRUE,"ruta"=>$name));
		/* */
	}

	public function get_reporte_completo(){
		$fecha_inicio=$this->security->xss_clean($this->input->post("fecha_inicio"));
		$fecha_fin=$this->security->xss_clean($this->input->post("fecha_fin"));
		
		$despachos=$this->security->xss_clean($this->input->post("despachos"));
		$instructores=$this->security->xss_clean($this->input->post("instructores"));
		$grupos=$this->security->xss_clean($this->input->post("grupos"));

		$filtro_fecha="";
		$filtro_usuarios="";

		if(strlen($fecha_inicio)>0 && strlen($fecha_fin)===0) $filtro_fecha=" AND DATE(ppal.date_start) >= '$fecha_inicio'";
		elseif(strlen($fecha_inicio)===0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(ppal.date_start) <= '$fecha_fin'";
		elseif(strlen($fecha_inicio)>0 && strlen($fecha_fin)>0) $filtro_fecha=" AND DATE(ppal.date_start) BETWEEN '$fecha_inicio' AND '$fecha_fin'";

		if(intval($grupos)>0) $filtro_usuarios=" AND det.idGrupo = '$grupos'";
		elseif(intval($grupos)===0 && intval($instructores)>0) $filtro_usuarios=" AND det.idInstructor = '$instructores'";
		elseif(intval($grupos)===0 && intval($instructores)===0 && intval($despachos)>0) $filtro_usuarios=" AND det.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='$despachos')";

		//*

		$objPHPExcel = PHPExcel_IOFactory::load(FILE_ROUTE_FULL."files/reporte.xlsx");
		$name="Reporte_Completo_".date("Ymd_His").".xlsx";

		$id=$this->session->userdata("id");
		$permisos=$this->get_data("*","usuarios_permisos","idUsuario='$id'");
		if(intval($permisos[0]["idDespacho"])>0){
			$consulta="SELECT ppal.*, (COALESCE((SELECT nombre FROM cuestionarios WHERE clave=ppal.clave),'')) AS nombre_quest, (COALESCE((SELECT id FROM cuestionarios WHERE clave=ppal.clave),'')) AS id_quest, (COALESCE((SELECT nombre FROM grupos WHERE id=ppal.idGrupo),'')) AS nombre_grupo, (COALESCE((SELECT nombre FROM instructores WHERE id=ppal.idInstructor),'')) AS nombre_instructor, (COALESCE((SELECT nombre FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=ppal.idInstructor)),'')) AS nombre_despacho FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') $filtro_usuarios $filtro_fecha ;";
			$quests="SELECT ppal.*, (SELECT COUNT(1) FROM preguntas WHERE idCuestionario=ppal.id) AS tot_preg FROM cursos AS ppal WHERE ppal.id=(SELECT idCurso FROM despachos WHERE id='".$permisos[0]["idDespacho"]."') OR ppal.is_admin=1;";
		}elseif(intval($permisos[0]["idInstructor"])>0){
			$consulta="SELECT ppal.*, (COALESCE((SELECT nombre FROM cuestionarios WHERE clave=ppal.clave),'')) AS nombre_quest, (COALESCE((SELECT id FROM cuestionarios WHERE clave=ppal.clave),'')) AS id_quest, (COALESCE((SELECT nombre FROM grupos WHERE id=ppal.idGrupo),'')) AS nombre_grupo, (COALESCE((SELECT nombre FROM instructores WHERE id=ppal.idInstructor),'')) AS nombre_instructor, (COALESCE((SELECT nombre FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=ppal.idInstructor)),'')) AS nombre_despacho FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) AND ppal.idInstructor='".$permisos[0]["idInstructor"]."' $filtro_usuarios $filtro_fecha ;";
			$quests="SELECT ppal.*, (SELECT COUNT(1) FROM preguntas WHERE idCuestionario=ppal.id) AS tot_preg FROM cursos AS ppal WHERE ppal.id=(SELECT idCurso FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id='".$permisos[0]["idInstructor"]."')) OR ppal.is_admin=1;";
		}else{
			$consulta="SELECT ppal.*, (COALESCE((SELECT nombre FROM cuestionarios WHERE clave=ppal.clave),'')) AS nombre_quest, (COALESCE((SELECT id FROM cuestionarios WHERE clave=ppal.clave),'')) AS id_quest, (COALESCE((SELECT nombre FROM grupos WHERE id=ppal.idGrupo),'')) AS nombre_grupo, (COALESCE((SELECT nombre FROM instructores WHERE id=ppal.idInstructor),'')) AS nombre_instructor, (COALESCE((SELECT nombre FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=ppal.idInstructor)),'')) AS nombre_despacho FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) $filtro_usuarios $filtro_fecha ;";
			$quests="SELECT ppal.*, (SELECT COUNT(1) FROM preguntas WHERE idCuestionario=ppal.id) AS tot_preg FROM cursos AS ppal;";
		}
		#echo $consulta;
		#$usuarios=$this->get_data_from_query($consulta);
		$cuest=$this->get_data_from_query($quests);
		$session_id=$this->session->userdata("id");
		$temp_u=0;

		//*
		foreach($cuest AS $c=>$cuestionario){
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex($temp_u++);
			$s=4;
			$objPHPExcel->getActiveSheet()->SetCellValue("A1", "Cuestionario");
			$objPHPExcel->getActiveSheet()->SetCellValue("B1", $cuestionario["nombre"]);
			$a='A';
			$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."3", "Número");
			$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."3", "Nombre");
			$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."3", "Estatus");
			$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."3", "Tipo");
			$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."3", "Instructor");
			$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."3", "Grupo");
			for($ii=0; $ii<$cuestionario["tot_preg"]; $ii++){
				$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."3", "Pregunta ".($ii+1));
			}
			$aaa=$a;
			$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++)."3", "Aciertos");
			if(intval($cuestionario["is_admin"])>0){
				if(intval($permisos[0]["idDespacho"])>0) 		$query="SELECT ppal.id, det.id AS idUsuario, det.numero, det.estatus, det.nombre, det.codigo, (SELECT nombre FROM instructores WHERE id=det.idInstructor) AS nombre_inst, (SELECT nombre FROM grupos WHERE id=det.idGrupo) AS nombre_grupo FROM usuarios AS det INNER JOIN log_historial AS ppal ON ppal.idAdmin=det.id WHERE ppal.date_end IS NULL $filtro_fecha $filtro_usuarios AND det.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') AND det.id IN (SELECT idUsuario FROM log_historial GROUP BY idUsuario) ;";
				elseif(intval($permisos[0]["idInstructor"])>0) 	$query="SELECT ppal.id, det.id AS idUsuario, det.numero, det.estatus, det.nombre, det.codigo, (SELECT nombre FROM instructores WHERE id=det.idInstructor) AS nombre_inst, (SELECT nombre FROM grupos WHERE id=det.idGrupo) AS nombre_grupo FROM usuarios AS det INNER JOIN log_historial AS ppal ON ppal.idAdmin=det.id WHERE ppal.date_end IS NULL $filtro_fecha $filtro_usuarios AND det.idInstructor='".$permisos[0]["idInstructor"]."' AND det.id IN (SELECT idUsuario FROM log_historial GROUP BY idUsuario) ;";
				else 											$query="SELECT ppal.id, det.id AS idUsuario, det.numero, det.estatus, det.nombre, det.codigo, (SELECT nombre FROM instructores WHERE id=det.idInstructor) AS nombre_inst, (SELECT nombre FROM grupos WHERE id=det.idGrupo) AS nombre_grupo FROM usuarios AS det INNER JOIN log_historial AS ppal ON ppal.idAdmin=det.id WHERE ppal.date_end IS NULL $filtro_fecha $filtro_usuarios  ;";
			}else{
				if(intval($permisos[0]["idDespacho"])>0) 		$query="SELECT COALESCE(ppal.id,0) AS id, COALESCE(ppal.pre_post,0) AS pre_post, det.id AS idUsuario, det.numero, det.estatus, det.nombre, det.codigo, (SELECT nombre FROM instructores WHERE id=det.idInstructor) AS nombre_inst, (SELECT nombre FROM grupos WHERE id=det.idGrupo) AS nombre_grupo FROM usuarios AS det LEFT JOIN log_historial AS ppal ON ppal.idUsuario=det.id WHERE det.clave=(SELECT clave FROM cuestionarios WHERE id='".$cuestionario["id"]."') AND COALESCE(ppal.idCuestionario='".$cuestionario["id"]."',1) AND COALESCE(ppal.date_end IS NULL,1) $filtro_fecha $filtro_usuarios AND det.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') AND det.id IN (SELECT idUsuario FROM log_historial GROUP BY idUsuario) ;";
				elseif(intval($permisos[0]["idInstructor"])>0) 	$query="SELECT COALESCE(ppal.id,0) AS id, COALESCE(ppal.pre_post,0) AS pre_post, det.id AS idUsuario, det.numero, det.estatus, det.nombre, det.codigo, (SELECT nombre FROM instructores WHERE id=det.idInstructor) AS nombre_inst, (SELECT nombre FROM grupos WHERE id=det.idGrupo) AS nombre_grupo FROM usuarios AS det LEFT JOIN log_historial AS ppal ON ppal.idUsuario=det.id WHERE det.clave=(SELECT clave FROM cuestionarios WHERE id='".$cuestionario["id"]."') AND COALESCE(ppal.idCuestionario='".$cuestionario["id"]."',1) AND COALESCE(ppal.date_end IS NULL,1) $filtro_fecha $filtro_usuarios AND det.idInstructor='".$permisos[0]["idInstructor"]."' AND det.id IN (SELECT idUsuario FROM log_historial GROUP BY idUsuario) ;";
				else 											$query="SELECT COALESCE(ppal.id,0) AS id, COALESCE(ppal.pre_post,0) AS pre_post, det.id AS idUsuario, det.numero, det.estatus, det.nombre, det.codigo, (SELECT nombre FROM instructores WHERE id=det.idInstructor) AS nombre_inst, (SELECT nombre FROM grupos WHERE id=det.idGrupo) AS nombre_grupo FROM usuarios AS det LEFT JOIN log_historial AS ppal ON ppal.idUsuario=det.id WHERE det.clave=(SELECT clave FROM cuestionarios WHERE id='".$cuestionario["id"]."') AND COALESCE(ppal.idCuestionario='".$cuestionario["id"]."',1) AND COALESCE(ppal.date_end IS NULL,1) $filtro_fecha $filtro_usuarios  ;";
			}
			#echo $query;
			#echo "<br><br>";
			//*
			$data_temp=$this->get_data_from_query($query);
			if($data_temp!==FALSE){
				foreach($data_temp AS $e=>$key){
					//*
					if(intval($cuestionario["is_admin"])===0){
						if(intval($key["id"])>0){
							$resp=$this->get_data_from_query("SELECT ppal.*, det.is_correct FROM historial_preguntas AS ppal LEFT JOIN respuestas AS det ON ppal.idRespuesta=det.id WHERE ppal.idLog='".$key["id"]."'");
							$a='A';
							$aciertos=0;
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["numero"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["nombre"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["estatus"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, intval($key["pre_post"])>0?"POST":"PRE");
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["nombre_inst"]);
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["nombre_grupo"]);
							if($resp!==FALSE){
								foreach($resp AS $r=>$respuesta){
									if(intval($respuesta["is_correct"])>0){
										$objPHPExcel->getActiveSheet()->getStyle(strval($a).$s)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '92D050'))));
										$aciertos++;
									}
									if(intval($respuesta["idRespuesta"])>0){
										switch(intval($respuesta["idRespuesta"] % 4)){
											case 1: $objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "A"); break;
											case 2: $objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "B"); break;
											case 3: $objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "C"); break;
											case 0: $objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "D"); break;
										}
									}else
										$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "");
								}
								$objPHPExcel->getActiveSheet()->SetCellValue(strval($a).$s++, $aciertos);
							}else
								$objPHPExcel->getActiveSheet()->SetCellValue(strval($aaa).$s++, $aciertos);
						}
					}else{
						//*
						$resp=$this->get_data_from_query("SELECT ppal.* FROM historial_preguntas AS ppal WHERE ppal.idLog='".$key["id"]."'");
						$a='A';
						$aciertos=0;
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["numero"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["nombre"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["estatus"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "PROTOCOLO");
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["nombre_inst"]);
						$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, $key["nombre_grupo"]);
						//$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, intval($key["pre_post"])>0?"PROVEEDOR":"YO");
						if($resp!==FALSE){
							foreach($resp AS $r=>$respuesta){
								/*
								if(intval($respuesta["idRespuesta"])===1){
									$objPHPExcel->getActiveSheet()->getStyle(strval($a).$s)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '92D050'))));
									$aciertos++;
								}
								if(intval($respuesta["idRespuesta"])>0)
									$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, (intval($respuesta["idRespuesta"])===1?"SI":"NO"));
								else
									$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, "");
								/* */
								$objPHPExcel->getActiveSheet()->SetCellValue(strval($a++).$s, intval($respuesta["idRespuesta"]));
								$aciertos+=intval($respuesta["idRespuesta"]);
							}
							$objPHPExcel->getActiveSheet()->SetCellValue(strval($a).$s++, $aciertos);
						}
						/* */
					}
					/* */
				}
			}

			$objPHPExcel->getActiveSheet()->setTitle("Reporte Concentrado ".$cuestionario["id"]);
			/* */
		}

		$objPHPExcel->setActiveSheetIndex(0);

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save(str_replace(__FILE__,FILE_ROUTE_FULL.'files/'.$name,__FILE__));

		print json_encode(array("success"=>TRUE,"ruta"=>$name));
		/* */
	}

	private function getInicials($string){
		$special_chars_table = array(
			'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
			'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
			'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
			'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
			'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
			'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
			'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
			'ÿ'=>'y', 'R'=>'R', 'r'=>'r', "'"=>'', " "=>""
		);
		$string=strtr($string, $special_chars_table);
		$words=explode(" ", $string);
		$acronym="";
		foreach($words AS $w){
			if(strlen($w)>0) $acronym.= $w[0];
		}
		if($acronym==="") $acronym=$string;
		return $string;
	}

}

?>