<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=game_shop", "root", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $gameId = $_POST['game_id'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $categoryId = $_POST['category']; // Using a different variable name to avoid conflict
        $description = $_POST['description'];
        $stock = $_POST['stock'];
        $url = $_POST['url'];

        // Fetch category type based on category ID
        $categoryQuery = "SELECT categoryId, category_type FROM categorie WHERE categoryId = :category";
        $categoryStmt = $dbh->prepare($categoryQuery);
        $categoryStmt->bindParam(':category', $categoryId);
        $categoryStmt->execute();
        $categoryResult = $categoryStmt->fetch(PDO::FETCH_ASSOC);

        if ($categoryResult) {
            $category = $categoryResult['category_type'];
        } else {
            
            echo "Category ID not found or no data returned from the query.";
            // Perform necessary error handling or redirect as required
        }

        // Foto verwerken als BLOB
        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photoTmpPath = $_FILES['photo']['tmp_name'];
            $photoBlob = file_get_contents($photoTmpPath); 
        }

        $query = "UPDATE games SET game_title = :title, prijs = :price, catogerie = :category, beschrijving = :description, vooraad = :stock, video = :url, foto = :photoBlob WHERE game_id = :gameId";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category); // Use the category type obtained from the query
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':photoBlob', $photoBlob, PDO::PARAM_LOB); // Bind the BLOB parameter
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->execute();

        header('location: ../index.php?page=Admin_shop');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
