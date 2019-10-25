<?php

  class Plano {
    private $id;
    private $nome;
    private $valorMensal;
    private $qtdUsuarios;

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
  
    public function getValorMensal(){
      return $this->valorMensal;
    }
  
    public function setValorMensal($valorMensal){
      $this->valorMensal = $valorMensal;
    }
  
    public function getQtdUsuarios(){
      return $this->qtdUsuarios;
    }
  
    public function setQtdUsuarios($qtdUsuarios){
      $this->qtdUsuarios = $qtdUsuarios;
    }

     // CRUD
     public function create()
     {
         try
         {
             require('Database.php');

             $sql = 'INSERT INTO plano (nome, valormensal, qtdusuarios) VALUES (?,?,?)';

             $stmt = $conn->prepare($sql);
             $stmt->bindParam(1, $this->nome);
             $stmt->bindParam(2, $this->valorMensal);
             $stmt->bindParam(3, $this->qtdUsuarios);

             $stmt->execute();

             return 1;
         }
         catch (PDOException $e)
         {
             return $e->getMessage();
         }
     }

     public function read()
        {
            try
            {
                require('Database.php');

                $sql = 'SELECT * FROM plano WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->nome = $dados['nome'];
                $this->valorMensal = $dados['valormensal'];
                $this->qtdUsuarios = $dados['qtdusuarios'];

                // $this->carregaItens();

                return 1;
            }
            catch (PDOException $e)
            {
                return $e->getMessage();
            }
        }

        public function update()
        {
            try
            {
                require('Database.php');

                $sql = 'UPDATE plano SET nome = ?, valormensal = ?, qtdusuarios = ? WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->nome);
                $stmt->bindParam(2, $this->valorMensal);
                $stmt->bindParam(3, $this->qtdUsuarios);
                $stmt->bindParam(4, $this->id);

                $stmt->execute();

                return 1;
            }
            catch (PDOException $e)
            {
                return $e->getMessage();
            }
        }

        public function delete(){

          try
          {
            include('Database.php');
            $sql = "DELETE FROM plano WHERE id = ?";
    
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
  }

?>