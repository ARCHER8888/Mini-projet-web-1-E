<?php
$con=mysqli_connect("localhost","root","","gestion");
$cin=$_GET['cin'];
$req="DELETE FROM etudiant WHERE cin='$cin'";
$query=mysqli_query($con,$req);
if (isset($query)){
    header("location:supprimerEtudiant.php");
}
else{
    echo "<h1>ERREUR</h1>";
}
?>