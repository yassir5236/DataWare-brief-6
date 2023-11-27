<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $projectId = $_GET['id'];

    
        // Delete members
        $deleteEquipeMembreQuery = $conn->prepare("DELETE FROM MembreEquipe WHERE id_equipe IN (SELECT id FROM equipe WHERE id_projet = :projectId)");
        $deleteEquipeMembreQuery->bindParam(':projectId', $projectId);
        $deleteEquipeMembreQuery->execute();

        // Perform the deletion query for equipe records first
        $deleteEquipeQuery = $conn->prepare("DELETE FROM equipe WHERE id_projet = :projectId");
        $deleteEquipeQuery->bindParam(':projectId', $projectId);
        $deleteEquipeQuery->execute();

        // Then, delete the projet record
        $deleteQuery = $conn->prepare("DELETE FROM projet WHERE id = :projectId");
        $deleteQuery->bindParam(':projectId', $projectId);
        $deleteQuery->execute();


    // Redirect back to the main page after deletion
    header("Location: side_productOwner.php");
    exit();
}
?>









