<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Équipes</title>
    <!-- Inclure le fichier CSS de Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

   

    <!-- Contenu principal -->
    <div class="container mx-auto mt-8 p-8 shadow-md rounded-md">

        

       





<!-- Section de liste des équipes -->
<div>
 
    

<?php
include("connection.php");
session_start();


// Récupération des informations du membre
$id_utilisateur = $_SESSION['id']; // Check if the session variable is set

$sql = 'SELECT e.nom AS nom_equipe, e.date_creation AS date_creation_equipe, e.id_user AS id_scrum_master
        FROM equipe e
        JOIN membreequipe m ON m.id_equipe = e.id
        WHERE m.id_user = ? AND m.id_equipe IS NOT NULL'; // Fix the column name to id_user

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_utilisateur);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nom_equipe, $date_creation_equipe, $id_scrum_master);

// Affichage des informations de l'équipe dans un tableau
echo '<div class="max-w-2xl mx-auto mt-8">';
echo '<table class="min-w-full bg-white border border-gray-300">';
echo '<thead>';
echo '<tr class="bg-gray-100">';
echo '<th class="py-2 px-4 border-b">Nom de l\'équipe</th>';
echo '<th class="py-2 px-4 border-b">Date de création</th>';
echo '<th class="py-2 px-4 border-b">ID Scrum Master</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Utiliser une boucle while pour itérer sur les résultats
while ($stmt->fetch()) {
    echo '<tr>';
    echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($nom_equipe) . '</td>';
    echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($date_creation_equipe) . '</td>';
    echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($id_scrum_master) . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

$stmt->close();
?>



    
</div>
</body> 
</html>
                      


