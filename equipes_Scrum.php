<?php
include("connection.php");
session_start();
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
    <title>Gestion des equipes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans"
    style="background-image: url('back2.jpg'); background-size: cover; background-position: center ">
    <div class="  container mx-auto p-8  ">

        <!-- formulaire pour ajouter un projet  -->

        <button onclick="toggleEquipeForm()"
            class="bg-green-500 text-white mb-6 px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Ajouter
            une equipe</button>

        <div id="equipeForm" class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md p-6"
            style="display: none;">

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Nouvelle équipe</h2>

            <form action="" method="post">

                <div class="mb-10">
                    <label for="nomEquipe" class="block text-gray-700 font-bold mb-2">Nom de l'équipe</label>
                    <input type="text" id="nomEquipe" name="nomEquipe"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Nom de l'équipe">
                </div>

                <div class="mb-4">
                    <label for="projetAssocie" class="block text-gray-700 font-bold mb-2">Projet associé</label>
                    <!-- Replace this with your logic to fetch and display project options -->
                    <select id="projetAssocie" name="projetAssocie"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                        <?php

                        // Select projects where id_user = $userId
                        $sqlProjet = "SELECT id, nom FROM projet WHERE id_user = ?";
                        $requeteProjet = $conn->prepare($sqlProjet);
                        $requeteProjet->bind_param('i', $user_id);
                        $requeteProjet->execute();
                        $resultatProjet = $requeteProjet->get_result();

                        while ($rowProjet = $resultatProjet->fetch_assoc()) {
                            echo "<option value=\"{$rowProjet['id']}\">{$rowProjet['nom']}</option>";
                        }
                        ?>
                    </select>

                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Membres de l'équipe</label>
                    <!-- Replace this with your logic to fetch and display user options -->
                    <select name="membresEquipe[]" id="membresEquipe"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" multiple>
                        <?php
                        // Assuming $session['id'] is the user ID
                        $userId = $session['id'];

                        // Select users where role = "Membre"
                        $sqlMembres = "SELECT id, nom FROM utilisateur WHERE role = 'Membre'";
                        $requeteMembres = $conn->prepare($sqlMembres);
                        $requeteMembres->execute();
                        $resultatMembres = $requeteMembres->get_result();

                        while ($rowMembre = $resultatMembres->fetch_assoc()) {
                            echo "<option value=\"{$rowMembre['id']}\">{$rowMembre['nom']}</option>";
                        }
                        ?>
                    </select>

                </div>

                <input type="submit" value="Envoyer" name="submitEquipe"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">

            </form>

        </div>


        <script>
            function toggleEquipeForm() {
                var equipeForm = document.getElementById('equipeForm');
                equipeForm.style.display = (equipeForm.style.display === 'none' || equipeForm.style.display === '') ? 'block' : 'none';
            }
        </script>

        <br>


        <!-- Afficher les projet -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php
            $sql = "SELECT e.id AS id_equipe, e.nom AS nom_equipe, e.date_creation AS date_creation_equipe, p.nom AS nom_projet
        FROM equipe e
        JOIN projet p ON p.id = e.id_projet";
            $requete = $conn->prepare($sql);
            $requete->execute();
            $content_Equipe = $requete->get_result();

            while ($ligne = $content_Equipe->fetch_assoc()) {
                // Display team information in cards
                echo "
        <div class=\"bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105\">
            <h3 class=\"text-xl font-semibold mb-2 text-gray-800\">" . $ligne['nom_equipe'] . " </h3>
            <p class=\"text-gray-600 mb-2\">Projet associé: " . $ligne['nom_projet'] . "</p>
            <p class=\"text-gray-600 mb-4\">Date de création: " . $ligne['date_creation_equipe'] . "</p>
            
            <button onclick=\"toggleModifierForm()\" value=\"" . $ligne['id_equipe'] . "\" class=\"bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue\">Modifier</button>
            <button onclick=\"confirmDelete_equipe(" . $ligne['id_equipe'] . ")\" class=\"bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 focus:outline-none focus:shadow-outline-red\">Supprimer</button>
        </div>
    ";
            }
            ?>

        </div>


        <script>
            function confirmDelete_equipe(id_equipe) {
                var confirmation = confirm("Are you sure you want to delete this team?");
                if (confirmation) {
                    // User confirmed, trigger the deletion by redirecting to a PHP script
                    window.location.href = "delete_equipe.php?id=" + id_equipe;
                }
            }
        </script>

    </div>
</body>

</html>