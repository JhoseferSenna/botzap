<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script>
    $(document).ready(function(){

        $(document).on('click', '.btn-menu', function(){
            carregaPagina($(this).data('pagina'));
        });

        $(document).on('click', '.btn-cad', function(){
            cadastraDado($(this).data('id'));
        });

        $(document).on('change', "input[name='acao-resposta']", function(){
        exibirAcao($(this).val());
        });

        $(document).on("click", ".btn-editar-menu", function() {
            carregaMenu($(this).data("id"));
        });

        $(document).on("click", ".btn-salvar-menu", function() {
            atualizaMenu('menu');
        });

        $(document).on("click", ".btn-excluir-menu", function() {
            excluiMenu($(this).data("id"));
        });

    });

    function exibirAcao(acao)
    {
        if(acao == 'resposta')
        {
            $("#display-resposta").show();
            $("#display-menu").hide();
        }
        else if(acao == 'menu-destino')
        {
            $("#display-resposta").hide();
            $("#display-menu").show();
        }
    }

    function listar(id)
    {
        var a = 'list-'+id;

        var lista = '';

        $.post('../../controller/Cliente.php', { action: a }, function(retorno){

            $.each(retorno, function(indice, item)
            {
                lista += '<tr>';
                switch(id)
                {
                    case 'menu':

                        lista += '<td>';
                        lista += item.nome;
                        lista += '</td>';
                        lista += "<td>";
                        lista += '<div class="btn-group">';
                        lista +=
                        '<button type="button" class="btn btn-primary btn-editar-menu" data-id="' +
                        item.id +
                        '" data-toggle="modal" data-target="#modal_menu"><i class="fas fa-edit"></i></button> ';
                        lista +=
                        '<button type="button" class="btn btn-danger btn-excluir-menu" data-id="' +
                        item.id +
                        '"><i class="fas fa-trash-alt"></i></button> ';
                        lista += "</div>";
                        lista += "</td>";

                    break;

                    case 'resposta':

                        lista += '<td>';
                        lista += item.nome;
                        lista += '</td>';
                        lista += "<td>";
                        lista += '<div class="btn-group">';
                        lista +=
                        '<button type="button" class="btn btn-primary btn-editar-resposta" data-id="' +
                        item.id +
                        '" data-toggle="modal" data-target="#modal_resposta"><i class="fas fa-edit"></i></button> ';
                        lista +=
                        '<button type="button" class="btn btn-danger btn-excluir-resposta" data-id="' +
                        item.id +
                        '"><i class="fas fa-trash-alt"></i></button> ';
                        lista += "</div>";
                        lista += "</td>";

                    break;
                    
                    case 'opcao':

                        lista += '<td>';
                        lista += item.menu;
                        lista += '</td>';
                        lista += '<td>';
                        lista += item.nome;
                        lista += '</td>';
                        lista += '<td>';

                        lista += item.resposta;
                        lista += '</td>';
                        lista += "<td>";
                        lista += '<div class="btn-group">';
                        lista +=
                        '<button type="button" class="btn btn-primary btn-editar-opcao" data-id="' +
                        item.id +
                        '" data-toggle="modal" data-target="#modal_opcao"><i class="fas fa-edit"></i></button> ';
                        lista +=
                        '<button type="button" class="btn btn-danger btn-excluir-opcao" data-id="' +
                        item.id +
                        '"><i class="fas fa-trash-alt"></i></button> ';
                        lista += "</div>";
                        lista += "</td>";

                    break;

                    case 'usuario':

                        lista += '<td>';
                        lista += item.nome;
                        lista += '</td>';
                        lista += '<td>';
                        lista += 'Botões de ação';
                        lista += '</td>';

                    break;
                }

                lista += '</tr>';

            });

            $('#list-' + id).empty();
            $('#list-' + id).append(lista);

            carregaExtras();

        }, 'json');
    }

    function cadastraDado(id)
    {
        var dados = $('#frm-cad-'+id).serializeArray();
        console.log(dados);
        var a = { name: "action", value: "cad-"+id };

        dados.push(a);

        $.post('../../controller/Cliente.php', dados, function(retorno){

            listar(id);
            $('#frm-cad-'+id).each (function(){
                this.reset();
            });

        }, 'json');
    }

    function carregaMenu(codigo)
    {
        var a = "carrega-menu";
        

        $.post("../../controller/Cliente.php",
        { action: a , id : codigo}, function(retorno) {
            $('#edt_id').val(retorno.id);
            $('#edt_nome').val(retorno.nome);
            // $('#modal_cliente').modal('show');
           
        }, "json");
        
    }

    function atualizaMenu(id)
    {
        $.post("../../controller/Cliente.php",
        { action: "edt-menu",
        id: $('#edt_id').val(),
        nome: $('#edt_nome').val() },
        function(retorno) {
        if (retorno.result == "ERRO") {
            alert("Erro Ao Editar Usuário!");
        } else {
            alert("Usuário Editado!");
            listar(id);
            
        }
        }, "json");
    }

    function excluiMenu(codigo) {
        $.post("../../controller/Cliente.php",
        { id: codigo, action: "exclui-menu" },
        function(retorno) {
        if (retorno.result == "ERRO") {
        alert("Erro Ao Excluir Usuário!");
      } else {
        alert("Usuário Excluído!");
        listar('menu')
      }
    },
    "json"
  );
}

    function carregaPagina(pagina)
        {
            $("#conteudo-pagina").load("paginas/"+pagina+".php", function()
            {
                
                listar($('.list').data('id'));

            });
        }

    function carregaExtras()
    {
        $('.listagem').DataTable();
    }
</script>