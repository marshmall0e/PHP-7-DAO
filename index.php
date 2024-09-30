<?php 

require_once 'class/config.php';

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

//Carrega apenas um usuário
//$root = new Usuario();
//$root->loadById(22);
//echo $root;

//Carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuarios buscando pelo login
//$search =  Usuario::search("li");
//echo json_encode($search);

//Carrega um usuário usando o login e senha 
$usuario = new Usuario();

$usuario->login("marshmall0e", "onmyown123");

echo $usuario;
?>