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

        $(document).on("click", ".btn-editar-cliente", function() {
            carregaCliente($(this).data("id"));
        });

        $(document).on("click", ".btn-salvar-cliente", function() {
            atualizaCliente('cliente');
        });

        $(document).on("click", ".btn-excluir-cliente", function() {
            excluiCliente($(this).data("id"));
        });

        // $(document).on('show', '.list', function(){

        //     listar($(this).data('id'));

        // });

    });

    function listar(id)
    {
        var a = 'list-'+id;

        var lista = '';

        

    $.post('../../../controller/Admin.php', { action: a }, function(retorno){

    $.each(retorno, function(indice, item)
    {
        lista += '<tr>';
        switch(id)
        {
            case 'cliente':

                lista += '<td>';
                lista += item.nome;
                lista += '</td>';
                lista += '<td>';
                lista += item.email;
                lista += '</td>';
                lista += '<td>';
                if(item.status == 0) {
                    lista += 'Aguardando Confirmação';
                }else if(item.status > 0){
                    lista += 'Ativo';
                }else{
                    lista += item.status;
                }
                lista += '</td>';
                lista += "<td>";
            lista += '<div class="btn-group">';
            lista +=
              '<button type="button" class="btn btn-primary btn-editar-cliente" data-id="' +
              item.id +
              '" data-toggle="modal" data-target="#modal_cliente"><i class="fas fa-edit"></i></button> ';
            lista +=
              '<button type="button" class="btn btn-danger btn-excluir-cliente" data-id="' +
              item.id +
              '"><i class="fas fa-trash-alt"></i></button> ';
            lista += "</div>";
            lista += "</td>";
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
        var a = { name: "action", value: "cad-"+id };

        dados.push(a);

        $.post('../../../controller/Admin.php', dados, function(retorno){

            listar(id);
            $('#frm-cad-'+id).each (function(){
                this.reset();
            });

        }, 'json');
    }

    function carregaPagina(pagina)
        {
            $("#conteudo-pagina").load("paginas/"+pagina+".php", function()
            {
                //carregaExtras();
                
                listar($('.list').data('id'));

            });
        }

    function carregaCliente(codigo)
    {
        var a = "CARREGA_CLIENTE";
        

        $.post("../../../controller/Admin.php",
        { action: a , id : codigo}, function(retorno) {
            $('#edt_id').val(retorno.id);
            $('#edt_nome').val(retorno.nome);
            $('#edt_login').val(retorno.email);
            $('#edt_senha').val('**********');
            $('#modal_cliente').modal('show');
           
        }, "json");
        
    }

    function atualizaCliente(id)
    {
        $.post("../../../controller/Admin.php",
        { action: "ATUALIZA_CLIENTE",
        id: $('#edt_id').val(),
        nome: $('#edt_nome').val(),
        login: $('#edt_login').val(),
        email: $('#edt_login').val(),
        senha: $('#edt_senha').val() },
        function(retorno) {
        if (retorno.result == "ERRO") {
            alert("Erro Ao Editar Usuário!");
        } else {
            alert("Usuário Editado!");
            alert(id);
            listar(id);
            
        }
        }, "json");
    }

    function excluiCliente(codigo) {
        $.post("../../../controller/Admin.php",
        { id: codigo, action: "EXCLUI_CLIENTE" },
        function(retorno) {
        if (retorno.result == "ERRO") {
        alert("Erro Ao Excluir Usuário!");
      } else {
        alert("Usuário Excluído!");
        listar('cliente')
      }
    },
    "json"
  );
}

    function carregaExtras()
    {
        $('.listagem').DataTable();
    }
</script>