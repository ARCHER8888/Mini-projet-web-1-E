<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
$cin=$_REQUEST['cin'];
$nom=$_REQUEST['nom'];
$prenom=$_REQUEST['prenom'];
$email=$_REQUEST['email'];
$adresse=$_REQUEST['adresse'];
$pwd=$_REQUEST['pwd'];
$cpwd=$_REQUEST['cpwd'];

$classe=$_REQUEST['classe'];


include("connexion.php");
         $sel=$pdo->prepare("select cin from etudiant where cin=? limit 1");
         $sel->execute(array($cin));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="NOT OK";// Etudiant existe déja
         else{
            $req="insert into etudiant values ($cin,'$email',md5('$pwd'),md5('$cpwd'),'$nom','$prenom','$adresse','$classe')";
            $reponse = $pdo->exec($req) or die("error");
            $erreur ="OK";
         }  
         echo $erreur;
}
?>