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


<button  class="bg-green-500 text-white mb-6 px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Ajouter un Projet</button>

    <div class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md p-6">



        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Nouveau projet</h2>

        <form action="#" method="post">

            <div class="mb-4">
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
                <input type="selection" id="ville" name="statut" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="statut">
            </div>

            <div class="mb-4">
                <label  class="block text-gray-700 font-bold mb-2">Scrum master</label>
                <input type="email" id="scrum" name="scrum" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="scrum master">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Envoyer</button>

        </form>

    </div>















    

  



  


 




















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

 
    
// Afficher les données de chaque enregistrement
echo  "
<div class=\"bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105\">
<h3 class=\"text-xl font-semibold mb-2 text-gray-800\">" . $ligne['nom_projet'] . " </h3>
<p class=\"text-gray-600 mb-4\">" . $ligne['description_projet']. "</p>
<button  class=\"bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue\">" . $ligne['Nom_ScrumMaster'] . "</button>
<button onclick=\"confirmDelete(" . $ligne['id_projet'] . ")\" class=\"bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 focus:outline-none focus:shadow-outline-red\">Supprimer</button>

</div>


";

}






?>
        <!-- <button  class="mt-8 bg-green-500 text-white px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Créer un Projet</button>
     
        <button  class="mt-8 bg-green-500 text-white px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Modifier un Projet</button> -->
        <script src="projet.js"></script>
</body>
</html>
