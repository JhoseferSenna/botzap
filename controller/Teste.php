<?php
    
    $cliente = 1; // DADOS GERADOS PARA TESTE

    /*

        TUDO FUNCIONANDO AQUI, PARTIR AGORA PARA A VIEW

    */

    include('../model/Menu.php');

    $m = new Menu();

    $m->setId(1);
    $m->read();

    $m->updateItensOpcoes();
?>