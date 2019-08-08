<?php

    class Item
    {
        // Atributos
        private $id;
        private $idMenu;
        private $nome;
        private $opcao;

        // Getters & Setters
        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getIdMenu(){
            return $this->idMenu;
        }
    
        public function setIdMenu($idMenu){
            $this->idMenu = $idMenu;
        }
    
        public function getNome(){
            return $this->nome;
        }
    
        public function setNome($nome){
            $this->nome = $nome;
        }
    
        public function getOpcao(){
            return $this->opcao;
        }
    
        public function setOpcao($opcao){
            $this->opcao = $opcao;
        }

        // CRUD
        public function create()
        {
            try
            {
                require('Database.php');

                $sql = 'INSERT INTO item (idmenu, nome, opcao) VALUES (?, ?, ?)';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->idMenu);
                $stmt->bindParam(2, $this->nome);
                $stmt->bindParam(3, $this->opcao);

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

                $sql = 'SELECT * FROM item WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->idMenu = $dados['idmenu'];
                $this->nome = $dados['nome'];
                $this->opcao = $dados['opcao'];

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

                $sql = 'UPDATE item SET idmenu = ?, nome = ?, opcao = ? WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->idMenu);
                $stmt->bindParam(2, $this->nome);
                $stmt->bindParam(3, $this->opcao);
                $stmt->bindParam(4, $this->id);

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
                require('Database.php');

                $sql = 'DELETE FROM item WHERE id = ?';

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
    }

?>