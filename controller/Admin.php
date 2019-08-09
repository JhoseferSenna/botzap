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
        }
    }

    echo json_encode($r);


?>
