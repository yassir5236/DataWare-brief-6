<?php
include("connection.php");

if (isset($_POST['submitproject'])) {
    $nom = $_POST['nom'];
    $description = $_POST['text'];
    $date_limite = $_POST['date_limite'];
    $statut = $_POST['statut'];



    // Check if the Scrum_master field is set
    $scrum_master = isset($_POST['Scrum_master']) ? $_POST['Scrum_master'] : null;

    // Ensure that the $scrum_master variable contains the correct value before executing SQL queries
    if ($scrum_master !== null) {
        // Update the role of the selected user to Scrum Master
        $updateStmt = $conn->prepare('UPDATE utilisateur SET role = "Scrum" WHERE id = ?');
        $updateStmt->bind_param('s', $scrum_master);
        $updateStmt->execute();

        // Insert data into the "projet" table
        $insertStmt = $conn->prepare('INSERT INTO projet (nom, description, date_limite, statut, id_user) VALUES (?, ?, ?, ?, ?)');
        $insertStmt->bind_param('sssss', $nom, $description, $date_limite, $statut, $scrum_master);
        $insertStmt->execute();

        echo "Le projet a été ajouté avec succès.";

        // Close the prepared statements
        $updateStmt->close();
        $insertStmt->close();
    } else {
        echo "Veuillez sélectionner un Scrum Master pour le projet.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <!-- Inclure le fichier CSS de Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans"
    style="background-image: url('back2.jpg'); background-size: cover; background-position: center ">
    <div class="  container mx-auto p-8  ">

        <!-- formulaire pour ajouter un projet  -->

        <button onclick="toggleProjectForm()"
            class="bg-green-500 text-white mb-6 px-6 py-3 rounded-full hover:bg-green-600 focus:outline-none focus:shadow-outline-green">Ajouter
            un Projet</button>

        <div id="projectForm" class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md p-6"
            style="display: none;">

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Nouveau projet</h2>

            <form action="" method="post">


                <div class="mb-10">
                    <label for="nom" class="block text-gray-700 font-bold mb-2">Nom </label>
                    <input type="text" id="nom" name="nom"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        placeholder=" nom">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Description</label>
                    <input type="text" id="text" name="text"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="description">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Date_limite</label>
                    <input type="date" id="date_limite" name="date_limite"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="date_limite">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Statut</label>
                    <select id="ville" name="statut"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                    </select>

                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Scrum_master</label>
                    <select name="Scrum_master" id="Scrum_master" class="w-[60%] rounded-xl">


                        <option value="choose your project manager" disabled selected hidden>choose your Scrum
                            master </option>



                        <?php

                        $stmt = $conn->prepare('SELECT id, nom FROM utilisateur WHERE role<>"Manager" and statut = "actif"');
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $nom = $row['nom'];

                            echo "<option value=\"$id\">$nom</option>";
                        }

                        $stmt->close(); // Close the statement to enable a new query
                        ?>

                    </select>

                </div>
                <input type="submit" value="Envoyer" name="submitproject"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">

            </form>

        </div>
        <br>

        <script>
            function toggleProjectForm() {
                var projectForm = document.getElementById('projectForm');
                projectForm.style.display = (projectForm.style.display === 'none' || projectForm.style.display === '') ? 'block' : 'none';
            }
        </script>



        <!-- Afficher les projet -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">


            <?php

            $sql = "SELECT  p.id AS id_projet, p.nom AS nom_projet, p.description AS description_projet, u.nom AS Nom_ScrumMaster
            FROM projet p
            JOIN utilisateur u ON u.id = p.id_user";
            $requete = $conn->prepare($sql);
            $requete->execute();
            $content_Projet = $requete->get_result();


            while ($ligne = $content_Projet->fetch_assoc()) {



                // Afficher les données de chaque enregistrement description_projet
                echo "
                        <div class=\"bg-white p-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105\">
                        <h3 class=\"text-xl font-semibold mb-2 text-gray-800\">" . $ligne['nom_projet'] . " </h3>
                        <p class=\"text-gray-600 mb-4\">" . $ligne['Nom_ScrumMaster'] . "</p>
                    
                        <form action=\"\" method=\"post\" onsubmit=\"updateprojectform()\" >
                        <input hidden name=\"projectIdUpdate\" value=" . $ligne['id_projet'] . ">
                        <button type=\"submit\"    id=\"updateproject\"  name=\"updateproject\"  class=\"bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue\">modifier</button>
                    </form>

                        <button onclick=\"confirmDelete(" . $ligne['id_projet'] . ")\" class=\"bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 focus:outline-none focus:shadow-outline-red\">Supprimer</button>

                        

                        </div>


                        ";

            }
            ?>

        </div>


        <script>
            function confirmDelete(projectId) {
                var confirmation = confirm("Are you sure you want to delete this project?");
                if (confirmation) {
                    // User confirmed, trigger the deletion by redirecting to a PHP script
                    window.location.href = "delete_projet.php?id=" + projectId;
                }
            }
        </script>



        <br>

        <!-- ******************************************************************************* -->
        <?php


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['updateproject'])) {

                $projectId = $_POST['projectIdUpdate'];
                $sql = "SELECT * FROM projet WHERE id = ?";
                $requete = $conn->prepare($sql);
                $requete->bind_param("i", $projectId);
                $requete->execute();
                $result = $requete->get_result();


                if ($row = $result->fetch_assoc()) {
                    $projectIdUpdate = $row['id'];
                    $projectName = $row['nom'];
                    $deadline = $row['date_limite'];
                    $scrumMaster = $row['id_user'];
                    $description = $row['description'];
                } else {
                    echo "No project found with ID " . $projectId;
                }
            }

        }

        ?>
        <div id="modifierForm" class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md p-6"
            style="display: none;">

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier projet</h2>

            <form action="" method="post" id="formupdate">

                <input id="projectIdUpdate" name="id_projet" value=" <?php echo $projectIdUpdate; ?>">
                <div class="mb-10">
                    <label for="nom" class="block text-gray-700 font-bold mb-2">Nom </label>
                    <input type="text" id="nom" name="nom"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="nom" value="<?php echo $projectName; ?>">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Description</label>
                    <input type="text" id="text" name="text"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="description" value="<?php echo $description; ?>">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Date_limite</label>
                    <input type="date" id="date_limite" name="date_limite"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="date_limite" value="<?php echo $deadline; ?>">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Statut</label>
                    <select id="statut" name="statut"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                        <option value="">Actif</option>
                        <option value="">Inactif</option>

                    </select>
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Scrum Master</label>
                    <select id="scrum_master" name="scrum_master"
                        class="px-4 py-2 w-full border rounded focus:outline-none focus:border-blue-500">
                        <?php

                        $sql = "SELECT id,email from utilisateur where role='sm' OR role='user';";
                        $requete = $conn->prepare($sql);
                        $requete->execute();
                        $resultat = $requete->get_result();
                        while ($row = $resultat->fetch_assoc()) {
                            echo "<option value=\"{$row['id']}\">{$row['email']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="submit" value="Modifier" name="modifier_project"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
            </form>
        </div>
        <br>


        <script>
            function updateprojectform() {
                var modifierForm = document.getElementById('modifierForm');
                event.preventDefault();
                modifierForm.style.display = (modifierForm.style.display === 'none' || modifierForm.style.display === '') ? 'block' : 'none';
                document.getElementById('scrum_master').value = '<?php echo $scrumMaster; ?>';

            }


        </script>


<?php 
        // $projectName = htmlspecialchars($_POST["projectName"]);
        // $deadline = htmlspecialchars($_POST["deadline"]);
        // $scrumMaster = htmlspecialchars($_POST["scrum_master"]);
        // $description = htmlspecialchars($_POST["description"]);


        // if (isset($_POST['modifier_project'])) {

        //     $projectId = $_POST['id_projet'];
        //     $sql = "UPDATE projet SET nom=?, description=?, date_limite=?, id_user=? WHERE id= ?";
        //     $requete = $conn->prepare($sql);

        //     // Vérification de la préparation de la requête
        //     if (!$requete) {
        //         die('Erreur de préparation de la requête : ' . $conn->error);
        //     }

        //     $requete->bind_param("ssssi", $projectName, $description, $deadline, $scrumMaster, $projectId);

        //     // Vérification de l'exécution de la requête
        //     if ($requete->execute()) {

        //         echo "<script>
        //             const projectModal = document.getElementById('projectModal');
        //             const projectForm = document.getElementById('projectForm');

        //             projectForm.addEventListener('submit', (event) => {
        //                 // Ajoutez le code pour traiter le formulaire ici
        //                 event.preventDefault();
        //                 // Fermez le modal après avoir traité le formulaire si nécessaire
        //                 projectModal.classList.add('hidden');
        //             });
        //             </script>";

        //         echo "Le projet a été modifié avec succès";
        //     } else {
        //         echo "Erreur lors de l'exécution de la requête : " . $requete->error;
        //     }

        // }
?>


        <!-- *********************************************************************** -->


        <!-- <script src="projet.js"></script> -->
    </div>
</body>

</html>