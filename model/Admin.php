<?php
  class Admin {
    //atributos
    private $id;
    private $nome;
    private $login;
    private $senha;

    public function getId(){
      return $this->id;
    }
  
    public function setId($id){
      $this->id = $id;
    }
  
    public function getNome(){
      return $this->nome;
    }
  
    public function setNome($nome){
      $this->nome = $nome;
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

      $cryptoSenha = md5(sha1($senha));

      $this->senha =  $cryptoSenha;
  }

    public function setSenhaSessao($senha){

      $this->senha =  $senha;
    }

    public function create() {
      try
      {
        include('Database.php');
        $sql = "INSERT INTO admin (nome, login, senha) VALUES (?, ?, ?)";

        $stmtInserir = $conn->prepare($sql);

        $stmtInserir->bindParam(1, $this->nome);
        $stmtInserir->bindParam(2, $this->login);
        $stmtInserir->bindParam(3, $this->senha);

        $stmtInserir->execute();

        $this->descobreId();

        return 1;
      }
      catch(PDOException $e)
            {
                return "Erro: " . $e->getMessage();
            }
    }

    public function read(){

      try
      {
        include('Database.php');
        $sql = "SELECT * FROM admin WHERE id=?";

        $stmtConsulta = $conn->prepare($sql);

        $stmtConsulta->bindParam(1, $this->id);

        $stmtConsulta->execute();

        $dadosAdmin = $stmtConsulta->fetch(PDO::FETCH_ASSOC);

        $this->nome =  $dadosAdmin['nome'];
        $this->login =  $dadosAdmin['login'];
        $this->senha =  $dadosAdmin['senha'];

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
        $sql = "UPDATE admin SET nome = ?, login = ?, senha = ? WHERE id=?";

        $stmtEdita = $conn->prepare($sql);

        $stmtEdita->bindParam(1, $this->nome);
        $stmtEdita->bindParam(2, $this->login);
        $stmtEdita->bindParam(3, $this->senha);
        $stmtEdita->bindParam(4, $this->id);

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
        $sql = "DELETE FROM admin WHERE id = ?";

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
                $sql = "SELECT id FROM admin WHERE nome = ? AND login = ? AND senha = ?";

                // Operações no BD

                // Preparar SQL
                $stmtId = $conn->prepare($sql);

                // Popular Parâmetros
                $stmtId->bindParam(1, $this->nome);
                $stmtId->bindParam(2, $this->login);
                $stmtId->bindParam(3, $this->senha);

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
        $sql = "SELECT * FROM admin";

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
      'nome' => $this->nome,
      'login' => $this->login,
      'senha' => $this->senha
      );
      return json_encode($dados);
    }

    public function login() {

      try
      {
          include('Database.php');

          $sql = "SELECT id FROM admin WHERE login = ? AND senha = ?";

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