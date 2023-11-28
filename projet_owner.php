




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <!-- Inclure le fichier CSS de Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
  
<body class="bg-gray-100 font-sans" style="background-image: url('back2.jpg'); background-size: cover; background-position: center " >
  <div class="  container mx-auto p-8  ">


  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Form</title>
    <!-- Inclure le fichier CSS de Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans p-8">














    <button onclick="toggleProjectForm()" class="bg-green-500 text-white mb-6 px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Ajouter un Projet</button>

<div id="projectForm" class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md p-6" style="display: none;">

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Nouveau projet</h2>

    <form action="" method="post">

        
    <div class="mb-10">
                <label for="nom" class="block text-gray-700 font-bold mb-2">Nom  </label>
                <input type="text" id="nom" name="nom" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder=" nom">
            </div>

            <div class="mb-4">
                <label  class="block text-gray-700 font-bold mb-2">Description</label>
                <input type="text" id="text" name="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="description">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Date_limite</label>
                <input type="date" id="password" name="date_limite" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="date_limite">
            </div>

            <div class="mb-4">
                <label  class="block text-gray-700 font-bold mb-2">Statut</label>
                <select id="ville" name="statut" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
                </select>

            </div>

            <div class="mb-4">
                <label  class="block text-gray-700 font-bold mb-2">Scrum_master</label>
                <select name="Scrum_master" id="Scrum_master" class="w-[60%] rounded-xl">
                

    <option value="choose your project manager" disabled selected hidden>choose your Scrum master </option>



    <?php

    session_start();

   include("connection.php");
    $stmt = $conn->prepare('SELECT id, nom FROM utilisateur WHERE role = "Membre" AND statut = "inactif"');
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $nom = $row['nom'];
        echo "<option value='$id'>$nom</option>";
    }

    $stmt->closeCursor(); // Close the cursor to enable a new query
    ?>

    </select>

            </div>
        <input type="submit"   value="Envoyer"  name="submitproject"  class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
        
        </form>

</div>
<br>










<?php
include("connection.php");

if(isset($_POST['submitproject'])) {
    $nom = $_POST['nom'];
    $description = $_POST['text'];
    $date_limite = $_POST['date_limite'];
    $statut = $_POST['statut'];

    // Check if the Scrum_master field is set
    $scrum_master = isset($_POST['Scrum_master']) ? $_POST['Scrum_master'] : null;

    // Vérifier si les champs obligatoires sont remplis
    // if(empty($nom) || empty($description) || empty($date_limite) || empty($statut) || empty($scrum_master)) {
    //     echo "Veuillez remplir tous les champs.";
    // } else {
        // Insertion des données dans la table projet
        $stmt = $conn->prepare('INSERT INTO projet (nom, description, date_limite, statut, id_user) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$nom, $description, $date_limite, $statut, $scrum_master]);
      


        echo "Le projet a été ajouté avec succès.";
        // Vous pouvez également effectuer d'autres actions ici, si nécessaire

        
    }
// }
?>




   






<script>
    function toggleProjectForm() {
        var projectForm = document.getElementById('projectForm');
        projectForm.style.display = (projectForm.style.display === 'none' || projectForm.style.display === '') ? 'block' : 'none';
    }
</script>




      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <script>
    function confirmDelete(projectId) {
        var confirmation = confirm("Are you sure you want to delete this project?");
        if (confirmation) {
            // User confirmed, trigger the deletion by redirecting to a PHP script
            window.location.href = "delete_projet.php?id=" + projectId;
        }
    }
    </script>


      
      <?php

include 'connection.php';
$content_Projet = $conn->query('SELECT  p.id AS id_projet, p.nom AS nom_projet, p.description AS description_projet, u.nom AS Nom_ScrumMaster
FROM projet p
JOIN utilisateur u ON u.id = p.id_user');




// Parcourir les résultats
while ($ligne= $content_Projet->fetch()) {

 
    
// Afficher les données de chaque enregistrement description_projet
echo  "
<div class=\"bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105\">
<h3 class=\"text-xl font-semibold mb-2 text-gray-800\">" . $ligne['nom_projet'] . " </h3>
<p class=\"text-gray-600 mb-4\">" . $ligne['Nom_ScrumMaster']. "</p>
<button  class=\"bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue\">Modifier</button>
<button onclick=\"confirmDelete(" . $ligne['id_projet'] . ")\" class=\"bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 focus:outline-none focus:shadow-outline-red\">Supprimer</button>


</div>


";

}

?>

















      
        <script src="projet.js"></script>
</body>
</html>


