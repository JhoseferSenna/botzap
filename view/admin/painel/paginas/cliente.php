  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Início</a></li>
              <li class="breadcrumb-item">Configurações</li>
              <li class="breadcrumb-item active">Clientes</li>
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
                <h3 class="card-title">Cadastrar Cliente</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="frm-cad-cliente">
                <div class="card-body">
                  <div class="form-group">
                    <label for="menu">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite aqui o nome do Cliente">
                  </div>
                  <div class="form-group">
                    <label for="menu">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Digite aqui o e-mail do Cliente">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-cad" data-id="cliente">Cadastrar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <div class="col-md-6">
          <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-registered"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">
                  Clientes
                  Registrados
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-toggle-on"></i></span>

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
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody class="list" id="list-cliente" data-id="cliente">
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Status</th>
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
  <div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="user">
                      <div class="form-group">
                        <label for="id">Código</label>
                        <input
                          type="text"
                          name="id"
                          class="form-control form-control-user"
                          id="edt_id"
                          aria-describedby="emailHelp"
                          placeholder=""
                          readonly
                        />
                      </div>
                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <input
                          type="text"
                          name="nome"
                          class="form-control form-control-user"
                          id="edt_nome"
                          aria-describedby="emailHelp"
                          placeholder=""
                        />
                      </div>
                      <div class="form-group">
                        <label for="login">Login</label>
                        <input
                          type="text"
                          name="login"
                          class="form-control form-control-user"
                          id="edt_login"
                          aria-describedby=""
                          placeholder=""
                        />
                      </div>
                      <div class="form-group">
                        <label for="senha">Senha</label>
                        <input
                          type="password"
                          name="senha"
                          class="form-control form-control-user"
                          id="edt_senha"
                          placeholder="Senha"
                        />
                      </div>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary btn-salvar-cliente">Salvar mudanças</button>
      </div>
    </div>
  </div>
</div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
