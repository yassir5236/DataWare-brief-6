<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("Location:logout.php ");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans flex flex-col min-h-screen  opacity-100" style="background-image: url('back.jpg'); background-size: cover; background-position: center;">
<!-- Navbar -->

<nav class="bg-blue-500 p-2 text-white mb-10">
    <div class="container mx-auto flex justify-between items-center">
        <span class="text-xl font-bold">DataWare </span>
        <a href="logout.php">
                <button class="ml-auto px-4 py-2 bg-blue-700 rounded-md hover:bg-red-600 transition duration-300 ease-in-out">Déconnexion</button>
                </a>
                </div>
</nav>






<!-- Main Container -->
<div class="flex flex-1">

    <!-- Main Sidebar -->
    <div class="bg-gradient-to-b from-sky-400 to-indigo-600 text-gray-50 opacity-80 w-64 flex-shrink-0 h-screen">
        <div class="p-4">
            
            <ul >
                <li class="mb-2">
                    <a href="#"  class="flex items-center py-2 px-4 text-gray-50 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                         <path d="M3 3h18v18H3zM21 12l-9-9-9 9"></path>
                        </svg>
                        Accueil
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" onclick="loadContent('projet_membre.php')" class="flex items-center py-2 px-4 text-gray-50 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 6h-9a2 2 0 00-2 2v11a2 2 0 002 2h9a2 2 0 002-2V8a2 2 0 00-2-2zM3 6v14a2 2 0 002 2h1"></path>
                        <path d="M16 6L2 6"></path>
                        <path d="M10 11H2"></path>
                      </svg>
                        Projets
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" onclick="loadContent('equipes_membre.php')" class="flex items-center py-2 px-4 text-gray-50 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
        <path d="M11 16v-2a2 2 0 00-2-2H7a2 2 0 00-2 2v2m6 0h4a2 2 0 002-2v-2m-6 0a6 6 0 0112 0v2m-12 4v2a2 2 0 002 2h12a2 2 0 002-2v-2"></path>
    </svg>
                        Équipes
                    </a>
                </li>
                <!-- Add more links as needed -->
            </ul>
        </div>
    </div>

    <!-- Container to load content -->
    <div id="content-container" class="container mx-auto p-8 flex-1 overflow-hidden">
        <!-- Content will be loaded here -->
    </div>

 

<script>
    function loadContent(page) {
        // Fetch the content of the selected page
        fetch(page)
            .then(response => response.text())
            .then(content => {
                // Inject the content into the container
                document.getElementById('content-container').innerHTML = content;
            })
            .catch(error => console.error('Error fetching content:', error));
    }
</script>



<script>
    function loadContent(page) {
        // Fetch the content of the selected page
        fetch(page)
            .then(response => response.text())
            .then(content => {
                // Inject the content into the container
                document.getElementById('content-container').innerHTML = content;
            })
            .catch(error => console.error('Error fetching content:', error));
    }

    function logout() {
        // Ajoute ici le code de déconnexion, par exemple, rediriger vers une page de déconnexion
         window.location.href = 'signin.php';
        alert('Déconnexion réussie');  // Remplacez cela par le code réel de déconnexion
    }
</script>

</body>
</html>


