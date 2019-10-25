<?php

    class Opcao
    {
        //Atributos

        private $id;
        private $idCliente;
        private $idMenu;
        private $nome;
        
        private $idResposta = 0;
        private $menuResposta = 0;

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

        public function getIdMenu()
        {
            return $this->idMenu;
        }

        public function setIdMenu($idMenu)
        {
            $this->idMenu = $idMenu;
        }

        public function getIdResposta()
        {
            return $this->idResposta;
        }

        public function setIdResposta($idResposta)
        {
            $this->idResposta = $idResposta;
        }

        public function getMenuResposta()
        {
            return $this->menuResposta;
        }

        public function setMenuResposta($menuResposta)
        {
            $this->menuResposta = $menuResposta;
        }

        // CRUD
        public function create()
        {
            try
            {
                require('Database.php');

                $sql = 'INSERT INTO opcao (idcliente, nome, idmenu, idresposta, menuresposta) VALUES (?, ?, ?, ?, ?)';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->idCliente);
                $stmt->bindParam(2, $this->nome);
                $stmt->bindParam(3, $this->idMenu);
                $stmt->bindParam(4, $this->idResposta);
                $stmt->bindParam(5, $this->menuResposta);

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

                $sql = 'SELECT * FROM opcao WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->idCliente = $dados['idcliente'];
                $this->idMenu = $dados['idmenu'];
                $this->nome = $dados['nome'];
                $this->idResposta = $dados['idresposta'];
                $this->menuResposta = $dados['menuResposta'];

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

                $sql = 'UPDATE opcao SET nome = ?, idmenu = ?, idresposta = ?, menuresposta = ? WHERE id = ?';

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $this->nome);
                $stmt->bindParam(2, $this->idMenu);
                $stmt->bindParam(3, $this->idResposta);
                $stmt->bindParam(4, $this->menuResposta);
                $stmt->bindParam(5, $this->id);

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

                $sql = 'DELETE FROM opcao WHERE id = ?';

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

                $sql = 'SELECT opcao.nome, (menu.nome) menu, (resposta.nome) resposta,  idresposta FROM opcao, menu, resposta WHERE opcao.idcliente = ? AND opcao.idmenu = menu.id';

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