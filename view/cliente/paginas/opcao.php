  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Opções</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Início</a></li>
              <li class="breadcrumb-item">Configurações</li>
              <li class="breadcrumb-item active">Opções</li>
            </ol>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cadastrar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="frm-cad-opcao">
                <div class="card-body">

                    <div class="form-group">
                        <label for="menu">Menu</label>

                        <select class="form-control" name="idmenu" id="idmenu">
                        <?php
                            
                            require('../../../model/Menu.php');
                            require('../../../model/Cliente.php');

                            session_start();

                            $m = new Menu();
                            $m->setIdCliente($_SESSION['cliente']->getId());

                            foreach($m->list() as $menu)
                            {
                                echo '<option value="'.$menu['id'].'">';
                                echo $menu['nome'];
                                echo '</option>';
                            }
                        ?>
                        </select>
                    </div>

                  <div class="form-group">
                    <label for="menu">Nome</label>
                    <input type="text" class="form-control" name="opcao" id="opcao" placeholder="Digite aqui o nome do menu">
                  </div>

                  <div class="form-group">
                      <label for="">Esta opção irá acionar</label>
                    <div class="form-check">
                      <input class="form-check-input radio-acao" type="radio" name="acao-resposta" value="resposta">
                      <label class="form-check-label">Uma Resposta</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input radio-acao" type="radio" name="acao-resposta" value="menu-destino">
                      <label class="form-check-label">Outro Menu</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input radio-acao" type="radio" name="acao-resposta" disabled>
                      <label class="form-check-label">Uma requisição na API</label>
                    </div>
                  </div>

                  <div class="form-group" id="display-resposta" style="display: none;">
                        <label for="resposta">Resposta</label>

                        <select class="form-control" name="resposta" id="resposta">
                        <?php
 
                            require('../../../model/Resposta.php');

                            $r = new Resposta();
                            $r->setIdCliente($_SESSION['cliente']->getId());

                            foreach($r->list() as $resposta)
                            {
                                echo '<option value="'.$resposta['id'].'">';
                                echo $resposta['nome'];
                                echo '</option>';
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group" id="display-menu" style="display: none;">
                        <label for="menu-destino">Menu a ser Aberto</label>

                        <select class="form-control" name="menu-destino" id="menu-destino">
                        <?php

                            $m = new Menu();
                            $m->setIdCliente($_SESSION['cliente']->getId());

                            foreach($m->list() as $menu)
                            {
                                echo '<option value="'.$menu['id'].'">';
                                echo $menu['nome'];
                                echo '</option>';
                            }
                        ?>
                        </select>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-cad" data-id="opcao">Salvar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <div class="col-md-6">
          <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Catálogo</span>
                <span class="info-box-number">
                  <?php
                    echo 'Número';
                  ?>
                  Registrados
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Controle</span>
                <span class="info-box-number">
                  <?php
                    echo 'Número';
                  ?>
                  Ativos
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Menus Cadastrados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped listagem" id="example1">
                <thead>
                <tr>
                  <th>Nome do menu</th>
                  <th>Nome</th>
                  <th>Nome da Resposta</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody class="list" id="list-opcao" data-id="opcao">
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Nome do menu</th>
                  <th>Nome</th>
                  <th>Nome da Resposta</th>
                  <th>Ações</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
            </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
