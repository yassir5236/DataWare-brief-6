<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location:logout.php ");
}
?>

<?php
include("connection.php");

$user_id = $_SESSION['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nomEquipe"], $_POST["projetAssocie"], $_POST["membresEquipe"])) {

        $nomEquipe = $_POST["nomEquipe"];
        $idProjet = $_POST["projetAssocie"];
        $membresEquipe = $_POST["membresEquipe"];

        $sqlInsertEquipe = "INSERT INTO equipe (nom, id_user, id_projet) VALUES (?,? , ?)";
        $requeteInsertEquipe = $conn->prepare($sqlInsertEquipe);
        $requeteInsertEquipe->bind_param("sii", $nomEquipe, $user_id, $idProjet);

        if ($requeteInsertEquipe->execute()) {
            $idEquipe = $requeteInsertEquipe->insert_id;

            $sqlInsertMembres = "INSERT INTO MembreEquipe (id_user, id_equipe) VALUES (?, ?)";
            $requeteInsertMembres = $conn->prepare($sqlInsertMembres);

            foreach ($membresEquipe as $idMembre) {
                $requeteInsertMembres->bind_param("ii", $idMembre, $idEquipe);
                $requeteInsertMembres->execute();
            }

            echo "Équipe ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout de l'équipe : " . $requeteInsertEquipe->error;
        }
    } else {
        echo "Tous les champs du formulaire doivent être remplis.";
    }
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

<body class="bg-gray-100 font-sans flex flex-col min-h-screen  opacity-100"
    style="background-image: url('back6.jpg'); background-size: cover; background-position: center;">
    <!-- Navbar -->

    <nav class="bg-blue-500 p-2 text-white mb-10">
        <div class="container mx-auto flex justify-between items-center">
            <span class="text-xl font-bold">DataWare </span>
            <a href="logout.php">
                <button
                    class="ml-auto px-4 py-2 bg-blue-700 rounded-md hover:bg-red-600 transition duration-300 ease-in-out">Déconnexion</button>
            </a>
        </div>
    </nav>



    <!-- Main Container -->
    <div class="flex flex-1">

        <!-- Main Sidebar -->
        <div class="bg-gradient-to-b from-indigo-800 to-indigo-600 text-white w-64 flex-shrink-0 h-screen">
            <div class="p-4">

                <ul>
                    <li class="mb-2">
                        <a href="#" onclick="loadContent('accueil.html')"
                            class="flex items-center py-2 px-4 text-gray-300 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 12.79l-9-9L12 2l-9 9 1.41 1.41L12 5.83l8.59 8.59L21 12.79z"></path>
                            </svg>
                            Accueil
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" onclick="loadContent('projet_Scrum.php')"
                            class="flex items-center py-2 px-4 text-gray-300 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 14v-2a7 7 0 00-14 0v2"></path>
                                <path d="M12 21v-2m0 0V5"></path>
                                <path d="M5 12h14"></path>
                            </svg>
                            Projets
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" onclick="loadContent('equipes_Scrum.php')"
                            class="flex items-center py-2 px-4 text-gray-300 hover:text-white hover:bg-indigo-700 transition duration-300 ease-in-out">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
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



        <script>
            function toggleEquipeForm() {
                var equipeForm = document.getElementById('equipeForm');
                equipeForm.style.display = (equipeForm.style.display === 'none' || equipeForm.style.display === '') ? 'block' : 'none';
            }

            function confirmDelete_equipe(id_equipe) {
                var confirmation = confirm("Are you sure you want to delete this team?");
                if (confirmation) {
                    // User confirmed, trigger the deletion by redirecting to a PHP script
                    window.location.href = "delete_equipe.php?id=" + id_equipe;
                }
            }
        </script>

        <script src="projet.js"></script>
</body>

</html>