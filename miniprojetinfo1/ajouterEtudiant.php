<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login1.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Ajouter Etudiant</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index1.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.html" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="ajouterGroupe.php">Ajouter Groupe</a>
                <a class="dropdown-item" href="modifierGroupe.php">Modifier Groupe</a>
                <a class="dropdown-item" href="supprimerGroupe.php">Supprimer Groupe</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                <a class="dropdown-item" href="chercherEtudiant.php">Chercher Etudiant</a>
                <a class="dropdown-item" href="modifierEtudiant.php">Modifier Etudiant</a>
                <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="saisirAbsence.html">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsence.html">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnxion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button>
          </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Ajouter un étudiant</h1>
              <p>Remplir le formulaire ci-dessous afin d'ajouter un étudiant!</p>
            </div>
          </div>


<div class="container">
  <?php
  $con=mysqli_connect("localhost","root","","gestion");
  if (isset($_GET['cin'])){
    $cin=$_GET['cin'];
    $requete="SELECT * from etudiant";
    $query=mysqli_query($con,$requete);
    $rows=mysqli_fetch_assoc($query);
    $nom=$rows['nom'];
    $prenom=$rows['prenom'];
    $email=$rows['email'];
    $pass=$rows['password'];
    $cpass=$rows['cpassword'];
    $adresse=$rows['adresse'];
    $classe=$rows['Classe'];
    $cin=$rows['cin'];

  }
  ?>
 <form id="myForm" method="post" action="ajouter.php?<?php
  if (isset($_GET['cin'])){
     echo "cin=update";
  }
  ?>">
     <!--
                        TODO: Add form inputs
                        Prenom - required string with autofocus
                        Nom - required string
                        Email - required email address
                        CIN - 8 chiffres
                        Password - required password string, au moins 8 letters et chiffres
                        ConfirmPassword
                        Classe - Commence par la chaine INFO, un chiffre de 1 a 3, un - et une lettre MAJ de A à E
                        Adresse - required string
                    -->
     <!--Nom-->
     <div class="form-group">
     <label for="nom">Nom:</label><br>
     <input type="text" id="nom" name="nom" class="form-control" value="<?php
  if (isset($_GET['cin'])){
     echo $nom;
  }
  ?>" required autofocus>
    </div>
     <!--Prénom-->
     <div class="form-group">
     <label for="prenom">Prénom:</label><br>
     <input type="text" id="prenom" name="prenom" class="form-control" value="<?php
  if (isset($_GET['cin'])){
     echo $prenom;
  }
  ?>" required>
    </div>
     <!--Email-->
     <div class="form-group">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" class="form-control" value="<?php
  if (isset($_GET['cin'])){
     echo $email;
  }
  ?>" required>
       </div>
     <!--CIN-->
     <div class="form-group">
     <label for="cin">CIN:</label><br>
     <input type="text" id="cin" name="cin"  class="form-control" value="<?php
  if ((isset($_GET['cin']))){
    echo $cin;
  }
  ?>" required pattern="[0-9]{8}" title="8 chiffres"/>
    </div>
     
     <!--Password-->
     <div class="form-group">
     <label for="pwd">Mot de passe:</label><br>
     <input type="password" id="pwd" name="pwd" class="form-control" value="<?php
  if ((isset($_GET['cin']))){
    echo $pass;
  }
  ?>" required pattern="[a-zA-Z0-9]{8,}" title="Au moins 8 lettres et nombres"/>
    </div>
    <!--ConfirmPassword-->
    <div class="form-group">
        <label for="cpwd">Confirmer Mot de passe:</label><br>
        <input type="password" id="cpwd" name="cpwd" class="form-control" value="<?php
  if ((isset($_GET['cin']))){
     echo $cpass;
  }
  ?>" required/>
    </div>
     <!--Classe-->
     <div class="form-group">
     <label for="classe">Classe:</label><br>
     <input type="text" id="classe" name="classe" class="form-control" value="<?php
  if (isset($_GET['cin'])){
     echo $classe;
  }
  ?>" required pattern="INFO[1-3]{1}-[A-E]{1}"
     title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
    </div>
     <!--Adresse-->
     <div class="form-group">
     <label for="adresse">Adresse:</label><br>
     <textarea id="adresse" name="adresse" rows="10" cols="30" class="form-control" required>
     <?php
  if (isset($_GET['cin'])){
     echo $adresse;
  }
  ?>
     </textarea>
    </div>
     <!--Bouton Ajouter-->
     <button  type="submit" class="btn btn-primary btn-block"><?php
     if (isset($_GET['cin'])){
       echo "Modifier";
     }
     else{
       echo "Ajouter";
     }
     ?></button>
     

 </form> 
</div>  
</main>
<script>
  function ajouter()
  {
      var xmlhttp = new XMLHttpRequest();
      var url="http://localhost/mini-projet-info1/ajouter.php";
      
      //Envoie Req
      xmlhttp.open("post",url,true);

      form=document.getElementById("myForm");
      formdata=new FormData(form);

      xmlhttp.send(formdata);

      //Traiter Res

      xmlhttp.onreadystatechange=function()
          {   
              if(this.readyState==4 && this.status==200){
              // alert(this.responseText);
                  if(this.responseText=="OK")
                  {
                      document.getElementById("demo").innerHTML="L'ajout de l'étudiant a été bien effectué";
                      document.getElementById("demo").style.backgroundColor="green";
                  }
                  else
                  {
                      document.getElementById("demo").innerHTML="L'étudiant est déjà inscrit, merci de vérifier le CIN";
                      document.getElementById("demo").style.backgroundColor="#fba";
                  }
              }
          }
  }
  </script>


<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>

<script  src="./assets/dist/js/inscrire.js"></script>
</body>
</html>