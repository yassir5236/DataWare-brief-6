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
    <!-- Barre de navigation
    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto">
            <span class="text-xl font-bold">DataWare HR</span>
        </div>
    </nav> -->

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-semibold mb-8">Mes Projets</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Nom du Projet 1</h3>
                <p class="text-gray-600 mb-4">Description du Projet 1</p>
                <button onclick="afficherDetailsProjet(1)" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Afficher les détails</button>
            </div>

            <div class="bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Nom du Projet 2</h3>
                <p class="text-gray-600 mb-4">Description du Projet 2</p>
                <button onclick="afficherDetailsProjet(2)" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Afficher les détails</button>
            </div>

            <div class="bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Nom du Projet 2</h3>
                <p class="text-gray-600 mb-4">Description du Projet 2</p>
                <button onclick="afficherDetailsProjet(2)" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Afficher les détails</button>
            </div>

            <!-- Ajoutez d'autres projets ici -->
        </div>

        <button onclick="creerProjet()" class="mt-8 bg-green-500 text-white px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Créer un Projet</button>
        <button onclick="creerProjet()" class="mt-8 bg-green-500 text-white px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Supprimer un Projet</button>
        <button onclick="creerProjet()" class="mt-8 bg-green-500 text-white px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Modifier un Projet</button>
    </div>

    <script src="projet.js"></script>
</body>
</html>
