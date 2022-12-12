<?php session_start() ?>
</head>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="#" class="navbar-brand"><img class="logo" src="Images/logo.png"></a>
          <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarresponsive" aria-controls="navbarresponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarresponsive">
            <ul class="navbar-nav m-auto me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link  text-white"  href="#">Acceuil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="#">Jury</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="#" >Informations</a>
                </li>
              </ul>

              <?php  require "connexion.php";?>
            <button class="btn btn-success   btn-outline-danger mr-2 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Connexion</button>
            <?php  require "inscription.php";?>
            <button class="btn btn-primary  btn-outline-warning  text-white" data-bs-toggle="modal" data-bs-target="#exampleModalu">Inscription</button>
          </div>
        </div>
      </nav>

</nav>
