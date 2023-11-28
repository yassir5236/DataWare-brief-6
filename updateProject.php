<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    

<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Handle form submission to update project information in the database
    $projectId = $_POST['project_id'];
    $newProjectName = $_POST['new_project_name'];
    $newProjectDescription = $_POST['new_project_description'];

    // Perform the update query here using $projectId, $newProjectName, and $newProjectDescription
    // ...

    // Redirect to the same page or another page after the update
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

$content_Projet = $conn->query('SELECT  p.id AS id_projet, p.nom AS nom_projet, p.description AS description_projet, u.nom AS Nom_ScrumMaster
FROM projet p
JOIN utilisateur u ON u.id = p.id_user');

// Parcourir les résultats
while ($ligne = $content_Projet->fetch()) {
    echo  "
    <div class=\"bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105\">
        <h3 class=\"text-xl font-semibold mb-2 text-gray-800\">" . $ligne['nom_projet'] . " </h3>
        <p class=\"text-gray-600 mb-4\">" . $ligne['Nom_ScrumMaster'] . "</p>
        
        <!-- Button to show the update form -->
        <button onclick=\"showUpdateForm(" . $ligne['id_projet'] . ")\" class=\"bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue\">Modifier</button>
        
        <button onclick=\"confirmDelete(" . $ligne['id_projet'] . ")\" class=\"bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 focus:outline-none focus:shadow-outline-red\">Supprimer</button>

        <!-- Update form (initially hidden) -->
        <div id=\"updateForm{$ligne['id_projet']}\" class=\"hidden\">
            <form method=\"post\" action=\"{$_SERVER['PHP_SELF']}\">
                <input type=\"hidden\" name=\"project_id\" value=\"{$ligne['id_projet']}\">
                <label for=\"new_project_name\">Nouveau Nom:</label>
                <input type=\"text\" name=\"new_project_name\" required>
                <label for=\"new_project_description\">Nouvelle Description:</label>
                <textarea name=\"new_project_description\" required></textarea>
                <button type=\"submit\" name=\"submit\" class=\"bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green\">Enregistrer</button>
            </form>
        </div>
    </div>";
}

// JavaScript function to toggle the visibility of the update form
echo "<script>
    function showUpdateForm(projectId) {
        document.getElementById('updateForm' + projectId).classList.toggle('hidden');
    }
</script>";
?>



</body>
</html>