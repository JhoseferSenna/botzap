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

            case 'cad-resposta':

                require('../model/Resposta.php');
                session_start();

                $res = new Resposta();

                $res->setNome($_POST['resposta']);
                $res->setIdCliente($_SESSION['cliente']->getId());

                if($res->create())
                {
                    $r = array("resposta" => "1");
                }

            break;

            case 'list-resposta':

                require('../model/Resposta.php');
                session_start();

                $res = new Resposta();
                $res->setIdCliente($_SESSION['cliente']->getId());

                if(!empty($res->list()))
                {
                    $r = $res->list();
                }

            break;

            case 'cad-opcao':

                require('../model/Opcao.php');
                session_start();

                $res = new Opcao();

                $res->setNome($_POST['opcao']);
                $res->setIdCliente($_SESSION['cliente']->getId());
                $res->setIdMenu($_POST['idmenu']);

                if($_POST['acao-resposta'] == 'resposta')
                {
                    $res->setIdResposta($_POST['resposta']);
                }
                else if($_POST['acao-resposta'] == 'menu-destino')
                {
                    $res->setMenuResposta($_POST['menu-destino']);
                }

                if($res->create())
                {
                    $r = array("resposta" => "1");
                }

            break;

            case 'list-opcao':

                require('../model/Opcao.php');
                session_start();

                $res = new Opcao();
                $res->setIdCliente($_SESSION['cliente']->getId());

                if(!empty($res->list()))
                {
                    $r = $res->list();
                }

            break;

            case 'cad-usuario':

                require('../model/Usuario.php');
                session_start();

                $u = new Usuario();

                $u->setNome($_POST['usuario']);
                $u->setLogin($_POST['login']);
                $u->setSenha($_POST['senha']);
                $u->setIdCliente($_SESSION['cliente']->getId());

                if($u->create())
                {
                    $r = array("resposta" => "1");
                }

            break;

            case 'list-usuario':

                require('../model/Usuario.php');
                session_start();

                $u = new Usuario();
                $u->setIdCliente($_SESSION['cliente']->getId());

                if(!empty($u->list()))
                {
                    $r = $u->list();
                }

            break;
        }
    }

    echo json_encode($r);


?>
