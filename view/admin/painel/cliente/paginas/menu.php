  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menus</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Início</a></li>
              <li class="breadcrumb-item">Configurações</li>
              <li class="breadcrumb-item active">Menus</li>
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
              <form role="form" id="frm-cad-menu">
                <div class="card-body">
                  <div class="form-group">
                    <label for="menu">Nome</label>
                    <input type="text" class="form-control" name="menu" id="menu" placeholder="Digite aqui o nome do menu">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-cad" data-id="menu">Salvar</button>
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
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody class="list" id="list-menu" data-id="menu">
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Nome do menu</th>
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
