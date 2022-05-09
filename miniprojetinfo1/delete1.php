<?php
$con=mysqli_connect("localhost","root","","gestion");
$nom=$_GET['nom'];
$sql="DELETE FROM groupe WHERE nom='$nom'";
$query=mysqli_query($con,$sql);
if (isset($query)){
    header("location:afficherGroupe.php");
}
else{
    echo "<h1>ERREUR</h1>";
}; 
 ?>