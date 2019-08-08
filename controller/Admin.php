<?php

  include('../model/Usuario.php');
  include('../model/Cliente.php');
  include('../model/Admin.php');

  // CREATE //

  // $u = new Usuario();

  // $u->setIdCliente('2');
  // $u->setNumero('22997640769');
  // $u->setLogin('numero2');
  // $u->setSenha('123');

  // if($u->create() == 1)
  // {
  //   echo 'Cadastrado com sucesso';
  // }else{
  //   echo $u->create();
  // }

  // READ // 

  // $u = new Usuario();

  // $u->setId(1);
  
  // if($u->read()){
  //   echo $u->getNumero();
  // }

  // UPDATE //

  // $u = new Usuario();

  // $u->setId(1);
  
  // if($u->read()){
  //   $u->setNumero('22998956688');
  //   if($u->update()){
  //     echo 'Numero Atualizado com sucesso';
  //   }else {
  //     echo $u->update();
  //   }
  // }else{
  //   echo $u->read();
  // }

  // DELETE //

  // $u = new Usuario();

  // $u->setId(2);

  // if($u->delete()){
  //   echo 'Usuario Deletada com Sucesso';
  // }else{
  //   echo $u->delete();
  // }

  // LISTA //

  // $u = new Usuario();

  // $listagem = $u->lista();

  // if(!empty($listagem))
  // {
  //   foreach($listagem as $item){
  //     echo $item['id'] . ' - ' . $item['numero'] . '<br>';
  //   }
  // }else{
  //   echo 'Erro ao listar';
  // }

  // LISTA JSON //

  // $u = new Usuario();

  // echo $u->listaJson();

  // PARA JSON  //

  // $u = new Usuario();

  // $u->setId(1);
  
  // if($u->read()){
  //   echo $u->paraJson();
  // }else{
  //   echo $u->read();
  // }

  // LOGIN //

  // $u = new Usuario;

  // $u->setLogin('numero1');
  // $u->setSenha('123');

  // if($u->login())
  // {
  //   $u->read();

  //   echo 'Bem vindo, ' . $u->getNumero();
  // }else{
  //   echo 'Erramos nessa porra';
  // }

  // LOGIN PAGINA PARA A DASHBOARD //

  // $resposta = json_encode(array('resposta' => 0));

  // if(!empty($_POST['action']))
  // {
  //   switch($_POST['action'])
  //   {
  //     case 'login':
  //       $u = new Usuario;

  //       $u->setLogin($_POST['login']);
  //       $u->setSenha($_POST['senha']);

  //       if($u->login())
  //       {
  //         $u->read();

  //         $resposta = $u->paraJson();
  //       }

  // break;
  //   }
  // }

  // echo $resposta;

  //// Cliente ////

  // CREATE //

  // $c = new Cliente();

  // $c->setIdVendedor('3');
  // $c->setIdPlano('3');
  // $c->setNome('cliente3');
  // $c->setDataCad('2019-08-07');
  // $c->setEmail('cliente3@email.com');
  // $c->setLogin('cliente3');
  // $c->setSenha('123');
  // $c->setStatus('0');
 

  // if($c->create() == 1)
  // {
  //   echo 'Cliente Cadastrado com sucesso';
  // }else{
  //   echo $c->create();
  // }

  // READ // 

  // $c = new Cliente();

  // $c->setId(1);
  
  // if($c->read()){
  //   echo 'Código Vendedor -' . $c->getIdVendedor() . '<br>';
  //   echo 'Código Plano -' . $c->getIdPlano() . '<br>';
  //   echo 'Nome -' . $c->getNome() . '<br>';
  //   echo 'Data de Cadastramento -' . $c->getDataCad() . '<br>';
  //   echo 'E-mail -' . $c->getEmail() . '<br>';
  //   echo 'Login - ' . $c->getLogin() . '<br>';
  //   echo 'Senha -' . $c->getSenha() . '<br>';
  //   echo 'Status -' . $c->getStatus() . '<br>';

  // }

  // UPDATE VERIFICAR FUNCIONAMENTO //

  // $c = new Cliente();

  // $c->setId(3);
  
  // if($c->read()){
  // $c->setIdVendedor('3 mudado');
  // $c->setIdPlano('3 mudado');
  // $c->setNome('Cliente3 mudado');
  // $c->setDataCad('2019-08-07');
  // $c->setEmail('email3');
  // $c->setLogin('cliente3 mudado');
  // $c->setSenha('321');
  // $c->setStatus('1');
  //   if($c->update()){
  //     echo 'Cliente Atualizado com sucesso';
  //   }else {
  //     echo $c->update();
  //   }
  // }else{
  //   echo $c->read();
  // }

  // DELETE //

  // $c = new Cliente();

  // $c->setId(3);

  // if($c->delete()){
  //   echo 'Cliente Deletada com Sucesso';
  // }else{
  //   echo $c->delete();
  // }

  // LISTA //

  // $c = new Cliente();

  // $listagem = $c->lista();

  // if(!empty($listagem))
  // {
  //   foreach($listagem as $item){
  //     echo $item['id'] . ' - ' . $item['nome'] . '<br>';
  //   }
  // }else{
  //   echo 'Erro ao listar';
  // }

  // LISTA JSON //

  // $c = new Cliente();

  // echo $c->listaJson();

  // PARA JSON  //

  // $c = new Cliente();

  // $c->setId(1);
  
  // if($c->read()){
  //   echo $c->paraJson();
  // }else{
  //   echo $c->read();
  // }

  // LOGIN //

  // $c = new Cliente;

  // $c->setLogin('cliente2');
  // $c->setSenha('123');

  // if($c->login())
  // {
  //   $c->read();

  //   echo 'Bem vindo, ' . $c->getNome();
  // }else{
  //   echo 'Erramos nessa porra';
  // }

  // LOGIN PAGINA PARA A DASHBOARD //

  // $resposta = json_encode(array('resposta' => 0));

  // if(!empty($_POST['action']))
  // {
  //   switch($_POST['action'])
  //   {
  //     case 'login':
  //       $c = new Cliente;

  //       $c->setLogin($_POST['login']);
  //       $c->setSenha($_POST['senha']);

  //       if($c->login())
  //       {
  //         $c->read();

  //         $resposta = $c->paraJson();
  //       }

  // break;
  //   }
  // }

  // echo $resposta;

  //// Admin ////

  // CREATE //

  // $a = new Admin();

  // $a->setId('3');
  // $a->setNome('Teste');
  // $a->setLogin('teste');
  // $a->setSenha('123');

  // if($a->create() == 1)
  // {
  //   echo 'Cadastrado com sucesso';
  // }else{
  //   echo $a->create();
  // }

  // READ // 

  // $a = new Admin();

  // $a->setId(3);
  
  // if($a->read()){
  //   echo $a->getNome();
  // }

  // UPDATE //

  // $a = new Admin();

  // $a->setId(3);
  
  // if($a->read()){
  //   $a->setNome('teste modificado');
  //   if($a->update()){
  //     echo 'Nome Atualizado com sucesso';
  //   }else {
  //     echo $a->update();
  //   }
  // }else{
  //   echo $a->read();
  // }

  // DELETE //

  // $a = new Admin();

  // $a->setId(3);

  // if($a->delete()){
  //   echo 'Administrador Deletada com Sucesso';
  // }else{
  //   echo $a->delete();
  // }

  // LISTA //

  // $a = new Admin();

  // $listagem = $a->lista();

  // if(!empty($listagem))
  // {
  //   foreach($listagem as $item){
  //     echo $item['id'] . ' - ' . $item['nome'] . '<br>';
  //   }
  // }else{
  //   echo 'Erro ao listar';
  // }

  // LISTA JSON //

  $a = new Admin();

  // echo $a->listaJson();

  // PARA JSON  //

  // $a = new Admin();

  // $a->setId(1);
  
  // if($a->read()){
  //   echo $a->paraJson();
  // }else{
  //   echo $a->read();
  // }

  // LOGIN //

  // $a = new Admin;

  // $a->setLogin('Jhosefer');
  // $a->setSenha('123');

  // if($a->login())
  // {
  //   $a->read();

  //   echo 'Bem vindo, ' . $a->getNome();
  // }else{
  //   echo 'Erramos nessa porra';
  // }

  // LOGIN PAGINA PARA A DASHBOARD //

  // $resposta = json_encode(array('resposta' => 0));

  // if(!empty($_POST['action']))
  // {
  //   switch($_POST['action'])
  //   {
  //     case 'login':
  //       $a = new Usuario;

  //       $a->setLogin($_POST['login']);
  //       $a->setSenha($_POST['senha']);

  //       if($a->login())
  //       {
  //         $a->read();

  //         $resposta = $a->paraJson();
  //       }

  // break;
  //   }
  // }

  // echo $resposta;

?>