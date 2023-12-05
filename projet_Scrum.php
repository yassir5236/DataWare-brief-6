<?php
include("connection.php");
session_start();
$id_utilisateur = $_SESSION['id'];

$sql = "SELECT projet.nom as nom_projet, description, projet.date_creation as date_creation, date_limite
        FROM projet 
        JOIN utilisateur ON utilisateur.id = projet.id_user 
        WHERE projet.id_user = ?";

$requete = $conn->prepare($sql);

if (!$requete) {
    die('Erreur de préparation de la requête.');
}

$requete->bind_param('i', $id_utilisateur);

if (!$requete->execute()) {
    die('Erreur d\'exécution de la requête.');
}

$resultat = $requete->get_result();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Projets</title>
  <!-- Inclure le fichier CSS de Tailwind -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">


  <div class="container mx-auto p-8">
    <h2 class="text-3xl font-semibold mb-8">Mes Projets</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">




      <?php

      // Parcourir les résultats
      while ($row = $resultat->fetch_assoc()) {
        echo "<div class=\"bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105\">
            <h3 class=\"text-xl font-semibold mb-2 text-gray-800\">{$row['nom_projet']}</h3>
            <p class=\"text-gray-600 mb-4\">{$row['description']}</p>
            <p class=\"text-gray-600 mb-4\">{$row['date_creation']}</p>
            <p class=\"text-gray-600 mb-4\">{$row['date_limite']}</p>
        
            <button class=\"bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue\">Modifier </button>
        </div>";
      }

      ?>


      <script src="projet.js"></script>
</body>

</html>