<?php
require '../private/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission here
    $title = $_POST['title'];
    $categoryId = $_POST['category']; // Use a different variable name for category ID
    $stock = $_POST['aantal'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $video = $_POST['video'];
    $foto = file_get_contents($_FILES['foto']['tmp_name']);

    try {
        $dbh = new PDO("mysql:host=localhost;dbname=game_shop", "root", "");

        $categoryQuery = "SELECT categoryId, category_type FROM categorie WHERE categoryId = :category";
        $categoryStmt = $dbh->prepare($categoryQuery);
        $categoryStmt->bindParam(':category', $categoryId);
        $categoryStmt->execute();
        $categoryResult = $categoryStmt->fetch(PDO::FETCH_ASSOC);

        $categoryType = null; // Initialize the variable for category type

        if ($categoryResult) {
            $categoryType = $categoryResult['category_type'];
        }

        $query = "INSERT INTO games (game_title, catogerie, vooraad, prijs, beschrijving, foto, video) VALUES (:title, :category, :stock, :price, :description, :foto, :video)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category', $categoryType); // Use the variable for category type
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
        $stmt->bindParam(':video', $video);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['melding'] = 'Game is toegevoegd';
            header('location:../index.php?page=ADD_game');
            exit;
        } else {
            $_SESSION['melding'] = 'Toevoegen mislukt. Probeer het opnieuw.';
            header('location:../index.php?page=ADD_cato');
            exit;
        }
        
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
    }
}
