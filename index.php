<?php 

require_once 'class/config.php';

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

$root = new Usuario();

$root->loadById(22);


echo $root;

?>