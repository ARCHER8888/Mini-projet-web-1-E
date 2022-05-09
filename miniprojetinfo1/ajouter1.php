<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login1.php");
	exit();
 }
 else if (isset($_GET['id'])){
   $con=mysqli_connect("localhost","root","","gestion");
   $nom=$_REQUEST['nom'];
   $requete="UPDATE groupe set nom='$nom' ";
   $query=mysqli_query($con,$requete);
   if (isset($query)){
      header("location:afficherGroupe.php");
   }
   else{
      echo "<h1>ERREUR</h1>";
   }
   }

else {
$nom=$_REQUEST['nom'];
include("connexion.php");
         $sel=$pdo->prepare("select nom from groupe where nom=? limit 1");
         $sel->execute(array($nom));
         $tab=$sel->fetchAll();
         if(count($tab)>0){
            $erreur="Groupe existe déja";// groupe existe déja
            echo"<h1>Groupe existe déja</h1>";}
         else{
            $req="insert into groupe values ('$nom')";
            $reponse = $pdo->exec($req) or die("error");
            header("location:afficherGroupe.php");
         }  
         
}
?>