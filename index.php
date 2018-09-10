<?php

require_once("config.php");

/*
//Carrega um usuario
$user = new Usuario();
$user -> loadById(2);
echo $user;

//Carrega uma lista de usuarios
$lista = Usuario::getList();
echo json_encode($lista);

//Carrega uma lista de usuarios buscando pelo login
$search = Usuario::search("a");
echo json_encode($search);


//Carrega um usuario usando o login e a senha
$usuario = new Usuario();
$usuario ->login("admin","admin");

echo $usuario;


//Cria um novo usuario
$aluno = new Usuario("BOLSONARO","2018");
$aluno -> insert();
echo $aluno;
*/

$usuario = new Usuario();
$usuario -> loadById(5);
$usuario -> update("OBAAAA","HERHHEHE");
echo $usuario;
?>