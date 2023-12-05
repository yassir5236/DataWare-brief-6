<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $projectId = $_GET['id'];

    
        // Delete members
        $deleteEquipeMembreQuery = $conn->prepare("DELETE FROM MembreEquipe WHERE id_equipe IN (SELECT id FROM equipe WHERE id_projet = ?)");
        $deleteEquipeMembreQuery->bind_param('i', $projectId);
        $deleteEquipeMembreQuery->execute();
        
        // Perform the deletion query for equipe records
        $deleteEquipeQuery = $conn->prepare("DELETE FROM equipe WHERE id_projet = ?");
        $deleteEquipeQuery->bind_param('i', $projectId);
        $deleteEquipeQuery->execute();
        
        // Perform the deletion query for projet record
        $deleteQuery = $conn->prepare("DELETE FROM projet WHERE id = ?");
        $deleteQuery->bind_param('i', $projectId);
        $deleteQuery->execute();
        
        // Close the prepared statements
        $deleteEquipeMembreQuery->close();
        $deleteEquipeQuery->close();
        $deleteQuery->close();


    // Redirect back to the main page after deletion
    header("Location: side_productOwner.php");
    exit();
}
?>