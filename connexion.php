<?php session_start();

require "conectbdd.php";
if (!empty($_POST)) {
    if (isset($_POST["email_connexion"], $_POST["mdp_connexion"]) && !empty($_POST["email_connexion"]) && !empty($_POST["mdp_connexion"])) {
        $_SESSION["error"] = [];
        if (!filter_var($_POST["email_connexion"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "Adresse email ou mot de passe incorrect";
        } 
                require "conectbdd.php";
                $email =strip_tags($_POST["email_connexion"]);
                $sql = "SELECT * FROM `user` WHERE email = :user_email";
                
                $query = $connexion->prepare($sql);
                
                $query->bindValue(":user_email", $email, PDO::PARAM_STR);
                $query->execute();
                
                $user = $query->fetch();
                if (!$user) {
                    $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";
                }
                elseif(!password_verify($_POST["mdp_connexion"], $user["password"])) {
                    $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";
                }

        if($user["type"] === "admin"){
          header("location: admin.php");
          $_SESSION["user"] = [
              "id" => $user["id"],
              "Nom"=> $user['nom'],
              "Prenom" => $user['prenom'],
              "type" => $user["type"]
          ];
      }else{
          header("location: acceuil_connect.php");
          $_SESSION["user"] = [
              "id" => $user["id"],
              "Nom"=> $user['nom'],
              "Prenom" => $user['prenom'],
              "Age"=>$user['age'],
              "Sexe"=>$user['sexe'],
              "type" => $user["type"],
              "statutChoixChanson" => $user["statutChoixChanson"],
              "statutEnvoiChanson" => $user["statutEnvoiChanson"],
              "statutPaiement" => $user["statutPaiement"],
          ];
            }
        }
      }
require_once "conectbdd.php";
?>
 <!-- Modal  connexion -->
 <div class="modal fade" id="exampleModal" >
    <div class="modal-dialog modal-dialog-centered modal-l  ">
      <div class="modal-content ">
        <div class="modal-body ">
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" ></button>
        <div class="   opacity-75  bg-dark  d-flex justify-content-center text center"> 
<!-- début du form-->
<form action="#"  method="POST" class="  myform m-auto" >
<h5 class="text-center text-white">Connexion</h5>
          <!-- <div class="mb-3 mt-3">
              <label for="email_connexion">Email</label>
              <input type="text" name="email_connexion" class="form-control">
          </div>
          <div class="mb-3 mt-3">
              <label for="mdp_connexion"> Mot de passe</label>
              <input type="password" name="mdp_connexion" class="form-control">
          </div>   -->
          <div class=" px-3 text-center m-auto">
              <div class=" d-flex flex-column text-center ">
                <label for="name" >Email</label>
                <input type="text"  class="form-control form-select" name="email_connexion" >
            </div>
            <div class=" px-3 text-center m-auto">
              <div class=" d-flex flex-column text-center ">
                <label for="name" >Mot de passe</label>
                <input type="password"  class="form-control form-select" name="mdp_connexion" >
            </div>
          <button type="submit" class="btn btn-danger mt-3">Connexion</button> 
        </form>

           

        </div>
        </div>
      </div>
    </div>
  </div>
      <!-- fin  Boutton connexion modal-->
    </div>
    </div>
  </header>
  <?php  if (isset ($_SESSION['error'])){
        foreach ($_SESSION['error'] as $message_erreur ) {
            echo $message_erreur;
        }
        unset($_SESSION['error']);
    } ?>