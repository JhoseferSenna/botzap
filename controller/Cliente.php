<?php

  include('../model/Cliente.php');

  $r = array("resposta" => "0");

    if(!empty($_POST['action']))
    {
        switch($_POST['action'])
        {
            case 'login':

                $c = new Cliente;

                $c->setLogin($_POST['login']);
                $c->setSenha($_POST['senha']);

                if($c->login())
                {   
                    $c->read();

                    session_start();
                    $_SESSION['idcliente'] = $c->getId();
                    $_SESSION['login'] = $c->getLogin();
                    $_SESSION['senha'] = $_POST['senha'];
                }
                else
                {
                    $r = array("resposta" => "-1"); 
                }

            break;


            case 'primeiro-login':

                $c = new Cliente();

                $c->setLogin($_POST['login']); 
                $c->setSenha('');
                $c->descobreId();
                $c->read();

                if(!empty($c->getId()) && $c->getStatus() == 0)
                {
                    $r = array("resposta" => $c->getId());
                }
                else
                {
                    $r = array("resposta" => "-1");
                }

            break;

            case 'cadLoginSenha':

                $c = new Cliente();

                $c->setId($_POST['id']);

                if($c->read())
                {
                    $c->setLogin($_POST['login']); 
                    $c->setSenha($_POST['senha']);
                    $c->setStatus(1);

                    if($c->update())
                    {
                        $r = array("resposta" => "1");

                        session_start();
                        $_SESSION['idcliente'] = $c->getId();
                        $_SESSION['login'] = $c->getLogin();
                        $_SESSION['senha'] = $_POST['senha'];
                    }
                }

            break;

            case 'cad-menu':

                require('../model/Menu.php');
                session_start();

                $m = new Menu();

                $m->setNome($_POST['menu']);
                $m->setIdCliente($_SESSION['cliente']->getId());

                if($m->create())
                {
                    $r = array("resposta" => "1");
                }

            break;

            case 'list-menu':

                require('../model/Menu.php');
                session_start();

                $m = new Menu();
                $m->setIdCliente($_SESSION['cliente']->getId());

                if(!empty($m->list()))
                {
                    $r = $m->list();
                }

            break;
        }
    }

    echo json_encode($r);


?>
