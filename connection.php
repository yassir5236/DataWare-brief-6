


<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datawareX";


try {

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (Exception $e){
  echo 'Erreur de connexion: '. $e->getMessage();
}


// $content_Projet = $conn->query('SELECT * FROM projet WHERE id=2');

// // echo '<table>';

// while($ligne= $content_Projet->fetch()){
//   echo $ligne['nom'];
// }




?>
