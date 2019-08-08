$(document).ready(function(){

  $(document).on('click', '#btn-login',  function(){

      login();

  });

  $(document).on('click', '#btn-primeiro-login',  function(){
      primeiroLogin($(this).data('id'));     
  });

  function login()
  {
      var l = $("#login").val();
      var s = $("#senha").val();
      var a = '';

      s == '' ? a = 'primeiro-login' : a = 'login'; 

      $.post("controller/Cliente.php", {login: l, senha: s, action: a}, function (retorno){

          // -1 -> erro ao logar
          // 0 -> login efetuado
          // outro numero -> vai ser o id do cliente que logou pela primeira vez , inserir novos login e senha
          // Vou tratar apenas o 2, o 0 vc exibe msg e o 1 vc redireciona
          if(retorno.resposta == '0') {
            window.location.href = "view/cliente/";
          }
          else if(retorno.resposta > 0)
          {
              $('#frm-login').trigger("reset");
              $("#mensagem").append("Digite seu novo login e senha");
              $("#btn-login").hide();

              $('#botoes').append(
                  "<button id='btn-primeiro-login' class='btn btn-primary btn-block btn-flat' type='button' data-id='" + retorno.resposta + "'> PRIMEIRO LOGIN </button>"
              );

          }
          else
          {

          }
          

      }, 'json' );
  }

  function primeiroLogin(i)
  {
      var l = $("#login").val();
      var s = $("#senha").val();
      var a = 'cadLoginSenha';

      $.post("controller/Cliente.php", {login: l, senha: s, action: a, id: i}, function (retorno){

          if(retorno.resposta == 1)
          {
              window.location.href = "view/cliente";
          }
          else
          {
            
          }

      }, 'json' );
  }
});