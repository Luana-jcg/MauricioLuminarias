<center><h1 class="mt-5">Olá, <?php echo $_SESSION['nome'];?>. Bem vindo a área de administração.</h1></center>

<div class="m-5" style="margin-top: 40px">

  <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-users"></i>
              </div>
              <div class="mr-5">Usuários</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="listaUsuario.php">
              <span class="float-left">Mais detalhes</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-dark o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-list"></i>
              </div>
              <div class="mr-5">Clientes interessados</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="listaEncomendas.php">
              <span class="float-left">Mais detalhes</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">Comentários</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="listaComentarios.php">
              <span class="float-left">Mais detalhes</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-image"></i>
              </div>
              <div class="mr-5">Gerenciador de Galeria</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="gerenciadorGaleria.php">
              <span class="float-left">Mais detalhes</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
</div>