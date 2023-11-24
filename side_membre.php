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
<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

<!-- Navbar -->
<nav class="bg-blue-500 p-4 text-white">
    <div class="container mx-auto">
        <span class="text-xl font-bold">DataWare </span>
    </div>
</nav>

<!-- Main Container -->
<div class="flex flex-1">

    <!-- Main Sidebar -->
    <div class="bg-gradient-to-b from-indigo-800 to-indigo-600 text-white w-64 flex-shrink-0 h-screen">
        <div class="p-4">
            
            <ul>
                <li class="mb-2">
                    <a href="#" onclick="loadContent('accueil.html')" class="flex items-center py-2 px-4 text-gray-300 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 12.79l-9-9L12 2l-9 9 1.41 1.41L12 5.83l8.59 8.59L21 12.79z"></path>
                        </svg>
                        Accueil
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" onclick="loadContent('projet_membre.php')" class="flex items-center py-2 px-4 text-gray-300 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 14v-2a7 7 0 00-14 0v2"></path>
                            <path d="M12 21v-2m0 0V5"></path>
                            <path d="M5 12h14"></path>
                        </svg>
                        Projets
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" onclick="loadContent('equipes_membre.php')" class="flex items-center py-2 px-4 text-gray-300 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
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

</body>
</html>
