<?php

    session_start();

    if(empty($_SESSION['idcliente']))
    {
        header("Location: ../../index.html");
    }
    else
    {
        require ('../../model/Cliente.php');
        $c = new Cliente();
    
        $c->setLogin($_SESSION['login']);
        $c->setSenha($_SESSION['senha']);

        if($c->login())
        {   
            $c->read();
            
            if($_SESSION['idcliente'] == $c->getId())
            {
                $_SESSION['cliente'] = $c;
            }
        }
        else
        {
            unset($_SESSION);
            header("Location: ../../index.html");
        }
    }

?>