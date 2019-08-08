<?php
  class Usuario {
    //atributos
    private $id;
    private $idCliente;
    private $numero;
    private $login;
    private $senha;

    public function getId(){
      return $this->id;
    }
  
    public function setId($id){
      $this->id = $id;
    }
  
    public function getIdCliente(){
      return $this->idCliente;
    }
  
    public function setIdCliente($idCliente){
      $this->idCliente = $idCliente;
    }
  
    public function getNumero(){
      return $this->numero;
    }
  
    public function setNumero($numero){
      $this->numero = $numero;
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
        $sql = "INSERT INTO usuario (idCliente, numero, login, senha) VALUES (?, ?, ?, ?)";

        $stmtInserir = $con->prepare($sql);

        $stmtInserir->bindParam(1, $this->idCliente);
        $stmtInserir->bindParam(2, $this->numero);
        $stmtInserir->bindParam(3, $this->login);
        $stmtInserir->bindParam(4, $this->senha);

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
        $sql = "SELECT * FROM usuario WHERE id=?";

        $stmtConsulta = $con->prepare($sql);

        $stmtConsulta->bindParam(1, $this->id);

        $stmtConsulta->execute();

        $dadosUsuario = $stmtConsulta->fetch(PDO::FETCH_ASSOC);

        $this->idCliente = $dadosUsuario['idCliente'];
        $this->numero =  $dadosUsuario['numero'];
        $this->login =  $dadosUsuario['login'];
        $this->senha =  $dadosUsuario['senha'];

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
        $sql = "UPDATE usuario SET idCliente = ?, numero = ?, login = ?, senha = ? WHERE id=?";

        $stmtEdita = $con->prepare($sql);

        $stmtEdita->bindParam(1, $this->idCliente);
        $stmtEdita->bindParam(2, $this->numero);
        $stmtEdita->bindParam(3, $this->login);
        $stmtEdita->bindParam(4, $this->senha);
        $stmtEdita->bindParam(5, $this->id);

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
        $sql = "DELETE FROM usuario WHERE id = ?";

        $stmtEdita = $con->prepare($sql);

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
                $sql = "SELECT id FROM usuario WHERE idCliente = ? AND numero =? AND login = ? AND senha = ?";

                // Operações no BD

                // Preparar SQL
                $stmtId = $con->prepare($sql);

                // Popular Parâmetros
                $stmtId->bindParam(1, $this->idCliente);
                $stmtId->bindParam(2, $this->numero);
                $stmtId->bindParam(3, $this->login);
                $stmtId->bindParam(4, $this->senha);

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
        $sql = "SELECT * FROM usuario";

        $stmtLista = $con->prepare($sql);

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
      'idCliente' => $this->idCliente,
      'numero' => $this->numero,
      'login' => $this->login,
      'senha' => $this->senha
      );
      return json_encode($dados);
    }

    public function login() {

      try
      {
          include('Database.php');

          $sql = "SELECT id FROM usuario WHERE login = ? AND senha = ?";

          $stmtId = $con->prepare($sql);

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