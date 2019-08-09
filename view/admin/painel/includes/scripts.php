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

        // $(document).on('show', '.list', function(){

        //     alert('apareceu carai');
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

    function carregaExtras()
    {
        $('.listagem').DataTable();
    }
</script>