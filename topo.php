<!-- Topo  -->
<header class="justify-content-between">
    <nav class="navbar navbar-expand-md">
        <div>
            <img src="imagens/LOGO.png" style="max-width:40px" alt="">
        </div>
        <!-- Collapse button -->
        <button class="navbar-toggler text-white close-btn" data-toggle="collapse" data-target="#nav">
            <span class="navbar-toggler-icon"><i class="fas fa-bars fa-1x"></i></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between align-items-center" id="nav">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item  d-inline">
                    <a class="nav-link active text-light" href="index.php">Início</a>
                </li>
                <li class="nav-item  d-inline">
                    <a class="nav-link text-light" href="galeria.php">Galeria</a>
                </li>
                <li class="nav-item d-inline">
                    <a class="nav-link text-light" href="pre_encomenda.php">Encomendar</a>
                </li>
                <?php if(isset($_SESSION['perfil'])){ ?>
                <li class="nav-item d-inline">
                    <a class="nav-link text-light" href="adm.php">Administração</a>
                </li>
                <?php } ?>
            </ul>


            <ul class="navbar-nav ml-auto justify-content-end" style="text-align: center;">
                <?php if(!isset($_SESSION['perfil'])){ ?>
                <li class="nav-item">
                    <a id="cadastrese" class="nav-link btn btn-outline border border-white text-light" style="font-weight:bold" href="adm.php"><i class="fas fa-user-circle mr-2"></i>Login</a>
                </li>
                <?php }else{ ?>
                <li class="nav-item">
                    <a class="text-warning mr-3" href="alterarSenha.php" style="font-weight:bold;"><i class="mr-2 text-warning fas fa-key"></i></a>
                    <a class="text-warning" href="logoff.php" style="font-weight:bold;"><i class="mr-2 text-warning fas fa-sign-out-alt"></i>Sair</a>
                </li>
                <?php } ?>
            </ul>

        </div>
    </nav>
</header>
<!-- Fim Topo  -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
