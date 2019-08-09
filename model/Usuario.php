<?php

    class Usuario
    {
        //Atributos

        private $id;
        private $idCliente;
        private $nome;

        private $login;
        private $senha;

        // Getters & Setters
        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getIdCliente()
        {
            return $this->idCliente;
        }

        public function setIdCliente($idCliente)
        {
            $this->idCliente = $idCliente;
        }
        public function getNome()
        {
            return $this->nome;
        }

        public function setNome($nome)
        {
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
      
            if($senha != '')
            {
              $cryptoSenha = md5(sha1($senha));
      
              $this->senha =  $cryptoSenha;
            }
            
        }

        // CRUD
        public function create()
        {
            try
            {
                require('Database.php');

                $sql = 'INSERT INTO usuario (idcliente, nome, login, senha) VALUES (?, ?, ?, ?)';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->idCliente);
                $stmt->bindParam(2, $this->nome);
                $stmt->bindParam(3, $this->login);
                $stmt->bindParam(4, $this->senha);

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

                $sql = 'SELECT * FROM usuario WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->idCliente = $dados['idcliente'];
                $this->nome = $dados['nome'];
                $this->login = $dados['login'];
                $this->senha = $dados['senha'];

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

                $sql = 'UPDATE usuario SET nome = ?, login = ?, senha = ? WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->nome);
                $stmt->bindParam(2, $this->login);
                $stmt->bindParam(3, $this->senha);
                $stmt->bindParam(<i class="fas fa-signal-4    "></i>, $this->id);

                $stmt->execute();

                return 1;
            }
            catch (PDOException $e)
            {
                return $e->getMessage();
            }
        }

        public function delete()
        {
            try
            {
                $this->read();

                require('Database.php');

                $sql = 'DELETE usuario WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                return 1;
            }
            catch (PDOException $e)
            {
                return $e->getMessage();
            }
        }

        // FUNÇÕES EXTRAS

        public function list()
        {
            try
            {
                require('Database.php');

                $sql = 'SELECT * FROM usuario WHERE idcliente = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->idCliente);

                $stmt->execute();

                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $lista;
            }
            catch (PDOException $e)
            {
                return $e->getMessage();
            }
        }
    }

?>