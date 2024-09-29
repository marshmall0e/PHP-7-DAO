<?php 

class Sql extends PDO {
    private $conn;

    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp8", "root", "");
    }

    private function setParams($statement, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value){
        $statement->bindParam($key, $value);
    }

    public function execQuery($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array()): array {
        $stmt = $this->execQuery($rawQuery, $params); // Use execQuery aqui 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>


<!-- Explicação das Mudanças
Uso do Método execQuery:

Alterei a chamada em select para usar o método execQuery em vez de query. O método execQuery foi criado especificamente para lidar com a execução de consultas preparadas e o vinculo de parâmetros. Assim, você evita a chamada incorreta ao método query.

Correção de Nomes:

A variável $statment foi corrigida para $statement em todo o código para evitar erros de digitação.

Conexão ao Banco de Dados:

A string de conexão agora inclui dbname=dbphp8, garantindo que o banco de dados seja corretamente especificado.

Conceitos Importantes

Preparação e Execução de Consultas:

O método prepare é usado para preparar uma consulta SQL. A execução é feita com execute, onde você pode vincular parâmetros para evitar injeção de SQL.

Método fetchAll:

O método fetchAll(PDO::FETCH_ASSOC) é usado para obter todos os resultados da consulta em um array associativo, onde as chaves são os nomes das colunas.

Organização do Código:

Separar a lógica de execução da consulta (execQuery) da lógica de seleção (select) ajuda a manter o código limpo e mais fácil de manter. -->
