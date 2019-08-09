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
                        lista += '<td>';
                        lista += 'Botões de ação';
                        lista += '</td>';

                    break;

                    case 'resposta':

                        lista += '<td>';
                        lista += item.nome;
                        lista += '</td>';
                        lista += '<td>';
                        lista += 'Botões de ação';
                        lista += '</td>';

                    break;

                    case 'opcao':

                        lista += '<td>';
                        lista += item.menu;
                        lista += '</td>';
                        lista += '<td>';
                        lista += item.nome;
                        lista += '</td>';
                        lista += '<td>';
                        lista += 'resposta a ser tratada';
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

    function carregaPagina(pagina)
        {
            $("#conteudo-pagina").load("paginas/"+pagina+".php", function()
            {
                //carregaExtras();
                
                listar($('.list').data('id'));

            });
        }

    function carregaExtras()
    {
        $('.listagem').DataTable();
    }
    
</script>