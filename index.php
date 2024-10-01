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
//$usuario = new Usuario();
//$usuario->login("marshmall0e", "onmyown123");
//echo $usuario;


/*Criando um novo usuario
$aluno = new Usuario();


// Usar o método setData para definir um array associativo
$data = [
    'deslogin' => 'aluno',
    'dessenha' => '@lun0',
];

// O método setData foi modificado para aceitar um array diretamente
$aluno->setData($data);

// Inserindo o usuário no banco de dados
$aluno->insert();

// Mostrando os dados do usuário recém-inserido
echo $aluno;*/

$usuario = new Usuario();

$usuario->loadById(27);

$usuario->update("professor", "!@#$%¨&*()");

echo $usuario;
?>