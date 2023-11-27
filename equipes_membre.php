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
session_start();

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=datawareX', 'root', '');

// Récupération des informations du membre
$id_utilisateur = isset($_SESSION['id']) ? $_SESSION['id'] : null; // Check if the session variable is set
if ($id_utilisateur === null) {
    echo 'User ID not found in session.';
    exit; // Exit the script if the user ID is not set
}

$sql = 'SELECT e.nom AS nom_equipe, e.date_creation AS date_creation_equipe, e.id_user AS id_scrum_master
        FROM equipe e
        JOIN membreequipe m ON m.id_equipe = e.id
        WHERE m.id_user = :id_utilisateur AND m.id_equipe IS NOT NULL'; // Fix the column name to id_user
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_utilisateur', $id_utilisateur);
$stmt->execute();


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
while ($resultat = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($resultat['nom_equipe']) . '</td>';
    echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($resultat['date_creation_equipe']) . '</td>';
    echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($resultat['id_scrum_master']) . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';
?>







<!-- <?php









// Supposons que vous avez déjà récupéré les informations de connexion du formulaire
$email = $_POST['email'];
$password = $_POST['password'];

// Vérification des informations d'identification
$query = "SELECT id, nom, email, role FROM utilisateur WHERE email = :email AND password = :password";
$stmt = $connexion->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Utilisateur authentifié
    echo "Bienvenue " . $user['nom'] . "!";

    // Récupérer les informations de l'équipe
    $query = "SELECT equipe.nom as nom_equipe, equipe.date_creation as date_creation_equipe, utilisateur.nom as scrum_master
              FROM MembreEquipe
              JOIN equipe ON MembreEquipe.id_equipe = equipe.id
              JOIN utilisateur ON equipe.id_user = utilisateur.id
              WHERE MembreEquipe.id_user = :user_id";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':user_id', $user['id']);
    $stmt->execute();
    $equipeDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    // Afficher les détails de l'équipe dans un tableau
    echo "<table border='1'>
            <tr>
                <th>Nom de l'équipe</th>
                <th>Date de création de l'équipe</th>
                <th>Scrum Master</th>
            </tr>
            <tr>
                <td>" . $equipeDetails['nom_equipe'] . "</td>
                <td>" . $equipeDetails['date_creation_equipe'] . "</td>
                <td>" . $equipeDetails['scrum_master'] . "</td>
            </tr>
          </table>";

} else {
    // Identifiants incorrects
    echo "Identifiants incorrects.";
}

// Fermer la connexion
$connexion = null;
?> -->

    
</div>
</body> 
</html>
                      


