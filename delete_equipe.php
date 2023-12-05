<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $equipe_id = $_GET['id'];

    
        // Delete members
        $deleteEquipeMembreQuery = $conn->prepare("DELETE FROM MembreEquipe WHERE id_equipe=?");
        $deleteEquipeMembreQuery->bind_param('i', $equipe_id);
        $deleteEquipeMembreQuery->execute();
        
        // Perform the deletion query for equipe records
        $deleteEquipeQuery = $conn->prepare("DELETE FROM equipe WHERE id = ?");
        $deleteEquipeQuery->bind_param('i', $equipe_id);
        $deleteEquipeQuery->execute();
        
        
        // Close the prepared statements
        $deleteEquipeMembreQuery->close();
        $deleteEquipeQuery->close();


    // Redirect back to the main page after deletion
    header("Location: side_scrumMster.php");
    exit();
}
?>