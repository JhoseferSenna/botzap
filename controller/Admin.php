<?php

  include('../model/Admin.php');
  

  $r = array("resposta" => "0");

    if(!empty($_POST['action']))
    {
        switch($_POST['action'])
        {
            case 'login':

                $a = new Admin();

                $a->setLogin($_POST['login']);
                $a->setSenha($_POST['senha']);
                // var_dump($a->login());            
                if($a->login())
                {   
                    $a->read();

                    session_start();
                    $_SESSION['id'] = $a->getId();
                    $_SESSION['login'] = $a->getLogin();
                    $_SESSION['senha'] = $_POST['senha'];
                }
                else
                {
                    $r = array("resposta" => "-1"); 
                }

            break;


            case 'primeiro-login':

                $a = new Admin();

                $a->setLogin($_POST['login']); 
                $a->setSenha('');
                $a->descobreId();
                $a->read();

                if(!empty($a->getId()) && $a->getStatus() == 0)
                {
                    $r = array("resposta" => $a->getId());
                }
                else
                {
                    $r = array("resposta" => "-1");
                }

            break;

            case 'cadLoginSenha':

                $a = new Admin();

                $a->setId($_POST['id']);

                if($a->read())
                {
                    $a->setLogin($_POST['login']); 
                    $a->setSenha($_POST['senha']);
                    $a->setStatus(1);

                    if($a->update())
                    {
                        $r = array("resposta" => "1");

                        session_start();
                        $_SESSION['id'] = $a->getId();
                        $_SESSION['login'] = $a->getLogin();
                        $_SESSION['senha'] = $_POST['senha'];
                    }
                }

            break;

            case 'cad-cliente':

                require('../model/Cliente.php');
                session_start();

                $c = new Cliente();

                $c->setNome($_POST['nome']);
                $c->setEmail($_POST['email']);

                if($c->create())
                {
                    $r = array("resposta" => "1");
                }

            break;

            case 'list-cliente':

                require('../model/Cliente.php');
                session_start();

                $c = new Cliente();

                if(!empty($c->lista()))
                {
                    $r = $c->lista();
                }

            break;

            case 'EXCLUI_CLIENTE':
                require('../model/Cliente.php');
                session_start();
                $c = new Cliente();
                $c->setId($_POST['id']);
                $c->delete();
                $r = array('result' => $_POST['action']);
            break;

            case 'CARREGA_CLIENTE':
                require('../model/Cliente.php');
                // session_start();
                $c = new Cliente();
                $c->setId($_POST['id']);
                $c->read();
                $r = $c->paraJson();
                
            break;

            case 'ATUALIZA_CLIENTE':
                require('../model/Cliente.php');
                session_start();
                $c = new Cliente();
                $c->setId($_POST['id']);
                $c->setNome($_POST['nome']);
                $c->setLogin($_POST['login']);
                $c->setEmail($_POST['email']);
                $c->setSenha($_POST['senha']);
                $c->update();
                $r = array('result' => $_POST['action']);
            break;
        }
    }

    echo json_encode($r);


?>
