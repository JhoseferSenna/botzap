<?php

    class Resposta
    {
        //Atributos

        private $id;
        private $idCliente;
        private $nome;

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

        // CRUD
        public function create()
        {
            try
            {
                require('Database.php');

                $sql = 'INSERT INTO resposta (idcliente, nome) VALUES (?, ?)';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->idCliente);
                $stmt->bindParam(2, $this->nome);

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

                $sql = 'SELECT * FROM resposta WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->idCliente = $dados['idcliente'];
                $this->nome = $dados['nome'];

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

                $sql = 'UPDATE resposta SET nome = ? WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->nome);
                $stmt->bindParam(2, $this->id);

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

                $sql = 'DELETE resposta WHERE id = ?';

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

                $sql = 'SELECT * FROM resposta WHERE idcliente = ?';

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