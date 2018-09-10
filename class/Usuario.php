<?php

class Usuario{
	private $id;
	private $login;
	private $senha;
	private $dtcadastro;

	public function getId(){
		return $this -> id;
	}

	public function setId($value){
		$this -> id = $value;
	}

	public function getLogin(){
		return $this -> login;
	}

	public function setLogin($value){
		$this -> login = $value;
	}

	public function getSenha(){
		return $this -> senha;
	}

	public function setSenha($value){
		$this -> senha = $value;
	}

	public function getDtcadastro(){
		return $this -> dtcadastro;
	}

	public function setDtcadastro($value){
		$this -> dtcadastro = $value;
	}

	public function loadById($id){
		
		$sql = new Sql();
		$results = $sql -> select("SELECT * FROM users WHERE id = :ID", array(
			":ID"=>$id
		));
		
		if(count($results) > 0){
			$this->setData($results[0]);
		}

	}

	//Método static não precisa ser instanciado
	public static function getList(){

		$sql = new Sql();
		return $sql -> select("SELECT * FROM users ORDER BY login");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql -> select("SELECT * FROM users WHERE login LIKE :SEARCH ORDER BY login", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login,$password){
		$sql = new Sql();
		$results = $sql -> select("SELECT * FROM users WHERE login = :LOGIN AND senha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));
		
		if(count($results) > 0){

			$this->setData($results[0]);			
			
		}else{
			throw new Exception("Login e/ou senha inválidos!");
		}
	}

	public function setData($data){
		$this -> setId($data['id']);
		$this -> setLogin($data['login']);
		$this -> setSenha($data['senha']);
		$this -> setDtcadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){
		$sql = new Sql();
		$results = $sql ->select("CALL sp_users_insert(:LOGIN, :PASSWORD)",array(
			':LOGIN'=>$this->getLogin(),
			':PASSWORD'=>$this->getSenha()
		));

		if(count($results) > 0){
			$this->setData($results[0]);
		}
	}

	public function update($login,$password){

		$this -> setLogin($login);
		$this -> setSenha($password);

		$sql = new Sql();
		$sql -> query("UPDATE users SET login = :LOGIN, senha = :PASSWORD WHERE id = :ID",array(
			":ID"=>$this->getId(),
			":LOGIN"=>$this->getLogin(),
			":PASSWORD"=>$this->getSenha()
		));
	}

	public function delete(){
		$sql = new Sql();
		$sql -> query("DELETE FROM users WHERE id = :ID",array(
			":ID"=>$this->getId()
		));

		$this->setId(0);
		$this->setLogin("");
		$this->setSenha("");
		$this->setDtcadastro(new DateTime());
	}

	public function __construct($login = "",$password = ""){
		$this -> setLogin($login);
		$this -> setSenha($password);
	}

	public function __toString(){

		return json_encode(array(
			"iduser" => $this -> getId(),
			"deslogin" => $this -> getLogin(),
			"dessenha" => $this -> getSenha(),
			"dtcadastro" => $this -> getDtcadastro()->format("d/m/Y H:i:s")
		));
	}


}






?>