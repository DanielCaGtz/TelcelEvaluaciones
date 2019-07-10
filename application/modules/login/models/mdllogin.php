<?php

class MdlLogin extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

	public function check_login($dato,$pwd,$clave){
		$this->db->trans_start();
		$pwd=hash('sha512',$pwd);
		if($this->getDataFromQuery("SELECT id from usuarios where numero='$dato';")!==FALSE){
			#if($this->getDataFromQuery("SELECT id from usuarios_permisos where idUsuario IN (SELECT id FROM usuarios WHERE numero='$dato');")!==FALSE){
			#	$result=$this->db->query("SELECT * from usuarios where numero='$dato' and pwd='$pwd' AND date_end IS NULL;");
			#}else{
			$result=$this->db->query("SELECT ppal.*, grupo.date_from, grupo.date_to, grupo.nombre AS nombre_grupo, COALESCE((SELECT id FROM usuarios_permisos WHERE idUsuario=ppal.id),0) AS idPermisos from usuarios AS ppal LEFT JOIN grupos AS grupo ON ppal.idGrupo=grupo.id where ppal.numero='$dato' and ppal.pwd='$pwd' AND ppal.clave='$clave';");
			#}
			if($result->num_rows()>0){
				$this->db->trans_complete();
				return $result->result_array();
			}else{
				$result=$this->db->query("SELECT ppal.*, grupo.date_from, grupo.date_to, grupo.nombre AS nombre_grupo, COALESCE((SELECT id FROM usuarios_permisos WHERE idUsuario=ppal.id),0) AS idPermisos from usuarios AS ppal LEFT JOIN grupos AS grupo ON ppal.idGrupo=grupo.id where ppal.numero='$dato' and ppal.pwd='$pwd';");
				$this->db->trans_complete();
				return $result->num_rows()>0 ? $result->result_array() : FALSE;
			}
		}else{
			$this->db->trans_complete();
			return FALSE;
		}
	}

	public function check_login_by_id($id){
		$this->db->trans_start();
		$result=$this->db->query("SELECT * from usuarios where id='$id';");
		$this->db->trans_complete();
		return $result->num_rows()>0?$result->result_array():FALSE;
	}

	public function check_email_existence($dato){
		$this->db->trans_start();
		$result=$this->db->query("SELECT id from usuarios where numero='$dato';");
		$this->db->trans_complete();
		return $result->num_rows()>0?$result->result_array():FALSE;
	}

	public function getData($select,$from,$where,$order,$group,$limit){
		$this->db->trans_start();
		$query="SELECT $select FROM $from ";
		if($where!=="") $query.="WHERE $where ";
		if($group!=="") $query.="GROUP BY $group ";
		if($order!=="") $query.="ORDER BY $order ";
		if($limit!=="") $query.="LIMIT $limit ";
		$result=$this->db->query($query);
		$this->db->trans_complete();
		return $result->num_rows()>0?$result->result_array():FALSE;
	}

	public function getDataFromQuery($query){
		$this->db->trans_start();
		$result=$this->db->query($query);
		$this->db->trans_complete();
		return $result->num_rows()>0?$result->result_array():FALSE;
	}

	public function insertDataBatch($datos,$tabla){
		$this->db->trans_start();
		$this->db->insert_batch($tabla,$datos);
		$this->db->trans_complete();
		return $this->db->insert_id()>0 ? $this->db->insert_id() : FALSE;
	}

	public function insertData($datos,$tabla){
		$this->db->trans_start();
		$this->db->insert($tabla,$datos);
		$number=$this->db->insert_id();
		$this->db->trans_complete();
		return $number>0 ? $number : FALSE;
	}

	public function editData($data,$table,$id,$idName,$where=";"){
		$this->db->trans_start();
		$consulta="UPDATE $table ";
		$set=FALSE;
		foreach($data AS $e=>$key){
			if($key!==FALSE && $key!=="false"){
				if(!$set){
					$consulta.=" SET ";
					$set=TRUE;
				}else{
					$consulta.=" , ";
				}
				if($key==="NULL") $consulta.="`$e` = NULL ";
				else $consulta.="`$e` = '$key' ";
			}
		}
		if($id!==FALSE) $consulta.=" WHERE $idName = $id ".$where;
		else $consulta.=$where;
		$resultado=$this->db->query($consulta);
		if(strpos((string)$this->db->conn_id->info,"Rows matched: 0")===FALSE){
			$this->db->trans_complete();
			return TRUE;
		}else{
			$this->db->trans_complete();
			return FALSE;
		}
	}

	public function deleteData_multipleWhere($table,$where){
		$this->db->trans_start();
		foreach($where AS $e => $key){
			$this->db->where("$e",$key);
		}
		$this->db->delete($table);
		$affected=$this->db->affected_rows();
		$this->db->trans_complete();
		return $affected>0 ? TRUE : FALSE;
	}

	public function deleteData($table,$id,$idName){
		$this->db->trans_start();
		$this->db->where("$idName",$id);
		$this->db->delete($table);
		$affected=$this->db->affected_rows();
		$this->db->trans_complete();
		return $affected>0 ? TRUE : FALSE;
	}

	public function deleteDataIfExists($table,$id,$idName){
		$this->db->trans_start();
		$existence=$this->db->query("SELECT 1 FROM $table WHERE $idName = '$id' LIMIT 1;");
		if($existence->num_rows()>0){
			$this->db->where($idName,$id);
			$this->db->delete($table);
			$affected=$this->db->affected_rows();
			$this->db->trans_complete();
			return $affected>0 ? TRUE : FALSE;
		}else{
			$this->db->trans_complete();
			return TRUE;
		}
	}

}

?>