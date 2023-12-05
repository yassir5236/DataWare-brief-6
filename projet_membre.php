<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <!-- Inclure le fichier CSS de Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans" style="background-image: url('back2.jpg'); background-size: cover; background-position: center ">

    <div class="  container mx-auto p-8 ">

        <?php
        include("connection.php");
        session_start();
        $id_utilisateur = $_SESSION['id'] ; // Check if the session variable is set


        $sql = 'SELECT p.nom AS nom_projet, p.description AS description_projet, p.date_limite AS deadline_projet, e.nom AS nom_equipe, u.nom AS Nom_ScrumMaster
                FROM projet p
                JOIN utilisateur u ON u.id = p.id_user
                JOIN equipe e ON p.id = e.id_projet
                JOIN membreequipe m ON m.id_equipe = e.id
                WHERE m.id_user = ? AND m.id_equipe IS NOT NULL';

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id_utilisateur);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($nom_projet, $description_projet, $deadline_projet, $nom_equipe, $Nom_ScrumMaster);

        // Affichage des informations de l'équipe dans un tableau
        echo '<div class="max-w-2xl mx-auto mt-8">';
        echo '<table class="min-w-full bg-white border border-gray-300">';
        echo '<thead>';
        echo '<tr class="bg-gray-100">';
        echo '<th class="py-2 px-4 border-b">Nom_projet</th>';
        echo '<th class="py-2 px-4 border-b">Deadline_projet</th>';
        echo '<th class="py-2 px-4 border-b">Description_projet</th>';
        echo '<th class="py-2 px-4 border-b">Nom_equipe</th>';
        echo '<th class="py-2 px-4 border-b">Nom_ScrumMaster</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Utiliser une boucle while pour itérer sur les résultats
        while ($stmt->fetch()) {
            echo '<tr>';
            echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($nom_projet) . '</td>';
            echo '<td class="py-2 px-4 border-b">' . (isset($deadline_projet) ? htmlspecialchars($deadline_projet) : '') . '</td>';
            echo '<td class="py-2 px-4 border-b">' . htmlspecialchars($description_projet) . '</td>';
            echo '<th class="py-2 px-4 border-b">' . htmlspecialchars($nom_equipe) . '</td>';
            echo '<th class="py-2 px-4 border-b">' . htmlspecialchars($Nom_ScrumMaster) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';

        $stmt->close();
        ?>
    </div>
</body>

</html>











    <script src="projet.js"></script>
</body>
</html>
