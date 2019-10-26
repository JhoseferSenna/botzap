<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>BotZap</title>
  </head>
  <body>
    

    <div class="container">

        <h1>Cadastro de Menu</h1>

        <form>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control">
            </div>
    
            <button type="button" class="btn btn-primary" id="btn-cad">Salvar</button>
        </form>

        <hr>

        <h1>Menus Cadastrados</h1>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                </thead>
                <tbody id="lista-menus">

                </tbody>
            </table>
        </div>

        <!-- Position it -->
            <div style="position: absolute; top: 0; right: 0;" class="mx-2 my-2">
                <!-- Then put toasts within -->
                <div class="toast" role="alert" data-delay="2000">
                    <div class="toast-header">
                        <div class="spinner-grow text-success" role="status"></div>
                        <strong class="mr-2">
                            BotZap
                        </strong>
                        <small class="text-muted">
                            agora
                        </small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Menu Cadastrado com Sucesso!
                    </div>
                </div>
            </div>

            
<!-- Modal -->
<div class="modal fade" id="modalEdtItens" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEdtItensTitulo"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-6">
                TABELA DE ITENS
            </div>
            <div class="col-sm-6">
                <form>
                    <input type="hidden" name="id-menu-itens" id="id-menu-itens">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="itens[]" placeholder="Nome do item...">
                    </div>
                    <div id="campos-item">

                    </div>
                    <button type="button" class="btn btn-sm btn-primary" id="btn-novo-item">Adicionar</button>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-cad-itens">Salvar</button>
      </div>
    </div>
  </div>
</div>

    </div>

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function(){

            $(document).on('click', '#btn-cad', function()
            {
                cadMenu();
            });

            $(document).on('click', '#btn-cad-itens', function()
            {
                armazenarItens();
            });

            $(document).on('click', '#btn-novo-item', function()
            {
                novoCampoItem();
            });

            $(document).on('click', '.btn-menu', function()
            {
                abreItens($(this).data('nome'), $(this).data('id'));
            });

            listMenu();

        });

        function armazenarItens()
        {
            var i = [];
            $("input[name='itens[]']").each(function() {
                i.push($(this).val());
            });

            var id = $("#id-menu-itens").val();

            var a = 'CAD_ITENS';

            $.post('../controller/Sistema.php', {acao: a, idMenu: id, itens: i}, function(retorno){

                if(retorno.resposta)
                {
                    $('.toast').toast('show');

                    $('#nome').val('');

                    listMenu();
                }

            }, 'json');

        }

        function novoCampoItem()
        {   
            var campo = '';

            campo += '<div class="form-group">'
            campo += '<input type="text" class="form-control form-control-sm" name="itens[]" placeholder="Nome do item...">'
            campo += '</div>'


            $('#campos-item').append(campo)
        }

        function abreItens(menu, idMenu)
        {
            $('#modalEdtItensTitulo').html(menu);
            $('#id-menu-itens').val(idMenu);

            $("#modalEdtItens").modal('show');
        }

        function listMenu()
        {
            var a = 'LIST_MENUS';

            var lista = '';

            $.post('../controller/Sistema.php', {acao: a}, function(retorno){

                if(retorno)
                {
                    $.each(retorno, function(indice, menu)
                    {
                        lista += '<tr class="btn-menu" data-id="' + menu.id + '" data-nome="' + menu.nome + '">'; 
                        lista += '<th>';
                        lista += menu.id; 
                        lista += '</th>'; 
                        lista += '<td>';
                        lista += menu.nome;  
                        lista += '</td>'; 
                        lista += '</tr>'; 
                    });
                }

                $('#lista-menus').empty();
                $('#lista-menus').append(lista);

            }, 'json');
        }

        function cadMenu()
        {
            var n = $('#nome').val();
            var a = 'CAD_MENU';

            $.post('../controller/Sistema.php', {acao: a, nome: n}, function(retorno){

                if(retorno.resposta)
                {
                    $('.toast').toast('show');

                    $('#nome').val('');

                    listMenu();
                }

            }, 'json');
        }

    </script>
  </body>
</html>