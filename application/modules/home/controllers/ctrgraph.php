<?php

class ctrGraph extends MX_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('login/mdllogin');
		date_default_timezone_set('America/Mexico_City');
		#error_reporting(E_ALL);
		#ini_set('display_errors', 1);
		$this->meses_array=array(0=>"enero",1=>"febrero",2=>"marzo",3=>"abril",4=>"mayo",5=>"junio",6=>"julio",7=>"agosto",8=>"septiembre",9=>"octubre",10=>"noviembre",11=>"diciembre");
		$this->pre_post_array=array(0=>"PRE",1=>"POST");
		$this->year=date('Y');
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel.php";
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel/Writer/Excel2007.php";
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel/IOFactory.php";
	}

	public function set_graph_data_new(){
		$type_new_graph=$this->security->xss_clean($this->input->post("type_new_graph"));
		$quest_type=$this->security->xss_clean($this->input->post("quest_type"));
		$type_test=$this->security->xss_clean($this->input->post("type_test"));
		$quests=$this->security->xss_clean($this->input->post("quests"));
		$despachos=$this->security->xss_clean($this->input->post("despachos"));
		$this->session->set_userdata("new_graph_type",$type_new_graph);
		$this->session->set_userdata("graph_quest_type",$quest_type);
		$this->session->set_userdata("new_graph_pre_post",$type_test);
		$this->session->set_userdata("new_graph_quest_id",$quests);
		$this->session->set_userdata("new_graph_despacho_id",$despachos);
	}

	public function index(){
		if($this->session->userdata("id")){
			$data["controller"]=$this;
			$permisos=$this->get_data("*","usuarios_permisos","idUsuario='".$this->session->userdata("id")."'");
			if($permisos!==FALSE){
				$this->load->view("graphs/vwgraph");
			}else redirect(base_url());
		}else redirect(base_url());
	}

	public function get_data_from_graph(){
		if($this->session->userdata("id")){
			$result=array("success"=>TRUE);
			if(intval($this->session->userdata("graph_quest_type"))>0) $sub="Calificación"; else $sub="Aciertos";
			$sub.=" ".$this->pre_post_array[intval($this->session->userdata("new_graph_pre_post"))];
			$result=array_merge($result,array("type_main"=>'column'));
			$result=array_merge($result,array("categories"=>array($sub)));
			$result=array_merge($result,array("subtitle"=>$sub));
			$data_main=array();
			$temp="SELECT COUNT(*) AS num FROM preguntas WHERE idCuestionario='".intval($this->session->userdata("new_graph_quest_id"))."'; ";
			$totales_general=$this->get_data_from_query($temp);
			if($totales_general!==FALSE) $totales_general=$totales_general[0]["num"]; else $totales_general=1;

			switch(intval($this->session->userdata("new_graph_type"))){
				case 0:
					$result=array_merge($result,array("title"=>"GRÁFICA COMPARATIVA POR MES"));
					for($i=0; $i<12; $i++){
						$query="SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE MONTH(DATE(date_start)) = '".($i+1)."' AND YEAR(DATE(date_start))='".$this->year."' AND idCuestionario='".intval($this->session->userdata("new_graph_quest_id"))."' AND pre_post='".intval($this->session->userdata("new_graph_pre_post"))."') AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1) GROUP BY idUsuario;";
						$totales=$this->get_data_from_query($query);
						$aciertos=0;
						$x=0;
						if($totales!==FALSE){
							foreach($totales AS $e=>$key){
								$aciertos+=intval($key["num"]);
								$x++;
							}
						}
						if(intval($aciertos)>0) $aciertos=floatval($aciertos/$x);
						if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0) $aciertos=floatval($aciertos)*10/floatval($totales_general);
						array_push($data_main,array("name"=>$this->meses_array[$i], "data"=>array($aciertos)));
					}
					$result=array_merge($result,array("data_main"=>$data_main));
					print json_encode($result);
				break;
				case 1:
					$result=array_merge($result,array("title"=>"GRÁFICA COMPARATIVA POR DESPACHO"));
					$idCuestionario=intval($this->session->userdata("new_graph_quest_id"));
					if($idCuestionario=4)$idCuestionario=1;
					foreach($this->get_data("id,nombre","despachos","idCurso='$idCuestionario'") AS $e=>$key){
						$query="SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE YEAR(DATE(date_start))='".$this->year."' AND idCuestionario='".intval($this->session->userdata("new_graph_quest_id"))."' AND pre_post='".intval($this->session->userdata("new_graph_pre_post"))."' AND idUsuario IN (SELECT id FROM usuarios WHERE idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$key["id"]."'))) AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1) GROUP BY idUsuario;";
						$totales=$this->get_data_from_query($query);
						$aciertos=0;
						$x=0;
						if($totales!==FALSE){
							foreach($totales AS $e2=>$key2){
								$aciertos+=intval($key2["num"]);
								$x++;
							}
						}
						if(intval($aciertos)>0) $aciertos=floatval($aciertos/$x);
						if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0) $aciertos=floatval($aciertos)*10/floatval($totales_general);
						array_push($data_main,array("name"=>$key["nombre"], "data"=>array($aciertos)));
					}
					$result=array_merge($result,array("data_main"=>$data_main));
					print json_encode($result);
				break;
				case 2:
					$result=array_merge($result,array("title"=>"GRÁFICA COMPARATIVA POR GRUPO"));
					$idCuestionario=intval($this->session->userdata("new_graph_quest_id"));
					$idDespacho=intval($this->session->userdata("new_graph_despacho_id"));
					if($idCuestionario=4)$idCuestionario=1;
					foreach($this->get_data("id,nombre","grupos","idInstructor IN (SELECT id FROM instructores WHERE idDespacho='$idDespacho')") AS $e=>$key){
						$query="SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog IN (SELECT id FROM log_historial WHERE YEAR(DATE(date_start))='".$this->year."' AND idCuestionario='".intval($this->session->userdata("new_graph_quest_id"))."' AND pre_post='".intval($this->session->userdata("new_graph_pre_post"))."' AND idUsuario IN (SELECT id FROM usuarios WHERE idGrupo='".$key["id"]."')) AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1) GROUP BY idUsuario;";
						$totales=$this->get_data_from_query($query);
						$aciertos=0;
						$x=0;
						if($totales!==FALSE){
							foreach($totales AS $e2=>$key2){
								$aciertos+=intval($key2["num"]);
								$x++;
							}
						}
						if(intval($aciertos)>0) $aciertos=floatval($aciertos/$x);
						if(intval($this->session->userdata("graph_quest_type"))>0 && intval($aciertos)>0) $aciertos=floatval($aciertos)*10/floatval($totales_general);
						array_push($data_main,array("name"=>$key["nombre"], "data"=>array($aciertos)));
					}
					$result=array_merge($result,array("data_main"=>$data_main));
					print json_encode($result);
				break;
			}
		}else print json_encode(array("success"=>FALSE));
	}

	public function get_data_from_query($query){return $this->mdllogin->getDataFromQuery($query);}
	public function get_self(){return $this;}
	public function get_data($select="",$from="",$where="",$order="",$group="",$limit=""){return $this->mdllogin->getData($select,$from,$where,$order,$group,$limit);}

}

?>