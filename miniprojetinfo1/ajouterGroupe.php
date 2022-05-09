<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:ajouter1.php");
      exit();
   }
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Ajouter groupe</title>
     <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
</head>
<body>
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
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
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
                <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0" method="post" action="chercherGroupe.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe" name="Classe">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="chercher">Chercher Groupe</button>
  </form>
        </div>
      </nav>

      <main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Ajouter un nouveau groupe</h1>
              <p>Remplir le formulaire ci-dessous afin d'ajouter un groupe!</p>
            </div>
          </div>

          
          <?php
  $con=mysqli_connect("localhost","root","","gestion");
  if (isset($_GET['nom'])){
    $nom=$_GET['nom'];
    $requete="SELECT * from groupe";
    $query=mysqli_query($con,$requete);
    $rows=mysqli_fetch_assoc($query);
    $nom=$rows['nom'];

  }
  ?>
 <form id="myform" method="post" action="ajouter1.php?<?php
  if (isset($_GET['nom'])){
     echo "nom=update";
  }
  ?>">
 <div class="form-group">
     <label for="groupe">saisir le nom du nouveau groupe:</label><br>
     <input type="text" id="groupe" name="nom" class="form-control" value="<?php
  if (isset($_GET['nom'])){
     echo $nom;
  }
  ?>" required pattern="INFO[1-3]{1}-[A-E]{1}"
     title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
    </div>
  <!--Bouton Ajouter-->
  <button  type="submit" class="btn btn-primary btn-block">
    <?php
     if (isset($_GET['nom']))
     {
       echo "Modifier";
     }
     else
     {
       echo "Ajouter";
     }
     ?></button>
 </form> 
 <br> <br>
</div>  
</main>
<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
  <script>
    function ajouter()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/mini-projet-info1/ajouter1.php";
        
        //Envoie Req
        xmlhttp.open("POST",url,true);

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
                        document.getElementById("demo").innerHTML="L'ajout de groupe a été bien effectué";
                        document.getElementById("demo").style.backgroundColor="green";
                    }
                    else
                    {
                        document.getElementById("demo").innerHTML="Le groupe existe déjà, merci de vérifier";
                        document.getElementById("demo").style.backgroundColor="#fba";
                    }
                }
            }
        
        
    }
    </script>
</body>
</html>
