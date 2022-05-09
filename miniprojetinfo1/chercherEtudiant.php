<?php
  $pdo=new PDO("mysql:host=localhost;dbname=gestion","root","");
  $requete=$pdo->query('SELECT * from etudiant ORDER BY cin DESC');
  if ((isset($_GET['recherche'])) AND (!empty($_GET['recherche']))){
    $recherche=htmlspecialchars($_GET['recherche']);
    $requete=$pdo->query('SELECT nom from etudiant WHERE nom LIKE "%'.$recherche.'%" ORDER BY cin DESC');
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
            <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe" name="recherche">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="chercher">Chercher Groupe</button>
  </form>
        </div>
      </nav>
      <main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Chercher un étudiant</h1>
              <p>Remplir le formulaire ci-dessous afin de chercher un étudiant!</p>
            </div>
          </div>
          <div class="container">
 <form id="myform" method="POST" action="chercherEtudiant.php">
 <div class="form-group">
     <label for="cin">saisir le CIN de l'étudiant:</label><br>
     <input type="search" id="cin"  name="cin" placeholder="Rechercher un étudiant" class="form-control"required pattern="[0-9]{8}" 
     title="8 chiffres">
    </div>
 <!--Bouton Ajouter-->
 <button  type="submit" class="btn btn-primary btn-block" name="cin">Chercher</button>
 </form>
 <?php
include("connexion.php");
$cin=$_POST ["cin"];
if(isset($cin)){ 
  $res=$pdo->prepare("select * from etudiant where cin like '%'.$cin.'%' ");
  $res->setFetchMode(PDO::FETCH_OBJ);
  $res->execute();
  if ($row=$res->fetch())
{
  ?>
  <br><br>
  <table class="table table-striped table-hover" id="demo">
     <!--Ligne Entete-->
     <tr>
         <th>
             CIN
         </th>
         <th>
             Nom
         </th>
         <th>
             Prénom
         </th>
         <th>
              classe </th>
         <th>
             Email
         </th>
         <th>
         </th>
     </tr>
 <tr>
   <td> <?php echo $row->cin;?> </td>
   <td> <?php echo $row->email;?> </td>
   <td> <?php echo $row->nom;?> </td>
   <td> <?php echo $row->prenom;?> </td>
   <td> <?php echo $row->adresse;?> </td>
   </table>
   <?php }
  else{
    echo"étudiant non trouvé";
  } 
  }
   ?>
</div>  
</main>
<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>