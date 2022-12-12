<?php $title = "Accueil"; ?>

<?php include "header.php";?>
<body>

<body class="profil_body">
<?php require "navbar_connected.php";?>
<h1 class="text-center mt-5">Veuillez selectionner la musique que vous souhaitez chanter:</h1>
  <div class="bg-dark d-flex justify-content-around  m-auto w-100"  >
    
      <form action="" method="POST" class="d-flex flex-column m-5 w-25 myform">
        <label for="">Nom musique</label>
          <input type="text" class="form-control form-select-lg">
          <label for="">Nom chanteur</label>
          <input class="form-control form-select-lg class="type="text">
      </form>
  
    <form action="" method="POST"class="d-flex flex-column m-5  pt-5 w-25 myform">
    <label for="">Nom musique</label>
      <select class="form-control form-select-lg name=" id=""><option value="">Selection</option></select>
   </form>
  



  </div>




<div class="text-center"><button class=" mt-5 button-30">Confirmer</button></div>


<p class=" display-3 text-white">Etat : En attente de confirmation</p>
<p class="mt-5 display-4 text-white">Une fois votre demande traité il vous sera demandé de fournir la bande son </p>



</body>
</html>