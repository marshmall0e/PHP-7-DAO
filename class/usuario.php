<?php 

class Usuario {

    private $idusuarios;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    // Métodos de acesso (getters e setters)
    public function getIdusuarios() {
        return $this->idusuarios;
    }
    
    public function setIdusuarios($value) {
        $this->idusuarios = $value;
    }

    public function getDeslogin() {
        return $this->deslogin;
    }
    
    public function setDeslogin($value) {
        $this->deslogin = $value;
    }

    public function getDessenha() {
        return $this->dessenha;
    }
    
    public function setDessenha($value) {
        $this->dessenha = $value;
    }

    public function getDtcadastro() {
        return $this->dtcadastro;
    }
    
    public function setDtcadastro($value) {
        $this->dtcadastro = $value;
    }

    // Carrega um usuário pelo ID
    public function loadById($id) {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    // Obtém a lista de usuários
    public static function getList() {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
    }

    // Busca usuários pelo login
    public static function search($login) {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH' => "%" . $login . "%"
        ));
    }

    // Faz // Faz login do usuário
    public function login($login, $password) {
    $sql = new Sql();
    $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
        ":LOGIN" => $login,
        ":PASSWORD" => $password
    ));

    // Adicionando var_dump para depuração
    var_dump($results); // Veja o que está sendo retornado

    if (is_array($results) && count($results) > 0) {
        $this->setData($results[0]);
    } else {
        throw new Exception("Login e/ou senha inválidos.");
        }
    }


    
    // Define os dados do usuário
    /*public function setData($data) {
    if (is_array($data) && isset($data['idusuario'], $data['deslogin'], $data['dessenha'], $data['dtcadastro'])) {
        $this->setIdusuarios($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    } else {
        throw new Exception("Dados inválidos para setData: " . print_r($data, true));
        }
    }*/

    public function setData($data) {
        if (isset($data['deslogin']) && isset($data['dessenha'])) {
            // O id e a data de cadastro não são necessários no momento da inserção
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            // Para o cadastro, podemos definir dtcadastro aqui ou deixá-lo como NULL para o banco de dados tratar
            $this->setDtcadastro(new DateTime()); // Se quiser definir agora
        } else {
            throw new Exception("Dados inválidos para setData: " . print_r($data, true));
        }
    }
    


    // Insere um novo usuário
    public function insert() {
        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha()
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public function update($Login, $password) {
        $this->setDeslogin($Login);
        $this->setDessenha($password);

        $sql = new Sql();
        $sql->execQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
        ':LOGIN'=>$this->getDeslogin(),
        ':PASSWORD'=> $this->getDessenha(),
        ':ID'=>$this->getIdusuarios()
        ));
    }



    public function __construct($login = "", $password = "")
    {
        $this->setDeslogin($login);
        $this->setDessenha($password); // Use setDessenha em vez de setPassword
    }
    

    // Representação do objeto como string
    public function __toString() {
        return json_encode(array(
            "idusuario" => $this->getIdusuarios(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}

?>
