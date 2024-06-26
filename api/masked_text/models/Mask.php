<?php
class Mask extends model{

	public function getAll(){
		$array = array();

		$sql = "SELECT *
		          FROM tab_mask Order by descricao";

		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}	

		return $array;
	}

	public function get($descricao){
		$retorno = null;
		$sql = "SELECT mascara
		          FROM tab_mask where lower(descricao) = lower(:descricao)";

		$sql = $this->db->prepare($sql);
		$sql->bindvalue(":descricao",$descricao);
		$sql->execute();
		if($sql->rowCount() > 0){
			$retorno = $sql->fetch(\PDO::FETCH_ASSOC);
		}	

		return $retorno;
	}

}