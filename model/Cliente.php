<?php
  class Cliente {

    private $id;
    private $idVendedor;
    private $idPlano;
    private $nome;
    private $dataCad;
    private $email;
    private $login;
    private $senha = '';
    private $status = 0;

    public function getId(){
      return $this->id;
    }
  
    public function setId($id){
      $this->id = $id;
    }
  
    public function getIdVendedor(){
      return $this->idVendedor;
    }
  
    public function setIdVendedor($idVendedor){
      $this->idVendedor = $idVendedor;
    }
  
    public function getIdPlano(){
      return $this->idPlano;
    }
  
    public function setIdPlano($idPlano){
      $this->idPlano = $idPlano;
    }
  
    public function getNome(){
      return $this->nome;
    }
  
    public function setNome($nome){
      $this->nome = $nome;
    }
  
    public function getDataCad(){
      return $this->dataCad;
    }
  
    public function setDataCad($dataCad){
      $this->dataCad = $dataCad;
    }
  
    public function getEmail(){
      return $this->email;
    }
  
    public function setEmail($email){
      $this->email = $email;
    }
  
    public function getLogin(){
      return $this->login;
    }
  
    public function setLogin($login){
      $this->login = $login;
    }
  
    public function getSenha(){
      return $this->senha;
    }
  
    public function setSenha($senha){

      if($senha != '')
      {
        $cryptoSenha = md5(sha1($senha));

        $this->senha =  $cryptoSenha;
      }
      
  }

    public function setSenhaSessao($senha){

      $this->senha =  $senha;
    }
  
    public function getStatus(){
      return $this->status;
    }
  
    public function setStatus($status){
      $this->status = $status;
    }
  

    public function create() {
      try
      {
        if($this->senha == '')
        {
          $this->login = $this->email;
        }


        include('Database.php');

        $sql = "INSERT INTO cliente (idvendedor, idplano, nome, datacad, email, login, senha, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtInserir = $conn->prepare($sql);

        $stmtInserir->bindParam(1, $this->idVendedor);
        $stmtInserir->bindParam(2, $this->idPlano);
        $stmtInserir->bindParam(3, $this->nome);
        $stmtInserir->bindParam(4, $this->dataCad);
        $stmtInserir->bindParam(5, $this->email);
        $stmtInserir->bindParam(6, $this->login);
        $stmtInserir->bindParam(7, $this->senha);
        $stmtInserir->bindParam(8, $this->status);


        $stmtInserir->execute();

        $this->descobreId();

        return 1;
      }
      catch(PDOException $e)
            {
                return "Erro: " . $e->getMessage();
            }
    }

    public function read() {
      try
      {
        include('Database.php');
        $sql = "SELECT * FROM cliente WHERE id=?";

        $stmtConsulta = $conn->prepare($sql);

        $stmtConsulta->bindParam(1, $this->id);

        $stmtConsulta->execute();

        $dadosCliente = $stmtConsulta->fetch(PDO::FETCH_ASSOC);

        $this->idVendedor = $dadosCliente['idvendedor'];
        $this->idPlano =  $dadosCliente['idplano'];
        $this->nome =  $dadosCliente['nome'];
        $this->dataCad =  $dadosCliente['datacad'];
        $this->email =  $dadosCliente['email'];
        $this->login =  $dadosCliente['login'];
        $this->senha =  $dadosCliente['senha'];
        $this->status =  $dadosCliente['status'];

        return 1;
      }
      catch(PDOException $e)
            {
                return "Erro: " . $e->getMessage();
            }
    }

    public function update() {
      try
      {
        include('Database.php');
        $sql = "UPDATE cliente SET idvendedor = ?, idplano = ?, nome = ?, datacad = ?, email = ?, login = ?, senha = ?, status = ? WHERE id=?";

        $stmtEdita = $conn->prepare($sql);

        $stmtEdita->bindParam(1, $this->idVendedor);
        $stmtEdita->bindParam(2, $this->idPlano);
        $stmtEdita->bindParam(3, $this->nome);
        $stmtEdita->bindParam(4, $this->dataCad);
        $stmtEdita->bindParam(5, $this->email);
        $stmtEdita->bindParam(6, $this->login);
        $stmtEdita->bindParam(7, $this->senha);
        $stmtEdita->bindParam(8, $this->status);
        $stmtEdita->bindParam(9, $this->id);

        $stmtEdita->execute();

        return 1;
      }
      catch(PDOException $e)
            {
                return "Erro: " . $e->getMessage();
            }
    }

    public function delete(){

      try
      {
        include('Database.php');
        $sql = "DELETE FROM cliente WHERE id = ?";

        $stmtEdita = $conn->prepare($sql);

        $stmtEdita->bindParam(1, $this->id);


        $stmtEdita->execute();


        return 1;
      }
      catch(PDOException $e)
            {
                return "Erro: " . $e->getMessage();
            }

    }

    public function descobreId() {
      try
            {
                include('Database.php');

                // Comando SQL
                $sql = "SELECT id FROM cliente WHERE login = ? AND senha = ?";

                // Operações no BD

                // Preparar SQL
                $stmtId = $conn->prepare($sql);

                // Popular Parâmetros
                $stmtId->bindParam(1, $this->login);
                $stmtId->bindParam(2, $this->senha);

                // Executar Comando
                $stmtId->execute();

                $novoId = $stmtId->fetch(PDO::FETCH_ASSOC)['id'];

                $this->id = $novoId;

                return 1;
            }
            catch(PDOException $e)
            {
                return "Erro: " . $e->getMessage();
            }
    }

    public function lista() {
      
      try
      {
        include('Database.php');
        $sql = "SELECT * FROM cliente";

        $stmtLista = $conn->prepare($sql);

        $stmtLista->execute();

        $dados = $stmtLista->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
      }
      catch(PDOException $e)
            {
                return "Erro: " . $e->getMessage();
            }
    }

    public function listaJson() {
      return json_encode($this->lista());
    }

    public function paraJson(){
      $dados = array(
      'id' => $this->id,
      'idvendedor' => $this->idVendedor,
      'idplano' => $this->idPlano,
      'nome' => $this->nome,
      'datacad' => $this->dataCad,
      'email' => $this->email,
      'login' => $this->login,
      'senha' => $this->senha,
      'status' => $this->status,
      );
      return json_encode($dados);
    }

    public function paraArray()
    {
      $dados = array(
        'id' => $this->id,
        'idvendedor' => $this->idVendedor,
        'idplano' => $this->idPlano,
        'nome' => $this->nome,
        'datacad' => $this->dataCad,
        'email' => $this->email,
        'login' => $this->login,
        'senha' => $this->senha,
        'status' => $this->status,
        );
        return $dados;
    }

    public function login() {

      try
      {
          include('Database.php');

          $sql = "SELECT id FROM cliente WHERE login = ? AND senha = ?";

          $stmtId = $conn->prepare($sql);

          $stmtId->bindParam(1, $this->login);
          $stmtId->bindParam(2, $this->senha);
          $stmtId->execute();

          $dados = $stmtId->fetch(PDO::FETCH_ASSOC);

          if(!empty($dados)) {
            $this->id = $dados ['id'];
            return 1;
          }else{
            return 0;
          }

          
      }
      catch(PDOException $e)
      {
          return "Erro: " . $e->getMessage();
      }

    }

  }

?>