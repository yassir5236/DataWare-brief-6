<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <!-- Inclure le fichier CSS de Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans p-8">

 

<button onclick="toggleProjectForm()" class="bg-green-500 text-white mb-6 px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Ajouter un Projet</button>

<div id="projectForm" class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md p-6" style="display: none;">

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

<script>
    function toggleProjectForm() {
        var projectForm = document.getElementById('projectForm');
        projectForm.style.display = (projectForm.style.display === 'none' || projectForm.style.display === '') ? 'block' : 'none';
    }
</script>





    

  



  


 


</body>
</html>
