<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
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
    <title>Title</title>
    <style>
    h1{
        border-bottom: 3px solid #cc9900;
        color: #996600;
        font-size: 30px;
    }
    </style>
</head>
<body>
<h2><?php echo $bienvenue?></h2>
      [ <a href="deconnexion.php">Se déconnecter</a> ]
      [<a href="afficherEtudiants.php">Afficher Etudiant</a>]
      [<a href="ajouterEtudiant.php">Ajouter Etudiant</a>]
<h1>Ajouter un etudiant</h1>
<p>
    <form id="myForm" method="POST">
    Nom:
    <br><input type="text" id="nom" name="nom" required/><br>
    Prenom:
    <br><input type="text" id="prenom" name="prenom" required/><br>
    CIN:
    <br><input type="number" id="cin" name="cin" required/><br>
    Mot de passe:
    <br><input type="password" id="pwd" name="pwd" required/><br>
    Confirmer Mot de passe:
    <br><input type="password" id="cpwd" name="cpwd" required/><br>
    E-mail:
    <br><input type="email" id="email" name="email" required/><br>
    Classe:
    <br><input type="text" id="classe" name="classe" required/><br>
    Adresse:
    <br><input type="text" id="adresse" name="adresse" required/><br>
    <button type="button" onclick="ajouter()">Ajouter</button>
</form>
</p>
<div id="demo"></div>
<script>
    function ajouter()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/mini-projet-info1/auth-php-mysql/ajouter.php";
        
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
</body>
</html>