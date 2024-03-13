<?php
session_start();
require '../private/conn.php';

if (isset($_POST['add_to_cart'])) {
    $gameId = $_POST['game_id'];

    // Haal details van het game op
    $gameQuery = "SELECT * FROM games WHERE game_id = :game_id";
    $gameStmt = $dbh->prepare($gameQuery);
    $gameStmt->bindParam(':game_id', $gameId);
    $gameStmt->execute();
    $gameDetails = $gameStmt->fetch(PDO::FETCH_ASSOC);

    // Controleren of de gebruiker is ingelogd en het user_id ophalen
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Voeg het game toe aan het winkelwagentje
        if ($gameDetails) {
            $insertQuery = "INSERT INTO cart (user_id, game_id, vooraad) VALUES (:user_id, :game_id, 1)";
            $insertStmt = $dbh->prepare($insertQuery);
            $insertStmt->bindParam(':user_id', $user_id);
            $insertStmt->bindParam(':game_id', $gameId);
            $insertStmt->execute();

            // Verminder de voorraad met 1
            $updateStockQuery = "UPDATE games SET vooraad = vooraad - 1 WHERE game_id = :game_id";
            $updateStockStmt = $dbh->prepare($updateStockQuery);
            $updateStockStmt->bindParam(':game_id', $gameId);
            $updateStockStmt->execute();

            $_SESSION['melding'] = "Game is toegevoegd aan het winkelwagentje!";
            header('location:../index.php?page=cart'); // Redirect naar de pagina waar je de items weergeeft
            exit();
        } else {
            $_SESSION['melding'] = "Game niet gevonden!";
            header('location:../index.php?page=cart');            
            exit();
        }
    } else {
        $_SESSION['melding'] = "U moet ingelogd zijn om een bestelling te plaatsen!";
        header('location:../index.php?page=shop');
        exit();
    }
}
?>
