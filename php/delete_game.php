<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        require '../private/conn.php';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $game_id = $_POST['game_id'];

        $query = "DELETE FROM games WHERE game_id = :game_id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_STR);
        
        $stmt->execute();

        header('location: ../index.php?page=Admin_games');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
