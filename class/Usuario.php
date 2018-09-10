<?php

class Usuario{
	private $iduser;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIduser(){
		return $this -> iduser;
	}

	public function setIduser($value){
		$this -> iduser = $value;
	}

	public function getDeslogin(){
		return $this -> deslogin;
	}

	public function setDeslogin($value){
		$this -> deslogin = $value;
	}

	public function getDessenha(){
		return $this -> dessenha;
	}

	public function setDessenha($value){
		$this -> dessenha = $value;
	}

	public function getDtcadastro(){
		return $this -> dtcadastro;
	}

	public function setDtcadastro($value){
		$this -> dtcadastro = $value;
	}

	public function loadById($id){
		
		$sql = new Sql();
		$result = $sql -> select("SELECT * FROM tb_usuarios WHERE id_user = :ID", array(
			":ID"=>$id
		));
		
		if(count($result) > 0){

			$row = $result[0];
			
			$this -> setIduser($row['id_user']);
			$this -> setDeslogin($row['deslogin']);
			$this -> setDessenha($row['dessenha']);
			$this -> setDtcadastro(new DateTime($row['dtcadastro']));
		}

	}

	public function __toString(){

		return json_encode(array(
			"iduser" => $this -> getIduser(),
			"deslogin" => $this -> getDeslogin(),
			"dessenha" => $this -> getDessenha(),
			"dtcadastro" => $this -> getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

	public function cadastrar($deslogin,$dessenha):array{

	}

}






?>