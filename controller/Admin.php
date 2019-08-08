<?php

  include('../model/Admin.php');
  

  $r = array("resposta" => "0");

    if(!empty($_POST['action']))
    {
        switch($_POST['action'])
        {
            case 'login':

                $a = new Admin;

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
                        $_SESSION['admin'] = $a->getId();
                        $_SESSION['login'] = $a->getLogin();
                        $_SESSION['senha'] = $_POST['senha'];
                    }
                }

            break;

            case 'cad-menu':

                require('../model/Menu.php');
                session_start();

                $m = new Menu();

                $m->setNome($_POST['menu']);
                $m->setIdCliente($_SESSION['admin']->getId());

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
