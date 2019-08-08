<?php

    require('Item.php');

    class Menu
    {
        //Atributos

        private $id;
        private $idCliente;
        private $nome;
        private $itens = array();

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

        public function addItem($item)
        {
            array_push($this->itens, $item);
        }

        public function getItens()
        {
            return $this->itens;
        }

        // CRUD
        public function create()
        {
            try
            {
                require('Database.php');

                $sql = 'INSERT INTO menu (idcliente, nome) VALUES (?, ?)';

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

                $sql = 'SELECT * FROM menu WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->idCliente = $dados['idcliente'];
                $this->nome = $dados['nome'];

                $this->carregaItens();

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

                $sql = 'UPDATE menu SET nome = ? WHERE id = ?';

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

                $sql = 'DELETE menu WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                foreach($this->itens as $item)
                {
                    $item->delete();
                }

                return 1;
            }
            catch (PDOException $e)
            {
                return $e->getMessage();
            }
        }

        // DEPENDÊNCIAS DO CRUD

        public function carregaItens()
        {
            try
            {
                require('Database.php');

                $sql = 'SELECT * FROM item WHERE idmenu = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                unset($this->itens);
                $this->itens = array();

                foreach($dados as $i)
                {
                    $item = new Item();

                    $item->setId($i['id']);
                    $item->read();

                    array_push($this->itens, $item);
                }

                $this->updateItensOpcoes();

                return 1;
            }
            catch (PDOException $e)
            {
                return $e->getMessage();
            }
        }

        public function updateItensOpcoes()
        {
            foreach($this->itens as $opcao => $item)
            {
                $item->setOpcao($opcao + 1);
                $item->update();
            }
        }

        // FUNÇÕES EXTRAS

        public function list()
        {
            try
            {
                require('Database.php');

                $sql = 'SELECT * FROM menu WHERE idcliente = ?';

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