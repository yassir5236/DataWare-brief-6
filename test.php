<?php
include("../Connexion.php");
session_start();
$id_utilisateur = $_SESSION['utilisateur']['id'];

$sql = "SELECT projet.nom as nom_projet, description, projet.date_creation as date_creation, date_limite, projet.statut as statut, equipe.nom AS nom_equipe 
        FROM projet 
        JOIN utilisateur ON utilisateur.id = projet.id_user 
        LEFT JOIN equipe ON projet.id = equipe.id_projet 
        WHERE projet.id_user=?";

$requete = $conn->prepare($sql);
$requete->bind_param("i", $id_utilisateur);
$requete->execute();
$resultat = $requete->get_result();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <title>dataware | projet</title>
</head>

<body class="bg-[#ECECF8]">



    <header class="sticky flex  justify-between top-0 bg-[#2F329F] p-4">
        <a href="Dashboard.php" class="flex items-center text-white">
            <img src="../Images/Logo.png" class="h-8 mx-auto" alt="dataware Logo" />
        </a>
        <!-- Bouton burger visible sur les écrans de petite taille -->

        <div class="flex  justify-between items-center">

            <button id="burgerBtn" class="text-white focus:outline-none sm:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
            <!-- Menu de navigation pour la version desktop -->
            <nav class="hidden sm:flex space-x-4">
                <a href="Dashboard.php" class="text-gray-200 hover:bg-[#5355] transition duration-300">Dashboard</a>
                <a href="projet.php" class="text-gray-200 hover:bg-[#5355] transition duration-300">Projets</a>
                <a href="equipe.php" class="text-gray-200 hover:bg-[#5355] transition duration-300">Équipes</a>
                <a href="membre.php" class="text-gray-200 hover:bg-[#5355] transition duration-300">Membres</a>
                <a href="../Deconnexion.php"
                    class="text-gray-200 hover:bg-[#5355] transition duration-300">Déconnexion</a>
            </nav>
        </div>
    </header>

    <!-- Menu burger pour la version mobile -->
    <div id="burgerOverlay"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center sm:hidden">
        <nav class="flex flex-col items-center">
            <a href="Dashboard.php" class="text-gray-200 py-2 hover:bg-[#5355] transition duration-300">Dashboard</a>
            <a href="projet.php" class="text-gray-200 py-2 hover:bg-[#5355] transition duration-300">Projets</a>
            <a href="equipe.php" class="text-gray-200 py-2 hover:bg-[#5355] transition duration-300">Équipes</a>
            <a href="membre.php" class="text-gray-200 py-2 hover:bg-[#5355] transition duration-300">Membres</a>
            <a href="../Deconnexion.php"
                class="text-gray-200 py-2 hover:bg-[#5355] transition duration-300">Déconnexion</a>
        </nav>
    </div>

    <div class="flex-1 flex flex-col h-screen">
        <div class="container mx-auto p-6">
            <h1 class="text-3xl text-center font-bold text-gray-800 mb-6">Project Management</h1>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nom du Projet</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Équipe</th>
                            <th scope="col" class="px-6 py-3">Date de Création</th>
                            <th scope="col" class="px-6 py-3">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $resultat->fetch_assoc()) {
                            echo "<div class=\"bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105\">
    <h3 class=\"text-xl font-semibold mb-2 text-gray-800\">{$row['nom_projet']}</h3>
    <p class=\"text-gray-600 mb-4\">{$row['description']}</p>
    <p class=\"text-gray-600 mb-4\">{$row['date_creation']}</p>
    <p class=\"text-gray-600 mb-4\">{$row['date_limite']}</p>

    <button onclick=\"afficherDetailsProjet(1)\" class=\"bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue\">supprimer </button>
</div>";
                            echo " 
                                    <tr class=\"bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50
                                    dark:hover:bg-gray-600 \">
                                    <td scope=\"row\" class=\" px-6 py-4 text-gray-900 whitespace-nowrap
                                        dark:text-white\">{$row['nom_projet']}</td>
                                    <td class=\"py-2 px-4 border-b\">{$row['description']}</td>
                                    <td class=\"px-6 py-4 border-b\">{$row['date_creation']}</td>
                                    <td class=\"px-6 py-4 border-b\">{$row['date_limite']}</td>
                             
                                    </tr>
                                    ";
                        }
                        ?>


                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>





</body>

</html>