<?php 
session_start();

  $Nom=ucfirst(strip_tags($_POST['Nom']));
  $Prenom=ucfirst(strip_tags($_POST['Prenom']));
  $Email=strtolower(strip_tags($_POST['Email']));
  $RepeatEmail=strip_tags($_POST['RepeatEmail']);
  $Mdp=strip_tags($_POST['Mdp']);
  $Mdp = password_hash($_POST["Mdp"], PASSWORD_ARGON2ID);
  $RepeatMdp=strip_tags($_POST['RepeatMdp']);
  $Datedenaissance=strip_tags($_POST['Datedenaissance']);
  $Sexe=strip_tags($_POST['Sexe']);;
  $aujourdhui = date("Y-m-d");
  $Age = date_diff(date_create($Datedenaissance), date_create($aujourdhui));
  $Age=$Age->format('%y');
  function isValid($date, $format = 'd-m-Y'){ 
    $dt = DateTime::createFromFormat($format, $date);
    return $dt && $dt->format($format) === $date;
  }
// isValid('19-10-1999');

//   if (isValid ){
//     echo 'choses';
//   }
  if (isset($_POST) && !empty($_POST)){
     if(isset($Nom,$Prenom,$Email,$RepeatEmail,$Mdp,$RepeatMdp,$Datedenaissance,$Sexe) && !empty($Nom) && !empty($Prenom) && !empty($Email)&& !empty($RepeatEmail)&& !empty($Mdp)&& !empty($RepeatMdp)&& !empty($Datedenaissance)&& !empty($Sexe)){
      var_dump($_SESSION ['error']);
          if($_POST['Mdp'] !== $_POST['RepeatMdp']) {
             $_SESSION['error'][]='Les mots de passe ne concordent pas';
        }
        if($Email !== $RepeatEmail) {
            $_SESSION['error'][]='Les emails ne concordent pas';
       }
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'][]=' Veuillez entrez une email valide';
          } 
        //  if (!checkdate($Datedenaissance['day'], $Datedenaissance['month'], $Datedenaissance['year'])) {
        //     $_SESSION['error'][]=' Veuillez entrez votre date de naissance';
        //  }
        if($Sexe !== "Femme" && $Sexe !== "Homme"){
            $_SESSION['error'][]=' Veuillez entrez votre genre'; 
        }
        if($Age < 14){
            $_SESSION['error'][]='Vous devez avoir au moins 14ans';
        }
        if($Age > 80){
            $_SESSION['error'][]='Trop vieux dsl';
        }var_dump($_SESSION ['error']);
    if($_SESSION['error'] === [] || $_SESSION['error'] === NULL){
        require 'conectbdd.php';
        $sql = ("INSERT INTO `user`(`nom`, `prenom`,`email`,`password`,`age`,`sexe`,`statutChoixChanson`,`choixSupprime`,`statutEnvoiChanson`,`envoiSupprime`,`statutPaiement`,`type`) VALUES (:user_nom,:user_prenom,:user_email,:user_mdp,:user_age,:user_sexe, 0 , 0 , 0,0,0, 'user')");
            $query = $connexion->prepare($sql);
            $query->bindValue(":user_nom",$Nom, PDO::PARAM_STR);
            $query->bindValue(":user_prenom",$Prenom, PDO::PARAM_STR);
            $query->bindValue(":user_email",$Email, PDO::PARAM_STR);
            $query->bindValue(":user_mdp",$Mdp, PDO::PARAM_STR);
            $query->bindValue(":user_age",$Age, PDO::PARAM_STR);
            $query->bindValue(":user_sexe",$Sexe, PDO::PARAM_STR);
            $emailexist = "SELECT * FROM `user` WHERE email=?";
            $querymail = $base->prepare($emailexist);
            $querymail->execute([$Email]);
            $user_mail = $querymail->rowCount();
            echo 'test';
            if ($user_mail > 0){
                $_SESSION['error'][]= 'email deja existante';
                echo 'test1';
            }
            else{
              $query->execute();
                $_SESSION['user']=[
                    "Nom"=> $Nom,
                    "Prenom" => $Prenom,
                    "Email"=> $Email,
                    "Age"=>$Age,
                    "Sexe"=>$Sexe,
                 
                ];
                
                header('Location: acceuil_connect.php');
            }
    }
  }
}
    ?>

<p><center><?php 
            if (isset ($_SESSION['error'])){
                foreach ($_SESSION['error'] as $message_erreur ) {
                    echo $message_erreur;
                }
                unset($_SESSION['error']);
            }
        ?></p></center>
    

  
  <!-- Modal Inscription -->
  <div class="modal fade" id="exampleModalu" >
    <div class="modal-dialog modal-dialog-centered modal-l  ">
      <div class="modal-content ">
        <div class="modal-body ">
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" ></button>
        <div class="   opacity-75  bg-dark  d-flex justify-content-center text center"> 
<!-- début du form-->
<form action="" method="POST" class="  myform m-auto">
  <!--Titre -->
<h5 class="text-center text-white">Inscription</h5>
            <div class=" px-3 text-center m-auto">
              <div class=" d-flex flex-column text-center ">
                <label for="name" >Nom</label>
                <input type="text"  class="form-control form-select" name="Nom" >
            </div>
              <div class=" col-xs-12 d-flex flex-column ">
                <label for="name" >Prénom</label>
                <input type="text"  class="form-control form-select " name="Prenom">
            </div>

              <div class="w-100"></div>
              <!-- Saut de ligne-->
              <div class=" d-flex flex-column">
                <label for="name" >Mot de passe</label>
                <input type="password"  class="form-control form-select text-center"name="Mdp" >
            </div>
              <div class=" d-flex flex-column">
                <label for="name" >Repeat mdp</label>
                <input type="password"  class="form-control form-select text-center" name="RepeatMdp">
            </div>
              <div class="w-100 " ></div>
              <!-- Saut de ligne-->
              <div class=" d-flex flex-column">
                <label for="name" >Email</label>
                <input type="text"  class="form-control form-select"name="Email" >
            </div>
              <div class=" d-flex flex-column">
                <label for="name" >Repeat Email</label>
                <input type="text"  class="form-control form-select" name="RepeatEmail">
            </div>

              <div class="w-100"></div>
              <!-- Saut de ligne-->
              <div class=" d-flex flex-column">
                <label for="name" >Date de naissance</label>
                <input type="date"  class="form-control form-select text-center"name="Datedenaissance">
            </div>
              <div class=" d-flex flex-column">
                <label for="name" class="text-center">Sexe</label>
                <select class="form-control form-select text-center " name="Sexe">
                  <option class="text-center">Femme</option>
                  <option >Homme</option>
                </select>
            </div>
            
            </div>
            <div class="text-center">
              <button type="submit" class="btn_inscription btn-danger mt-3  ">Inscription</button>
            </div>
  </form><!--fin de form-->

           

        </div>
        </div>
      </div>
    </div>
  </div>
 

  

  
  
  
