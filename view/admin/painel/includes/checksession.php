<?php

    session_start();

    if(empty($_SESSION['admin']))
    {
        header("Location: ../index.html");
    }
    else
    {
        require ('../../model/Admin.php');
        $a = new Admin();
    
        $a->setLogin($_SESSION['login']);
        $a->setSenha($_SESSION['senha']);

        if($a->login())
        {   
            $a->read();
            
            if($_SESSION['id'] == $a->getId())
            {
                $_SESSION['admin'] = $a;
            }
        }
        else
        {
            unset($_SESSION);
            header("Location: ../../index.html");
        }
    }

?>